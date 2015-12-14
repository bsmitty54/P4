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
        $salestransactions = \App\Sales_transaction::orderBy('transaction_date','desc')->take(100)->get();
        $request->session()->flash('show100', 'Showing last 100 transaction by default - use the filter option to see more transactions.');
        $request->session()->put('salestransactions',$salestransactions);
        $request->session()->put('txcol','transaction_date');
        $request->session()->put('txord','A');
        return view('salestransactions',['sortOrder' => 'transaction_date'], ['salestransactions' => $salestransactions]);
    }

    public function getReport() {
        //$html = \View::make('salesreport');
        //return \PDF::loadHTML($html)->download('sales_report.pdf');
        return view('salesreport');
    }

    public function getDashboard() {
        $graphdata = array();
        $query = '';
        $other = '';
        $stat = 'Quantity';
        $fromDate = '';
        $thruDate = '';
        return view('salesdashboard')->with('graphdata',$graphdata)->with('grouping','Product')->with('period','Month To Date')->with('chart','pie')->with('query',$query)->with('stat',$stat)->with('other',$other)->with('fromDate',$fromDate)->with('thruDate',$thruDate);
    }

    public function postDashboard(Request $request) {
        // first load the stats from the database based on user input
        $graphdata = array();
        $period = $request->input('period');
        $grouping = $request->input('grouping');
        $chart = $request->input('chart');
        $stat = $request->input('stat');
        $fromDate = $request->input('fromDate');
        $thruDate = $request->input('thruDate');
        $query = 'SELECT ';
        if($grouping == 'Product') {
            $query = $query . "products.product_name as 'Group',";
        } elseif ($grouping == 'Category') {
            $query = $query . "categories.category_name as 'Group',";
        } else {
            $query = $query . "CONCAT(salespeople.last_name,', ',salespeople.first_name) as 'Group',";
        }
        $query = $query . "sum(quantity) as 'Quantity',";
        $query = $query . "sum(products.price * quantity) as 'Dollars' ";
        $query = $query . "FROM sales_transactions ";
        if($grouping == 'Product') {
            $query = $query . "INNER JOIN products ON sales_transactions.product_id = products.id ";
            $query = $query . " WHERE transaction_date between '" . $fromDate . "' and '" . $thruDate . "' ";
            $query = $query . "GROUP BY product_name";
        } elseif ($grouping == 'Category') {
            $query = $query . "INNER JOIN products ON sales_transactions.product_id = products.id ";
            $query = $query . "INNER JOIN categories ON products.category_id = categories.id ";
            $query = $query . " WHERE transaction_date between '" . $fromDate . "' and '" . $thruDate . "' ";
            $query = $query . "GROUP BY categories.category_name";
        } else {
            $query = $query . "INNER JOIN salespeople ON sales_transactions.salesperson_id = salespeople.id ";
            $query = $query . "INNER JOIN products ON sales_transactions.product_id = products.id ";
            $query = $query . " WHERE transaction_date between '" . $fromDate . "' and '" . $thruDate . "' ";
            $query = $query . "GROUP BY CONCAT(salespeople.last_name,', ',salespeople.first_name)";
        }
        if($stat == 'Quantity') {
            $query = $query . " ORDER BY sum(quantity) DESC";
        } else {
            $query = $query . " ORDER BY sum(products.price * quantity) DESC";
        }


        $graphdata = \DB::select($query);

        // if the result set has more than 10 rows, need to group the results in 10 and higher into category of "other"
        $other = array();
        if (count($graphdata) > 10) {
            $graphdata2 = new \Illuminate\Database\Eloquent\Collection;
            for ($i=0; $i<10; $i++) {
                $graphdata2[$i] = $graphdata[$i];
            }
            $qty = 0;
            $dol = 0;
            for ($i=10; $i<count($graphdata); $i++) {
                $qty = $qty + $graphdata[$i]->Quantity;
                $dol = $dol + $graphdata[$i]->Dollars;
            }

            $other = \DB::select("SELECT 'Other' as 'Group'," . $qty . " as 'Quantity'," . $dol . " as 'Dollars' FROM sales_transactions where id=1");
            $graphdata = $graphdata2;
        }

        return view('salesdashboard')->with('graphdata',$graphdata)->with('grouping',$grouping)->with('period',$period)->with('chart',$chart)->with('query',$query)->with('stat',$stat)->with('other',$other)->with('fromDate',$fromDate)->with('thruDate',$thruDate);
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
         $request->session()->put('salestransactions',$salestransactions);
         return view('salestransactions', ['sortOrder' => $column], ['salestransactions' => $salestransactions]);
     }

     public function postIndex(Request $request) {

         // first retrieve the transaction based on date - if no dates, get most recent 100 transactions
         $this->validate($request, [
             'fromDate' => 'date|before:tomorrow',
             'thruDate' => 'date|after:fromDate',
        ]);
         $fromDate = $request->input('fromDate');
         $thruDate = $request->input('thruDate');
         if ((is_null($fromDate) || ($fromDate == '')) && (is_null($thruDate) || ($thruDate == ''))) {
             // no dates, so get last 100 transactions
            $salestransactions = \App\Sales_transaction::orderBy('transaction_date','desc')->take(100)->get();
            $request->session()->flash('show100', 'Showing last 100 transaction by default - use the filter option to see more transactions.');
        } elseif ((is_null($fromDate) || ($fromDate == ''))) {
            // get tx's before thru date
            $salestransactions = \App\Sales_transaction::where('transaction_date','<=',$thruDate)->orderBy('transaction_date','desc')->get();
        } elseif ((is_null($thruDate) || ($thruDate == ''))) {
            // get tx's before thru date
            $salestransactions = \App\Sales_transaction::where('transaction_date','>=',$fromDate)->orderBy('transaction_date','desc')->get();
        } else {
            // get tx's between both dates
            $salestransactions = \App\Sales_transaction::whereBetween('transaction_date',[$fromDate,$thruDate])->orderBy('transaction_date','desc')->get();
        }

         // now filter the collection as needed based on user input

         // first filter by category
         $cat = $request->input('cat');

         if (isset($cat) && $cat > 0) {

             $filtered = $salestransactions->filter(function ($item) use ($cat) {
                 return $item->product->category->id == $cat;
             });
             $salestransactions = $filtered;
         }

         // now filter by product
         $product = $request->input('product');

         if (isset($product) && $product > 0) {

             $filtered = $salestransactions->filter(function ($item) use ($product) {
                 return $item->product->id == $product;
             });
             $salestransactions = $filtered;
         }

         // now filter by salesperson
         $salesperson = $request->input('salesperson');

         if (isset($salesperson) && $salesperson > 0) {

             $filtered = $salestransactions->filter(function ($item) use ($salesperson) {
                 return $item->salesperson->id == $salesperson;
             });
             $salestransactions = $filtered;
         }

         // now return the view with the filtered list
         $request->session()->put('salestransactions',$salestransactions);
         $pcol = $request->session()->get('pcol');
         return view('salestransactions', ['sortOrder' => $pcol], ['salestransactions' => $salestransactions]);
     }
}
