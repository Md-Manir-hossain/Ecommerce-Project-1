<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index () {

        $categories = Category::orderBy('name', 'asc')->with('subCategory')->get();
        $hotProducts = Product::where('product_type', 'Hot')->orderBy('id', 'desc')->get();
        $newArrivalProducts = Product::where('product_type', 'New')->orderBy('id', 'desc')->get();
        $regularProducts = Product::where('product_type', 'Regular')->orderBy('id', 'desc')->get();
        $discountProducts = Product::where('product_type', 'Discount')->orderBy('id', 'desc')->get();
        return view('frontend.index', compact('hotProducts', 'newArrivalProducts', 'regularProducts', 'discountProducts', 'categories'));
    }

    public function shopProducts () {
        return view('frontend.shop');
    }

     public function returnProcess () {
        return view('frontend.return-process');
    }

    public function productDetails ($slug) 
    {
        $product = Product::where('slug', $slug)->with('color', 'size', 'galleryImage')->first();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('frontend.product-details', compact('product', 'categories'));
    }

    public function typeProducts ($type) {
        return view('frontend.type-products', compact('type'));
    }

     public function viewCart () {
        return view('frontend.view-cart');
    }

     public function checkOut () {
        return view('frontend.checkout');
    }

    public function privacyPolicy () {
        return view('frontend.privacy-policy');
    }

    public function termsCondition () {
        return view('frontend.terms-condition');
    }

    public function refundPolicy () {
        return view('frontend.refund-policy');
    }

    public function paymentPolicy () {
        return view('frontend.payment-policy');
    }

    public function aboutUs () {
        return view('frontend.about-us');
    }

    public function contactUs () {
        return view('frontend.contact-us');
    }

    public function blogPage () {
        return view('frontend.blog-page');
    }

    public function careEr () {
        return view('frontend.careers');
    }
}
