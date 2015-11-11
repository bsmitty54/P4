<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalespersonController extends Controller {

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
        $request->session()->put('scol','last_name');
        $request->session()->put('sord','A');
        return view('salespeople', ['sortOrder' => 'employee_id'], ['salespeople' => $salespeople]);

    }


    public function sortSalespeople(Request $request,$column) {
        //get the collection from the seesion variable
        $salespeople = $request->session()->get('salespeople');
        // now sort the collection
        // first check the session variable to see if we are sorting on the same column
        // if so, reverse the sort
        $scol = $request->session()->get('scol');
        $sord = $request->session()->get('sord');
        $ord = 'A';
        if ($scol == $column) {
            if ($sord == 'A') {
                $ord = 'D';
            }
        }
        // check if column is either last name or city - need special sort

        if ($column == 'last_name') {
            if ($ord == 'A') {
                $salespeople = $salespeople->sortBy(function($salespeople) {
                    return $salespeople->last_name . ',' . $salespeople->first_name;
                });
            } else {
                $salespeople = $salespeople->sortByDesc(function($salespeople) {
                    return $salespeople->last_name . ',' . $salespeople->first_name;
                });
            }
        } elseif ($column == 'city') {
            if ($ord == 'A') {
                $salespeople = $salespeople->sortBy(function($salespeople) {
                    return $salespeople->state . ',' . $salespeople->city;
                });
            } else {
                $salespeople = $salespeople->sortByDesc(function($salespeople) {
                    return $salespeople->state . ',' . $salespeople->city;
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
        $request->session()->put('scol',$column);
        $request->session()->put('sord',$ord);
        return view('salespeople', ['sortOrder' => $column], ['salespeople' => $salespeople]);
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postIndex(Request $request) {

        return view('salespeople');
    }
}
