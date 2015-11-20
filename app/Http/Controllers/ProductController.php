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
    * Responds to requests to GET /products
    */
    public function getIndex(Request $request) {
        // retreive the products from the table

        $products = \App\Product::orderBy('product_name')->get();
        $request->session()->put('products',$products);
        $request->session()->put('pcol','product_name');
        $request->session()->put('pord','A');
        return view('products', ['sortOrder' => 'product_name'], ['products' => $products]);


    }

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
        if ($column == 'category_id') {
            if ($ord == 'A') {
                $products = $products->sortBy(function($products) {
                    return $products->category->category_name . ',' . $products->product_name;
                });

                } else {
                    $products = $products->sortByDesc(function($products) {
                        return $products->category->category_name . ',' . $products->product_name;
                    });

            }
        } else {
            if ($ord == 'A') {
                $products = $products->sortBy($column);
                } else {
                    $products = $products->sortByDesc($column);
            }
        }
        $products->values()->all();
        // set the session variable to refelect the current sort
        $request->session()->put('pcol',$column);
        $request->session()->put('pord',$ord);
        return view('products', ['sortOrder' => $column], ['products' => $products]);
    }


    public function postIndex(Request $request) {

        // first retrieve the product catalog

        $products = \App\Product::orderBy('product_name')->get();
        // now filter the collection as needed based on user input

        //first filter on name / id if user entered a string
        $pmatch = strtolower($request->input('product'));

        if (isset($pmatch) && $pmatch != '') {
            $filtered = $products->filter(function ($item) use ($pmatch) {
                return (is_int(strpos(strtolower($item->product_name),$pmatch)) || is_int(strpos(strtolower($item->product_id),$pmatch)));
            });
            $products = $filtered;
        }

        //now filter on active if not set to "Both"
        $active = $request->input('active');
        if ($active == 1) {
            // show only active
            $filtered = $products->filter(function ($item) {
                return $item->active == 1;
            });
            $products = $filtered;
        } elseif ($active == 0) {
            // show only active
            $filtered = $products->filter(function ($item) {
                return $item->active == 0;
            });
            $products = $filtered;
        }

        // now filter by category
        $cat = $request->input('cat');

        if (isset($cat) && $cat > 0) {

            $filtered = $products->filter(function ($item) use ($cat) {
                return $item->category_id == $cat;
            });
            $products = $filtered;
        }

        // now return the view with the filtered list
        $request->session()->put('products',$products);
        $pcol = $request->session()->get('pcol');

        return view('products', ['sortOrder' => $pcol], ['products' => $products]);
    }
}
