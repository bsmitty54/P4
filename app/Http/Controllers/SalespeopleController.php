<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalespeopleController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($sortOrder) {
        if ($sortOrder == 'Employee ID' ) {
            $salespeople = \App\Salesperson::orderBy('employee_id')->get();
        } elseif ($sortOrder == 'Address') {
            $salespeople = \App\Salesperson::orderBy('state')->orderBy('city')->orderBy('zip_code')->get();
        } else {
            $salespeople = \App\Salesperson::orderBy('last_name')->orderby('first_name')->get();
        }
        return view('salespeople', ['sortOrder' => $sortOrder], ['salespeople' => $salespeople]);

    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postIndex(Request $request) {

        return view('salespeople');
    }
}
