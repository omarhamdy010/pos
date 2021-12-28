<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use \Intervention\Image\Facades\Image;


class ProductController extends Controller
{

    public function index(Product $product, Request $request)
    {
        $categories = Category::all();

        $products = Product::When($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->When($request->category_id, function ($quary) use ($request) {

            return $quary->where('category_id', $request->category_id);

        })->paginate(4);


        return view('Dashboard.products.index', compact('products', 'categories'));
    }

    public function create(Product $products)
    {
        $categories = Category::all();
        return view('Dashboard.products.create', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
        ];
        foreach (config('translatable.locales') as $local) {
            $rules += [$local . '.name' => 'required|unique:product_translations,name'];
            $rules += [$local . '.description' => 'required'];
        }

        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ];
        $request->validate($rules);
        $data = $request->all();

        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('uploads/products_image/' . $request->image->hashName()));
            $data['image'] = $request->image->hashName();

        }
        Product::create($data);
        Session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id' => 'required'
        ];
        foreach (config('translatable.locales') as $local) {
            $rules += [$local . '.name' =>  [Rule::unique('product_translations', 'name')->ignore($product->id, 'product_id')]];
            $rules += [$local . '.description' => 'required'];
        }
        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ];
        $request->validate($rules);
        $data = $request->all();

        if ($request->image) {

            if ($product->image != 'default1.png')
            {
                Storage::disk('public_uploads')->delete('/products_image/' . $product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('uploads/products_image/' . $request->image->hashName()));
            $data['image'] = $request->image->hashName();

        }
        $product->update($data);

        Session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.products.index')->with('success', __('site.edit_successfully'));
    }


    public function destroy(Product $product)
    {
        if ($product->image != 'default1.png') {
            Storage::disk('public_uploads')->delete('/products_image/' . $product->image);
        }

        $product->delete();

        Session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.products.index')->with('success', __('site.deleted_successfully'));

    }
}
