<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function createCategory()
    {
        return view('backend.Category.category-create');
    }

    public function categorySave(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->image = $request->image;

        if (isset($request->image)) {
            $imageName = rand() . '-category-' . '.' . $request->image->extension();
            $request->image->move('backend/images/category/', $imageName);

            $category->image = $imageName;
        }

        $category->save();
        return redirect('/admin/category/create/list');
    }

    public function categoryList()
    {
        $categories = Category::all();
        return view('backend.Category.category-list', compact('categories'));
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id);
        if ($category->image && file_exists('backend/images/category/' . $category->image)) {
            unlink('backend/images/category/' . $category->image);
        }
        $category->delete();
        return redirect()->back();
    }

    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view('backend.Category.edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if (isset($request->image)) {
            if ($category->image && file_exists('backend/images/category/' . $category->image)) {
                unlink('backend/images/category/' . $category->image);
            }

            $imageName = rand() . '-category-' . '.' . $request->image->extension();
            $request->image->move('backend/images/category/', $imageName);

            $category->image = $imageName;
        }

        $category->save();
        return redirect()->back();
    }

    //
}
