<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class Controller
{
    public function getFetchResponseByQuery(mixed $query, Request $request, string $resourceClass, int $perPage = 10, $page = 1): AnonymousResourceCollection
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        $total = ceil($query->count() / $perPage);

        if ($total < $page) {
            $page = $total;
        }

        $queryResult = $query->orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);

        return $resourceClass::collection($queryResult);
    }
    
    protected function moveRelatedFilesFromUploads(Model $model, string $relationName): void
    {
        $model->load($relationName);
        foreach ($model->$relationName as $relatedItem) {
            $relatedItem->moveFromUploads();
        }
    }

    protected function updateManyToManyRelatedModels(Model $model, string $relationName, array $items = []): void
    {
        $relationClassName = $model->$relationName()->getRelated();
        // Doesn't work with upsert or updateOrCreate
        $itemIds = array_map(function ($itemData) use($model, $relationName, $relationClassName) {
            if (array_key_exists('id', $itemData)) {
                $item = $relationClassName::find($itemData['id']);
                $item->update($itemData);

                return $item->id;
            } else {
                return $relationClassName::create($itemData)->id;
            }
        }, $items);
        $model->$relationName()->sync($itemIds);
    }

    protected function removeManyToManyUnnecessaryItems(Model $model, string $relationName, array $items = [])
    {
        foreach ($this->getUnneccessaryModels($model, $relationName, $items) as $model) {
            $model->$relationName()->detach($model->id);
        }
    }

    protected function updateRelatedModels(Model $model, string $relationName, array $items = []): void
    {
        $relationClassName = $model->$relationName()->getRelated();
        $this->removeUnnecessaryItems($model, $relationName, $items);
        // Doesn't work with upsert or updateOrCreate
        $items = array_map(function ($itemData) use($model, $relationName, $relationClassName) {
            if (array_key_exists('id', $itemData)) {
                $item = $relationClassName::find($itemData['id']);
                $item->update($itemData);

                return $item;
            } else {
                try {
                    return $model->$relationName()->create($itemData);
                } catch (\Exception $e) {
                    dd($itemData);
                }
            }
        }, $items);
        $model->$relationName()->saveMany($items);
    }
    
    protected function removeUnnecessaryItems(Model $model, string $relationName, array $items = [])
    {
        foreach ($this->getUnneccessaryModels($model, $relationName, $items) as $model) {
            $model->delete();
        }
    }

    protected function getUnneccessaryModels(Model $model, string $relationName, array $items = [])
    {
        $model->load($relationName);

        $oldItems = array_filter($items, function ($item) {
            return array_key_exists('id', $item);
        });

        $oldItemIds = array_map(function ($item) {
            return $item['id'];
        }, $oldItems);

        return $model->$relationName->filter(function ($relatedModel) use ($oldItemIds) {
            return !in_array($relatedModel->id, $oldItemIds);
        });
    }
}
