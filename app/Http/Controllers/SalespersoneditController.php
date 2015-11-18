<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalespersoneditController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($sid,$mode) {
        // retreive the salespeople from the table

        if ($mode == 'Add') {
            // instantiate new salesperson model and pass to view
            $salesperson = new \App\Salesperson;
            return view('salespersonedit',['sid' => $sid,'salesperson' => $salesperson,'mode' => $mode]);
        } else {
            // retrieve the row from the database, pass id into view
            $salespeople = \App\Salesperson::where('id','=',$sid)->get();
            $salesperson = $salespeople->first();
            return view('salespersonedit',['sid' => $sid,'salesperson' => $salesperson,'mode' => $mode]);
        }


    }


    public function postIndex(Request $request,$sid,$mode) {

        if ($mode == 'Delete') {
            // use DB facade to delete the row matching $sid
            \App\Salesperson::destroy($sid);
            $request->session()->flash('message', 'Employee ID ' . $request->input('employee_id') . ' Deleted');

        } else {
            $this->validate($request, [
                'employeeID' => 'required|min:5',
                'lastName' => 'required|min:2',
                'firstName' => 'required|min:2',
                'street1' => 'required|min:5',
                'city' => 'required|min:2',
                'state' => 'required|size:2',
                'zipCode' => 'required',
                'email' => 'email',
                'hireDate' => 'required|date',
                'terminationDate' => 'date',
            ]);
            // create a model and set the values, then session_save_path
            if($mode == 'Edit') {
                // get the model from the db
                $salespeople = \App\Salesperson::where('id','=',$sid)->get();
                $salesperson = $salespeople->first();
            } else {
                // instantiate a new model
                $salesperson = New \App\Salesperson;
            }
            // now set the model attributes
            $salesperson->employee_id = $request->input('employeeID');
            $salesperson->last_name = $request->input('lastName');
            $salesperson->first_name = $request->input('firstName');
            $salesperson->street1 = $request->input('street1');
            $salesperson->street2 = $request->input('street2');
            $salesperson->city = $request->input('city');
            $salesperson->state = $request->input('state');
            $salesperson->zip_code = $request->input('zipCode');
            $salesperson->email = $request->input('email');
            $salesperson->hire_date = $request->input('hireDate');
            $salesperson->termination_date = $request->input('terminationDate');
            if($mode == 'Edit') {
                $salesperson->id = $sid;
            }
            $salesperson->save();
            $request->session()->flash('message', 'Salesperson ID ' . $salesperson->employee_id . ' Updated / Added');
        }
        $scol = $request->session()->get('scol');
        $sord = $request->session()->get('sord');
        $sord = ($sord == 'A' ? 'D' : 'A');
        $request->session()->put('sord',$sord);
        // need to refresh the salespeople collection after changes
        $salespeople = \App\Salesperson::orderBy('last_name')->get();
        // now put the collection in the session variable
        $request->session()->put('salespeople',$salespeople);
        // now direct to the sort route to retain the sort the user had before editing
        return redirect('salespeople/sort/' . $scol);
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
