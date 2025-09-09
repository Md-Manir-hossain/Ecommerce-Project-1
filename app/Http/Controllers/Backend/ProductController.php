<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function productCategory ()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $subCategories = SubCategory::orderBy('name', 'asc')->get();
        return view('backend.product.create', compact('categories', 'subCategories'));
    }

    public function productSave (Request $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->cat_id = $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->regular_price = $request->regular_price;
        $product->discount_price = $request->discount_price;
        $product->buying_price = $request->buying_price;
        $product->qty = $request->qty;
        $product->sku_code = $request->sku_code;
        $product->product_type = $request->product_type;
        $product->description = $request->description;
        $product->product_policy = $request->product_policy;

         if (isset($request->image)) {
            $imageName = rand() . '-product-' . '.' . $request->image->extension();
            $request->image->move('backend/images/product/', $imageName);

            $product->image = $imageName;
        }

        $product->save();
        //Add Color........
        if(isset($request->color_name) && $request->color_name[0] != null){
            foreach($request->color_name as $singleColor){//green
                $color = new Color();
                $color->color_name = $singleColor;
                $color->slug = Str::slug($singleColor);
                $color->product_id = $product->id;
                $color->save();
            }
        }

          //Add Size........
        if(isset($request->size_name) && $request->size_name[0] != null){
            foreach($request->size_name as $singleSize){
                $size = new Size();
                $size->size_name = $singleSize;
                $size->slug = Str::slug($singleSize);
                $size->product_id = $product->id;
                $size->save();
            }
        }

        //GalleryImage.................

        if(isset($request->gallery_image)){
            foreach($request->gallery_image as $singleImage){
                $galleryImage = new GalleryImage();

                $galleryImage->product_id = $product->id;

                $imageName = rand().'-galleryImage'.'.'.$singleImage->extension();
                $singleImage->move('backend/images/galleryimage/',$imageName);

                $galleryImage->image = $imageName;
                $galleryImage->save();
                
            }
        }

        return redirect()->back();

    }

    public function productList ()
    {
        $products = Product::get();
        return view('backend.product.list', compact('products'));
    }

     public function productDelete($id)
    {
        $product = Product::find($id);
        if ($product->image && file_exists('backend/images/product/'.$product->image)) {
            unlink('backend/images/product/'.$product->image);
        }
        $product->delete();
        return redirect()->back();
    }

    public function productEdit($id)
    {
        $product = Product::find($id);
        return view('backend.product.edit', compact('product'));
    }



    public function productUpdate(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);

        if (isset($request->image)) {
            if ($product->image && file_exists('backend/images/product/'.$product->image)) {
                unlink('backend/images/product/' . $product->image);
            }

            $imageName = rand() . '-product-' . '.' . $request->image->extension();
            $request->image->move('backend/images/product/', $imageName);

            $product->image = $imageName;
        }

        $product->save();
        return redirect()->back();
    }
}
