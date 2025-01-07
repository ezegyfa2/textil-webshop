<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product\Brand;
use App\Models\Product\BrandImage;
use App\Http\Resources\Admin\Brand\BrandFetchResource;
use App\Http\Resources\Admin\Brand\BrandResource;
use App\Http\Requests\Admin\Brand\BrandFetchRequest;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    public function fetch(Request $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            BrandFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('Admin/Brand/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Brand/Create');
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        $this->save($request, new Brand);

        return redirect()->route('admin.brand.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Categoria de produse a fost creată cu succes',
                ],
            ],
        ]);
    }

    public function edit(Brand $brand): Response
    {
        $brand->load('image');

        return Inertia::render('Admin/Brand/Edit', [
            'brand' => new BrandResource($brand),
        ]);
    }

    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        $this->save($request, $brand);

        return redirect()->route('admin.brand.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Categoria de produse a fost modificat cu succes',
                ],
            ],
        ]);
    }

    protected function save(BrandRequest $request, Brand $brand): void
    {
        $brand->fill($request->except('image'));
        $brand->save();
        $brand->load('image');
        $image = $request->get('image');
        if ($image) {
            if ($brand->image) {
                $brand->image->update([
                    'relative_path' => str_replace('/storage/uploads/', '', $image['url']),
                ]);
            } else {
                $image = BrandImage::create([
                    'relative_path' => str_replace('/storage/uploads/', '', $image['url']),
                ]);
                $brand->image_id = $image->id;
            }
        }
        $brand->image->createResizedVersions();
    }

    public function delete(Brand $brand): JsonResponse
    {
        $brand->delete();

        return response()->json('Produsul a fost eliminată cu succes');
    }

    public function uploadImage(ImageUploadRequest $request): JsonResponse
    {
        $path = $request->file('image')->store('public/uploads');

        return response()->json(Storage::url($path));
    }

    public function deleteImage(BrandImage $brandImage): JsonResponse
    {
        $brandImage->delete();

        return response()->json('A kép sikeresen el lett távolítva');
    }

    protected function getFetchQuery(Request $request): Builder
    {
        $search = $request->input('search', '');

        $query = Brand::latest();

        if ($search) {
            $query = $query->where('name', 'LIKE', "%$search%");
        }

        return $query;
    }
}
