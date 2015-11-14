<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesTransactionController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex(Request $request) {
        $salestransactions = \App\Sales_transaction::orderBy('transaction_date')->get();
        $request->session()->put('salestransactions',$salestransactions);
        $request->session()->put('txcol','transaction_date');
        $request->session()->put('txord','A');
        return view('salestransactions',['sortOrder' => 'transaction_date'], ['salestransactions' => $salestransactions]);
    }

    /**
     * Responds to requests to POST /books/create
     */

     public function sortSalestransactions(Request $request,$column) {
         //get the collection from the seesion variable
         $salestransactions = $request->session()->get('salestransactions');
         // now sort the collection
         // first check the session variable to see if we are sorting on the same column
         // if so, reverse the sort
         $txcol = $request->session()->get('txcol');
         $txord = $request->session()->get('txord');
         $ord = 'A';
         if ($txcol == $column) {
             if ($txord == 'A') {
                 $ord = 'D';
             }
         }
         // check if column is either last name or city - need special sort

         if ($column == 'salesperson_name') {
             if ($ord == 'A') {
                 $salestransactions = $salestransactions->sortBy(function($salestransactions) {
                     return $salestransactions->salesperson->last_name . ',' . $salestransactions->salesperson->first_name . ' ' . $salestransactions->transaction_date;
                 });
             } else {
                 $salestransactions = $salestransactions->sortByDesc(function($salestransactions) {
                     return $salestransactions->salesperson->last_name . ',' . $salestransactions->salesperson->first_name . ' ' . $salestransactions->transaction_date;
                 });
             }
         } elseif ($column == 'product_id') {
             if ($ord == 'A') {
                 $salestransactions = $salestransactions->sortBy(function($salestransactions) {
                     return $salestransactions->product->product_id . ' ' . $salestransactions->transaction_date;
                 });
             } else {
                 $salestransactions = $salestransactions->sortByDesc(function($salestransactions) {
                     return $salestransactions->product->product_id . ' ' . $salestransactions->transaction_date;
                 });
             }
         } elseif ($column == 'product_name') {
             if ($ord == 'A') {
                 $salestransactions = $salestransactions->sortBy(function($salestransactions) {
                     return $salestransactions->product->product_name . ' ' . $salestransactions->transaction_date;
                 });
             } else {
                 $salestransactions = $salestransactions->sortByDesc(function($salestransactions) {
                     return $salestransactions->product->product_name . ' ' . $salestransactions->transaction_date;
                 });
             }
         } elseif ($column == 'total') {
             if ($ord == 'A') {
                 $salestransactions = $salestransactions->sortBy(function($salestransactions) {
                     return $salestransactions->quantity * $salestransactions->product->price;
                 });
             } else {
                 $salestransactions = $salestransactions->sortByDesc(function($salestransactions) {
                     return $salestransactions->quantity * $salestransactions->product->price;
                 });
             }
         } else {
             if ($ord == 'A') {
                 $salestransactions = $salestransactions->sortBy($column);
             } else {
                 $salestransactions = $salestransactions->sortByDesc($column);
             }
         }

        $salestransactions->values()->all();
         // set the session variable to refelect the current sort
         $request->session()->put('txcol',$column);
         $request->session()->put('txord',$ord);
         return view('salestransactions', ['sortOrder' => $column], ['salestransactions' => $salestransactions]);
     }

    public function postIndex(Request $request) {

        return view('salestransactions',['sortOrder' => 'transaction_date'], ['salestransactions' => $salestransactions]);
    }
}
