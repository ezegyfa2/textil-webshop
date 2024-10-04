<?php

namespace App\Http\Controllers;

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
}
