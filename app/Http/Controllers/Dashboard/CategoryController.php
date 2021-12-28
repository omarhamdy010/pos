<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
//                if($request->search)
//        {
//                $categories=Category::Where('name','like','%'.$request->search.'%')
//
//                    ->latest()->paginate(5);
//        }
//        else
//        {
//            $categories = Category::latest()->paginate(4);
//        }
        $categories = Category::When($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name','%' . $request->search . '%');
        })->latest()->paginate(4);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'ar.*' => 'required|unique:category_translations,name',
            'en.*' => 'required|unique:category_translations,name'
        ]);
        Category::create($request->all());
        Session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {

        return view('dashboard.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $rules = [];
        foreach (config('translatable.locales') as $local) {
            $rules += [$local . 'name' => [Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
      }
        $request->validate($rules);
        $category->update($request->all());
        Session::flash('success', 'site.updated_successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');

    }
}
