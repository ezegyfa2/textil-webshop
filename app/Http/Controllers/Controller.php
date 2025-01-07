<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Closure;

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

    protected function updateManyToManyRelatedModels(
        Model $model,
        string $relationName,
        array $items = [],
        Closure $afterRelatedModelCreated = null
    ): void {
        $relationClassName = $this->getRelatedClassName($model, $relationName);
        // Doesn't work with upsert or updateOrCreate
        $itemIds = array_map(function ($itemData) use($model, $relationName, $relationClassName, $afterRelatedModelCreated) {
            $relatedModel = $this->getManyToManyRelatedModel($model, $relationClassName, $itemData);
            if ($afterRelatedModelCreated) {
                $afterRelatedModelCreated($relatedModel, $itemData);
            }

            return $relatedModel->id;
        }, $items);
        $model->$relationName()->sync($itemIds);
    }

    protected function getManyToManyRelatedModel(Model $model, string $relationClassName, array $itemData): Model
    {
        if (array_key_exists('id', $itemData)) {
            $item = $relationClassName::find($itemData['id']);
            unset($itemData['id']);
            $item->update($itemData);

            return $item;
        } else {
            return $relationClassName::create($itemData);
        }
    }

    protected function removeManyToManyUnnecessaryItems(Model $model, string $relationName, array $items = [])
    {
        foreach ($this->getUnneccessaryModels($model, $relationName, $items) as $model) {
            $model->$relationName()->detach($model->id);
        }
    }

    protected function updateRelatedModels(
        Model $model,
        string $relationName,
        array $items = [],
        Closure $afterRelatedModelCreated = null
    ): void {
        $relationClassName = $this->getRelatedClassName($model, $relationName);
        $this->removeUnnecessaryItems($model, $relationName, $items);
        // Doesn't work with upsert or updateOrCreate
        $items = array_map(function ($itemData) use ($model, $relationName, $relationClassName, $afterRelatedModelCreated) {
            $relatedModel = $this->getRelatedModel($itemData, $model, $relationName, $relationClassName);
            if ($afterRelatedModelCreated) {
                $afterRelatedModelCreated($relatedModel, $itemData);
            }

            return $relatedModel;
        }, $items);
        $model->$relationName()->saveMany($items);
    }

    protected function getRelatedModel($itemData, Model $model, string $relationName, string $relationClassName): Model
    {
        if (array_key_exists('id', $itemData)) {
            $item = $relationClassName::find($itemData['id']);
            unset($itemData['id']);
            $item->update($itemData);

            return $item;
        } else {
            return $model->$relationName()->create($itemData);
        }
    }

    protected function updateComboboxModels(Model $model, string $relationName, array $items = [], string $mainColumnName = 'name')
    {
        $relationClassName = $model->$relationName()->getRelated();
        $this->removeUnnecessaryItems($model, $relationName, $items);
        // Doesn't work with upsert or updateOrCreate
        $items = array_map(function ($itemData) use($model, $relationName, $relationClassName, $mainColumnName) {
            if (array_key_exists('id', $itemData)) {
                $item = $relationClassName::find($itemData['id']);
                unset($itemData['id']);
                $item->update($itemData);

                return $item;
            } else if (is_array($itemData)) {
                return $model->$relationName()->create($itemData);
            } else {
                return $model->$relationName()->create([
                    $mainColumnName => $itemData
                ]);
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

    protected function createDataFromComboboxValues(array $items, string $mainColumnName = 'name')
    {
        return array_map(function ($item) use ($mainColumnName) {
            if (is_array($item)) {
                return $item;
            } else {
                return [
                    $mainColumnName => $item,
                ];
            }
        }, $items);
    }

    protected function getUnneccessaryModels(Model $model, string $relationName, array $items = [])
    {
        $model->load($relationName);

        $oldItems = array_filter($items, function ($item) {
            return is_array($item) && array_key_exists('id', $item);
        });

        $oldItemIds = array_map(function ($item) {
            return $item['id'];
        }, $oldItems);

        return $model->$relationName->filter(function ($relatedModel) use ($oldItemIds) {
            return !in_array($relatedModel->id, $oldItemIds);
        });
    }

    protected function getRelatedClassName(Model $model, string $relationName): string
    {
        $relationClassName = $model->$relationName()->getRelated();
        if (gettype($relationClassName) != 'string') {
            $relationClassName = get_class($relationClassName);
        }
        return $relationClassName;
    }

    protected function updateImage(Model $model, array $imageData): void
    {
        $model->load('image');
        if ($imageData) {
            $imageData['relative_path'] = str_replace('/storage/uploads/', '', $imageData['url']);
            if ($model->image) {
                if ($imageData['relative_path'] != $model->image->relative_path) {
                    $model->image->update(['relative_path' => $imageData['relative_path']]);
                    $model->image->moveFromUploads();
                    $model->image->createResizedVersions();
                }
            } else {
                $model->image()->save(['relative_path' => $imageData['relative_path']]);
                $model->image->moveFromUploads();
                $model->image->createResizedVersions();
            }
        }
    }
}
