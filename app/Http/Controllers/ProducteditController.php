<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProducteditController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($pid,$mode) {
        // retreive the products from the table

        if ($mode == 'Add') {
            // instantiate new product model and pass to view
            $product = new \App\Product;
            return view('productedit',['pid' => $pid,'product' => $product,'mode' => $mode]);
        } else {
            // retrieve the row from the database, pass id into view
            $products = \App\Product::where('id','=',$pid)->get();
            $product = $products->first();
            return view('productedit',['pid' => $pid,'product' => $product,'mode' => $mode]);
        }


    }


    public function postIndex(Request $request,$pid,$mode) {

        if ($mode == 'Delete') {
            // use DB facade to delete the row matching $pid
            \App\Product::destroy($pid);
            $request->session()->flash('message', 'Product ID ' . $request->input('productID') . ' Deleted');

        } else {
            // create a model and set the values, then session_save_path
            if($mode == 'Edit') {
                // get the model from the db
                $products = \App\Product::where('id','=',$pid)->get();
                $product = $products->first();
            } else {
                // instantiate a new model
                $product = New \App\Product;
            }
            // now set the model attributes
            $product->product_id = $request->input('productID');
            $product->product_name = $request->input('productName');
            $product->price = $request->input('price');
            $product->max_discount = $request->input('discount');
            $product->active = $request->input('active');
            if($mode == 'Edit') {
                $product->id = $pid;
            }
            $product->save();
            $request->session()->flash('message', 'Product ID ' . $product->product_id . ' Updated / Added');
        }

        return redirect('products/Name');
    }
}
