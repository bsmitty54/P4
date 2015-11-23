<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /users
    */
    public function getIndex(Request $request) {
        // retreive the users from the table

        $users = \App\User::orderBy('last_name')->orderBy('first_name')->get();
        $request->session()->put('users',$users);
        $request->session()->put('ucol','last_name');
        $request->session()->put('uord','A');
        return view('users', ['sortOrder' => 'last_name'], ['users' => $users]);


    }

    public function sortusers(Request $request,$column) {
        //get the collection from the seesion variable
        $users = $request->session()->get('users');
        // now sort the collection
        // first check the session variable to see if we are sorting on the same column
        // if so, reverse the sort
        $ucol = $request->session()->get('ucol');
        $uord = $request->session()->get('uord');
        $ord = 'A';
        if ($ucol == $column) {
            if ($uord == 'A') {
                $ord = 'D';
            }
        }
        if ($column == 'last_name') {
            if ($ord == 'A') {
                $users = $users->sortBy(function($users) {
                    return $users->last_name . ',' . $users->first_name;
                });

                } else {
                    $users = $users->sortByDesc(function($users) {
                        return $users->last_name . ',' . $users->first_name;
                    });

            }
        } else {
            if ($ord == 'A') {
                $users = $users->sortBy(function($users) {
                    return $users->role . ',' . $users->last_name . ',' . $users->first_name;
                });

                } else {
                    $users = $users->sortByDesc(function($users) {
                        return $users->role . ',' . $users->last_name . ',' . $users->first_name;
                    });

            }
        }
        $users->values()->all();
        // set the session variable to refelect the current sort
        $request->session()->put('ucol',$column);
        $request->session()->put('uord',$ord);
        return view('users', ['sortOrder' => $column], ['users' => $users]);
    }


    public function postIndex(Request $request) {

        // first retrieve the user list

        $users = \App\User::orderBy('last_name')->orderBy('first_name')->get();
        // now filter the collection as needed based on user input

        //first filter on name / email if user entered a string
        $umatch = strtolower($request->input('user'));

        if (isset($umatch) && $umatch != '') {
            $filtered = $users->filter(function ($item) use ($umatch) {
                return (is_int(strpos(strtolower($item->last_name),$umatch)) || is_int(strpos(strtolower($item->email),$umatch)));
            });
            $users = $filtered;
        }

        // now filter by category
        $role = $request->input('role');

        if (isset($role) && $role != '') {

            $filtered = $users->filter(function ($item) use ($role) {
                return $item->role == $role;
            });
            $users = $filtered;
        }

        // now return the view with the filtered list
        $request->session()->put('users',$users);
        $ucol = $request->session()->get('ucol');

        return view('users', ['sortOrder' => $ucol], ['users' => $users]);
    }
}
