<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($sortOrder) {
        // retreive the products from the table

        if ($sortOrder == 'Price' ) {
            $products = \App\Product::orderBy('price')->get();
        } elseif ($sortOrder == 'Product ID') {
            $products = \App\Product::orderBy('product_id')->get();
        } elseif ($sortOrder == 'Discount') {
            $products = \App\Product::orderBy('max_discount')->get();
        } else {
            $products = \App\Product::orderBy('product_name')->get();
        }
        return view('products', ['sortOrder' => $sortOrder], ['products' => $products]);
    }


    public function postIndex(Request $request) {

        return view('products');
    }
}
