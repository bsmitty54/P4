<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

\Validator::extendImplicit('confirm', function($attribute, $value, $parameters)
{
    $other = \Input::get($parameters[0]);
    if ((is_null($value) || $value == '') && ($other != ''))  {
        //password entered but no confirmation
        return false;
    } elseif ((is_null($other) || $other == '') && (is_null($value) || $value == '')) {
        // no date in either password or confirmation field
        return true;
    } elseif ($other !== $value) {
        // they are not equal
        return false;
    } else {
        return true;
    }

});

Route::get('/', function () {
    return view('home');
});

Route::get('/products', ['uses' =>'ProductController@getIndex']);
Route::post('/products', 'ProductController@postIndex');
Route::get('/products/sort/{column}', 'ProductController@sortProducts');
Route::post('/products/sort/{column}', 'ProductController@sortProducts');
Route::get('/productedit/{pid}/{mode}', 'ProducteditController@getIndex');
Route::post('/productedit/{pid}/{mode}', 'ProducteditController@postIndex');
Route::get('/salespeople', ['uses' => 'SalespersonController@getIndex']);
Route::post('/salespeople', 'SalespersonController@postIndex');
Route::get('/salespeople/sort/{column}', 'SalespersonController@sortSalespeople');
Route::post('/salespeople/sort/{column}', 'SalespersonController@sortSalespeople');
Route::get('/salespersonedit/{sid}/{mode}', 'SalespersoneditController@getIndex');
Route::post('/salespersonedit/{sid}/{mode}', 'SalespersoneditController@postIndex');
Route::get('/salestransactions', 'SalesTransactionController@getIndex');
Route::post('/salestransactions', 'SalesTransactionController@postIndex');
Route::get('/salestransactions/sort/{column}', 'SalesTransactionController@sortSalestransactions');
Route::post('/salestransactions/sort/{column}', 'SalesTransactionController@sortSalestransactions');
Route::get('/salestransactionedit/{txid}/{mode}', 'SalestransactioneditController@getIndex');
Route::post('/salestransactionedit/{txid}/{mode}', 'SalestransactioneditController@postIndex');
Route::get('/users', ['uses' =>'UserController@getIndex']);
Route::post('/users', 'UserController@postIndex');
Route::get('/users/sort/{column}', 'UserController@sortUsers');
Route::post('/users/sort/{column}', 'UserController@sortUsers');
Route::get('/useredit/{uid}/{mode}', 'UsereditController@getIndex');
Route::post('/useredit/{uid}/{mode}', 'UsereditController@postIndex');

# Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

# Process logout
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
