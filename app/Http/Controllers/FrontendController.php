<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Settings;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index () {

        $categories = Category::orderBy('name', 'asc')->with('subCategory')->paginate(15);
        $hotProducts = Product::where('product_type', 'Hot')->orderBy('id', 'desc')->paginate(15);
        $newArrivalProducts = Product::where('product_type', 'New')->orderBy('id', 'desc')->paginate(15);
        $regularProducts = Product::where('product_type', 'Regular')->orderBy('id', 'desc')->paginate(15);
        $discountProducts = Product::where('product_type', 'Discount')->orderBy('id', 'desc')->paginate(15);
        $siteSettings = Settings::first();
        return view('frontend.index', compact('hotProducts', 'newArrivalProducts', 'regularProducts', 'discountProducts', 'categories', 'siteSettings'));
    }

    public function categoryProducts ($slug, $id)
    {
        $category = Category::find($id);
        $products = Product::where('cat_id', $id)->get();
        $productsCount = Product::where('cat_id', $id)->count();
        return view('frontend.category-products', compact('products', 'productsCount', 'category'));
    }

    public function subCategoryProducts ($slug, $id)
    {
        $subCategory = SubCategory::find($id);
        $products = Product::where('sub_cat_id', $id)->get();
        $productsCount = Product::where('sub_cat_id', $id)->count();
        return view('frontend.subcategory-products', compact('products', 'productsCount', 'subCategory'));
    }

    public function shopProducts (Request $request) 
    {
        if(isset($request->cat_id)) {
            $products = Product::orderBy('id', 'desc')->where('cat_id', $request->cat_id)->paginate(16);
        }
        elseif(isset($request->sub_cat_id)) {
            $products = Product::orderBy('id', 'desc')->where('sub_cat_id', $request->sub_cat_id)->paginate(16);
        }
        else {
            $products = Product::orderBy('id', 'desc')->paginate(16);
        }
        $productsCount = $products->count();
        return view('frontend.shop', compact('products', 'productsCount'));
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

    public function typeProducts ($type) 
    {
        $products = Product::where('product_type', $type)->get();
        $productsCount = Product::where('product_type', $type)->count();
        return view('frontend.type-products', compact('type', 'products', 'productsCount'));
    }

    public function addToCart (Request $request, $product_id){

        $cartProduct = Cart::where('product_id', $product_id)->where('ip_address', $request->ip())->first();
        $product = Product::find($product_id);

            if ($cartProduct == null){

            $cart = new Cart();

            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = 1 ;

            if($product->discount_price == null){
                $cart->price = $product->regular_price;
            }

            if($product->discount_price !== null){
                $cart->price = $product->discount_price;
            }

            $cart->save();
            toastr()->success('Added to Card successfully!');
            return redirect()->back();  
        }

            elseif($cartProduct != null){
            $cartProduct->qty = 1 + $cartProduct->qty;
            
            if($product->discount_price == null){
                $cartProduct->price = $product->regular_price;
            }

            if($product->discount_price !== null){
            $cartProduct->price = $product->discount_price;
            }

            $cartProduct->save();
            toastr()->success('Added to Card successfully!');
            return redirect()->back();
        }

    }

    public function addToCartDelete ($id) 
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function addToCartDetails (Request $request, $product_id)
    {
        $cartProduct = Cart::where('product_id', $product_id)->where('ip_address', $request->ip())->first();
        $product = Product::find($product_id);

        if ($cartProduct == null){

            $cart = new Cart();

            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = $request->qty;
            $cart->color = $request->color;
            $cart->size = $request->size;

            if($product->discount_price == null){
                $cart->price = $product->regular_price;
            }

            if($product->discount_price !== null){
                $cart->price = $product->discount_price;
            }

            $cart->save();
            if($request->action == "addToCart"){
                return redirect()->back();
            }
            elseif($request->action == "buyNow"){
                return redirect('/checkout');
            }
            
        }

        elseif($cartProduct!=null){
            $cartProduct->qty = $request->qty + $cartProduct->qty;
            $cartProduct->color= $request->color;            
            $cartProduct->size= $request->size;   
            
            if($product->discount_price == null){
                $cartProduct->price = $product->regular_price;
            }

            if($product->discount_price !== null){
                $cartProduct->price = $product->discount_price;
            }

            $cartProduct->save();
            if($request->action == "addToCart"){
                return redirect()->back();
            }
            elseif($request->action == "buyNow"){
                return redirect('/checkout');
            }

        }
        
    }

     public function viewCart () {
        return view('frontend.view-cart');
    }

     public function checkOut () 
     {
        return view('frontend.checkout');
     }

     public function confirmOrder(Request $request)
     {
        $order = new Order();
        $order->ip_address = $request->ip();

        $previousOrder = Order::orderBy('id', 'desc')->first();

        if($previousOrder == null){
            $generateInvoice = "Mawshanmart-1";
            $order->invoice_number = $generateInvoice;
        }

        elseif($previousOrder != null) {
            $generateInvoice = "Mawshanmart-".$previousOrder->id+1;
            $order->invoice_number = $generateInvoice;
        }
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->charge = $request->charge;
        $order->price = $request->inputGrandTotal;

        $cartProducts = Cart::where('ip_address', $request->ip())->get();
        if($cartProducts->isNotEmpty()){
            $order->save();

            foreach($cartProducts as $cart) {
                $orderDetails = new OrderDetails();

                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cart->product_id;
                $orderDetails->color = $cart->color;
                $orderDetails->size = $cart->size;
                $orderDetails->qty = $cart->qty;
                $orderDetails->price = $cart->price;

                $orderDetails->save();
                $cart->delete();
            }

            return redirect('success-order/'.$generateInvoice);
        }
        else{
            return redirect('/');
        }
    
     }

     public function successOrder($invoiceid) 
     {
        return view('frontend.thankyou', compact('invoiceid'));
     }

    public function privacyPolicy () 
    {
        $privacyPolicy = Policy::select('privacy_policy')->first();
        return view('frontend.privacy-policy', compact('privacyPolicy'));
    }

    public function termsCondition () 
    {
        $termsConditions = Policy::select('terms_conditions')->first();
        return view('frontend.terms-condition', compact('termsConditions'));
    }

    public function refundPolicy () 
    {
        $refundsPolicy = Policy::select('refund_policy')->first();
        return view('frontend.refund-policy', compact('refundsPolicy'));
    }

    public function paymentPolicy () 
    {
        $paymentsPolicy = Policy::select('payment_policy')->first();
        return view('frontend.payment-policy', compact('paymentsPolicy'));
    }

    public function aboutUs () 
    {
        $aboutsUs = Policy::select('about_us')->first();
        return view('frontend.about-us', compact('aboutsUs'));
    }

    public function contactUs () 
    {
        return view('frontend.contact-us');
    }

    public function blogPage () 
    {
        return view('frontend.blog-page');
    }

    public function careEr () 
    {
        return view('frontend.careers');
    }
}
