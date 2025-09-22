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

    public function productList()
    {
        $products = Product::with('category', 'subCategory')->get();
        return view('backend.product.list', compact('products'));
    }

     public function productDelete($id)
    {
        $product = Product::find($id);

        if ($product->image && file_exists('backend/images/product/'.$product->image)) {
            unlink('backend/images/product/'.$product->image);
        }

        //Color delete.....
        $colors = Color::where('product_id', $product->id)->get();
        foreach($colors as $color) {
            $color->delete();
        }

        //Size delete.....
        $sizes = Size::where('product_id', $product->id)->get();
        foreach($sizes as $size) {
            $size->delete();
        }

        //Gallery Images delete.....
        $galleryImages = GalleryImage::where('product_id', $product->id)->get();
        foreach($galleryImages as $singleImage) {

            if($singleImage->image && file_exists('backend/images/galleryimage/'.$singleImage->image)){
                unlink('backend/images/galleryimage/'.$singleImage->image);
                }

            $singleImage->delete();
        }

        $product->delete();
        return redirect()->back();

        }

             public function productEdit($id)
    {
        $product = Product::where('id', $id)->with('color', 'size', 'galleryImage')->first();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('backend.product.edit', compact('product', 'categories', 'subCategories'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::find($id);

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

        if(isset($request->image)){

             if ($product->image && file_exists('backend/images/product/'.$product->image)) {
            unlink('backend/images/product/'.$product->image);
        }

         $imageName = rand() . '-product-' . '.' . $request->image->extension();
            $request->image->move('backend/images/product/', $imageName);

            $product->image = $imageName;

        }

         $product->save();

          //Add Color........
        if(isset($request->color_name) && $request->color_name[0] != null){

            $colors = Color::where('product_id', $product->id)->get();
            foreach($colors as $singleColor){
                $singleColor->delete();
            }

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

            $sizes = Size::where('product_id', $product->id)->get();
            foreach($sizes as $singleSize){
                $singleSize->delete();
            }



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
            
            $galleryImages = GalleryImage::where('product_id', $product->id)->get();

            foreach($galleryImages as $singleImage) {
                 if($singleImage->image && file_exists('backend/images/galleryimage/'.$singleImage->image)){
                unlink('backend/images/galleryimage/'.$singleImage->image);
                }

                $singleImage->delete();
            }





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

    public function colorDelete ($id) {

        $color = Color::find($id);
        $color->delete();

        return redirect()->back();

    }


    public function sizeDelete ($id) {

        $size = Size::find($id);
        $size->delete();

        return redirect()->back();

    }

    public function galleryImageDelete ($id)
    {
        $galleryImage = GalleryImage::find($id);

             if ($galleryImage->image && file_exists('backend/images/galleryimage/'.$galleryImage->image)) {
            unlink('backend/images/galleryimage/'.$galleryImage->image);
        }

        $galleryImage->delete();
        return redirect()->back();
    }

    public function galleryImageEdit ($id)
    {
        $galleryImage = GalleryImage::with('product')->where('id', $id)->first();
        return view('backend.product.edit-galleryimage', compact('galleryImage'));
    }

    public function galleryImageUpdate (Request $request, $id)
    {
        $galleryImage = GalleryImage::find($id);

        if(isset($request->image)){
                 if($galleryImage->image && file_exists('backend/images/galleryimage/'.$galleryImage->image)){
                unlink('backend/images/galleryimage/'.$galleryImage->image);
                }
                  $imageName = rand().'-galleryImage'.'.'.$request->image->extension();
                  $request->image->move('backend/images/galleryimage/',$imageName);
        }

        $galleryImage->image = $imageName;
        $galleryImage->save();

        return redirect('/admin/product/create/edit/'.$galleryImage->product_id);

    }

    }

    



    //  public function productUpdate(Request $request, $id)
    // {
    //     $product = Product::find($id);

    //     $product->name = $request->name;
    //     $product->slug = Str::slug($request->name);

    //     if (isset($request->image)) {
    //         if ($product->image && file_exists('backend/images/product/'.$product->image)) {
    //             unlink('backend/images/product/' . $product->image);
    //         }

    //         $imageName = rand() . '-product-' . '.' . $request->image->extension();
    //         $request->image->move('backend/images/product/', $imageName);

    //         $product->image = $imageName;
    //     }

    //     $product->save();
    //     return redirect()->back();
    // }



