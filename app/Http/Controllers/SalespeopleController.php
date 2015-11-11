<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalespeopleController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /salespeople
    */

    public function getIndex(Request $request) {
        // retreive the products from the table

        $salespeople = \App\Salesperson::orderBy('employee_id')->get();
        $request->session()->put('salespeople',$salespeople);
        return view('salespeople', ['sortOrder' => 'employee_id'], ['salespeople' => $salespeople]);


    }


    public function sortSalespeople(Request $request,$column) {
        //get the collection from the seesion variable
        $products = $request->session()->get('salespeople');
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
        // check if column is either last name or city - need special sort

        if ($column == 'last_name') {
            if ($ord == 'A') {
                $salespeople = $salespeople->sortBy(function($salespeople) {
                    return sprintf('%-12s%s', $salespeople->last_name, $salespeople->first_name);
                });
            } else {
                $salespeople = $salespeople->sortByDesc(function($salespeople) {
                    return sprintf('%-12s%s', $salespeople->last_name, $salespeople->first_name);
                });
            }
        } elseif ($column == 'city') {
            if ($ord == 'A') {
                $salespeople = $salespeople->sortBy(function($salespeople) {
                    return sprintf('%-12s%s', $salespeople->last_name, $salespeople->first_name);
                });
            } else {
                $salespeople = $salespeople->sortByDesc(function($salespeople) {
                    return sprintf('%-12s%s', $salespeople->state, $salespeople->city);
                });
            }
        } else {
            if ($ord == 'A') {
                $salespeople = $salespeople->sortBy($column);
            } else {
                $salespeople = $salespeople->sortByDesc($column);
            }
        }

        $salespeople->values()->all();
        // set the session variable to refelect the current sort
        $request->session()->put('pcol',$column);
        $request->session()->put('pord',$ord);
        return view('salespeople', ['sortOrder' => $column], ['salespeople' => $salespeople]);
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postIndex(Request $request) {

        return view('salespeople');
    }
}
