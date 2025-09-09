<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index () {
        return view('frontend.index');
    }

    public function shopProducts () {
        return view('frontend.shop');
    }

     public function returnProcess () {
        return view('frontend.return-process');
    }

    public function productDetails () {
        return view('frontend.product-details');
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
