<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UsereditController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex(Request $request,$uid,$mode) {
        // retreive the users from the table

        if ($mode == 'Add') {
            // instantiate new user model and pass to view
            $user = new \App\User;
            return view('useredit',['uid' => $uid,'user' => $user,'mode' => $mode, 'request' => $request]);
        } else {
            // retrieve the row from the database, pass id into view
            $users = \App\User::where('id','=',$uid)->get();
            $user = $users->first();
            return view('useredit',['uid' => $uid,'user' => $user,'mode' => $mode, 'request' => $request]);
        }


    }


    public function postIndex(Request $request,$uid,$mode) {

        if ($mode == 'Delete') {
            // use DB facade to delete the row matching $pid
            \App\User::destroy($uid);
            $request->session()->flash('message', 'User ' . $request->input('lastName') . ', ' . $request->input('firstName') . ' Deleted');
        } else {

            $this->validate($request, [
                'lastName' => 'required|min:2',
                'firstName' => 'required|min:2',
                'email' => 'required|email',
                'password' => 'confirmed|min:8|max:16',
                'role' => 'required',
            ]);


            // create a model and set the values, then session_save_path
            if($mode == 'Edit') {
                // get the model from the db
                $users = \App\User::where('id','=',$uid)->get();
                $user = $users->first();
            } else {
                // instantiate a new model
                $user = New \App\User;
            }
            // now set the model attributes
            $user->last_name = $request->input('lastName');
            $user->first_name = $request->input('firstName');
            $user->email = $request->input('email');
            $pwd = $request->input('password');
            if (isset($pwd) && ($pwd != '')) {
                $user->password = \Hash::make($request->input('password'));
            } else {
                $user->password = '';
            }

            $user->role = $request->input('role');
            if($mode == 'Edit') {
                $user->id = $uid;
            }
            $user->save();
            $request->session()->flash('message', 'User ' . $request->input('lastName') . ', ' . $request->input('firstName') . ' Updated / Added');
        }
        $ucol = $request->session()->get('ucol');
        $uord = $request->session()->get('uord');
        $uord = ($uord == 'A' ? 'D' : 'A');
        $request->session()->put('uord',$uord);
        // need to refresh the users collection after changes
        $users = \App\User::orderBy('last_name')->orderBy('first_name')->get();
        // now put the collection in the session variable
        $request->session()->put('users',$users);
        // now direct to the sort route to retain the sort the user had before editing
        return redirect('users/sort/' . $ucol);
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
