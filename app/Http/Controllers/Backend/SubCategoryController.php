<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function createSubCategory () 
    {
        $categories = Category::all();
        return view('backend.sub-category.create', compact('categories'));
    }

    public function subCategorySave (Request $request)
    {
        $subCategory = new SubCategory();

        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->cat_id = $request->cat_id;

        $subCategory->save();
        return redirect()->back();
    }

    public function subCategoryList ()
    {
        $subCategories = SubCategory::with('category')->get();
        return view('backend.sub-category.list', compact('subCategories'));
    }

    public function subCategoryDelete ($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return redirect()->back();
    }

    public function subCategoryEdit ($id)
    {
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        return view('backend.sub-category.edit', compact('subCategory', 'categories'));
    }

    public function subCategoryUpdate (Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->cat_id = $request->cat_id;

        $subCategory->save();
        return redirect('admin/sub-category/create/list');
    }
    
}
