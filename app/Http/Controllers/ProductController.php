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
    public function getIndex(Request $request) {
        // retreive the products from the table

        $products = \App\Product::orderBy('product_name')->get();
        $request->session()->put('products',$products);
        $request->session()->put('pcol','product_name');
        $request->session()->put('pord','A');
        return view('products', ['sortOrder' => 'product_name'], ['products' => $products]);


    }

    //if ($sortOrder == 'Price' ) {
    //    $products = \App\Product::orderBy('price')->get();
    //} elseif ($sortOrder == 'Product ID') {
    //    $products = \App\Product::orderBy('product_id')->get();
    //} elseif ($sortOrder == 'Discount') {
    //    $products = \App\Product::orderBy('max_discount')->get();
    //} else {
    //    $products = \App\Product::orderBy('product_name')->get();
    //}


    // set the session variable


    public function sortProducts(Request $request,$column) {
        //get the collection from the seesion variable
        $products = $request->session()->get('products');
        // now sort the collection
        // first check the session variable to see if we are sorting on the same column
        // if so, reverse the sort
        $pcol = $request->session()->get('pcol');
        $pord = $request->session()->get('pord');
        $ord = 'A';
        if ($pcol == $column) {
            if ($pord == 'A') {
                $ord = 'D';
            }
        }
        if ($ord == 'A') {
                $products = $products->sortBy($column);
            } else {
                $products = $products->sortByDesc($column);
            }
        $products->values()->all();
        // set the session variable to refelect the current sort
        $request->session()->put('pcol',$column);
        $request->session()->put('pord',$ord);
        return view('products', ['sortOrder' => $column], ['products' => $products]);
    }


    public function postIndex(Request $request) {

        return view('products');
    }
}
