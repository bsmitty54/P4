<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalestransactioneditController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($txid,$mode) {
        // retreive the products from the table

        if ($mode == 'Add') {
            // instantiate new product model and pass to view
            $salestransaction = new \App\Sales_transaction;
            return view('salestransactionedit',['txid' => $txid,'salestransaction' => $salestransaction,'mode' => $mode]);
        } else {
            // retrieve the row from the database, pass id into view
            $salestransactions = \App\Sales_transaction::where('id','=',$txid)->get();
            $salestransaction = $salestransactions->first();
            return view('salestransactionedit',['txid' => $txid,'salestransaction' => $salestransaction,'mode' => $mode]);
        }


    }


    public function postIndex(Request $request,$txid,$mode) {

        if ($mode == 'Delete') {
            // use DB facade to delete the row matching $pid
            $salestransactions = \App\Sales_transaction::where('id','=',$txid)->get();
            $salestransaction = $salestransactions->first();
            \App\Sales_transaction::destroy($txid);
            $request->session()->flash('message', 'Sales Transaction for ' . $salestransaction->salesperson->last_name . ', ' . $salestransaction->salesperson->first_name . ' on ' . $request->input('transactionDate') . ' Deleted');

        } else {

            // create a model and set the values, then session_save_path
            $this->validate($request, [
                'transactionDate' => 'required|min:5',
                'product' => 'required',
                'salesperson' => 'required',
                'discount' => 'required|numeric|min:0',
                'quantity' => 'required|numeric|min:1',
            ]);
            if($mode == 'Edit') {
                // get the model from the db
                $salestransactions = \App\Sales_transaction::where('id','=',$txid)->get();
                $salestransaction = $salestransactions->first();
            } else {
                // instantiate a new model
                $salestransaction = New \App\Sales_transaction;
            }
            // now set the model attributes
            $salestransaction->transaction_date = $request->input('transactionDate');
            $salestransaction->product_id = $request->input('product');
            $salestransaction->salesperson_id = $request->input('salesperson');
            $salestransaction->quantity = $request->input('quantity');
            $salestransaction->discount = $request->input('discount');
            $salestransaction->comments = $request->input('comments');
            if($mode == 'Edit') {
                $salestransaction->id = $txid;
            }
            $salestransaction->save();
            $request->session()->flash('message', 'Sales Transaction for ' . $salestransaction->salesperson->last_name . ', ' . $salestransaction->salesperson->first_name . ' on ' . $request->input('transactionDate') . ' Updated / Added');
        }
        $txcol = $request->session()->get('txcol');
        $txord = $request->session()->get('txord');
        $txord = ($txord == 'A' ? 'D' : 'A');
        $request->session()->put('txord',$txord);
        // need to refresh the products collection after changes
        $salestransactions = \App\Sales_transaction::orderBy('transaction_date','desc')->take(100)->get();
        $request->session()->flash('show100', 'Showing last 100 transaction by default - use the filter option to see more transactions.');
        // now put the collection in the session variable
        $request->session()->put('salestransactions',$salestransactions);
        // now direct to the sort route to retain the sort the user had before editing
        return redirect('salestransactions/sort/' . $txcol);
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
