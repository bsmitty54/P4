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
    public function getIndex(Request $request,$pid,$mode) {
        // retreive the products from the table

        if ($mode == 'Add') {
            // instantiate new product model and pass to view
            $product = new \App\Product;
            return view('productedit',['pid' => $pid,'product' => $product,'mode' => $mode, 'request' => $request]);
        } else {
            // retrieve the row from the database, pass id into view
            $products = \App\Product::where('id','=',$pid)->get();
            $product = $products->first();
            return view('productedit',['pid' => $pid,'product' => $product,'mode' => $mode, 'request' => $request]);
        }


    }


    public function postIndex(Request $request,$pid,$mode) {

        if ($mode == 'Delete') {
            // use DB facade to delete the row matching $pid
            \App\Product::destroy($pid);
            $request->session()->flash('message', 'Product ID ' . $request->input('productID') . ' Deleted');
        } else {
            // validate that the product ID is at least 5 characters
            $this->validate($request, [
                'productID' => 'required|min:5',
                'productName' => 'required|min:5',
                'price' => 'required|numeric|min:3|max:100000',
                'discount' => 'required|numeric|min:0|max:30',
                'active' => 'required',
            ]);
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
        $pcol = $request->session()->get('pcol');
        $pord = $request->session()->get('pord');
        $pord = ($pord == 'A' ? 'D' : 'A');
        $request->session()->put('pord',$pord);
        // need to refresh the products collection after changes
        $products = \App\Product::orderBy('product_name')->get();
        // now put the collection in the session variable
        $request->session()->put('products',$products);
        // now direct to the sort route to retain the sort the user had before editing
        return redirect('products/sort/' . $pcol);
    }

    public function showError ($errors,$field) {
        if (isset($errors)) {
            if ($errors->has($field)) {
                echo '<br>';
                echo '<label></label>';
                echo '<span class="msg">';
                echo $errors->first($field);
                echo '</span>';
            }
        }
    }
}
