<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
        return view('products');
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postIndex(Request $request) {

        return view('products');
    }
}
