<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductCategoryRequest;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\ProductCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategories = ProductCategory::all();

        $product_categories = ProductCategory::get();

        return view('admin.productCategories.index', compact('productCategories', 'product_categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent_categories = ProductCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productCategories.create', compact('parent_categories'));
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $request['slug'] = $request->name;
        $productCategory = ProductCategory::create($request->all());

        if ($request->input('photo', false)) {
            $productCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productCategory->id]);
        }

        return redirect()->route('admin.product-categories.index');
    }

    public function edit(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent_categories = ProductCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // dd($parent_categories);

        $productCategory->load('parentCateogry');
        // dd($productCategory->parentCateogry);

        return view('admin.productCategories.edit', compact('parent_categories', 'productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (!$productCategory->photo || $request->input('photo') !== $productCategory->photo->file_name) {
                if ($productCategory->photo) {
                    $productCategory->photo->delete();
                }

                $productCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($productCategory->photo) {
            $productCategory->photo->delete();
        }

        return redirect()->route('admin.product-categories.index');
    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->load('parent_category');

        return view('admin.productCategories.show', compact('productCategory'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCategoryRequest $request)
    {
        ProductCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_category_create') && Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
