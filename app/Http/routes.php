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

//Route::get('/products', ['uses' =>'ProductController@getIndex']);
Route::get('/products', ['middleware' => 'authcheck:Administrator', 'uses' =>'ProductController@getIndex']);
Route::post('/products', ['middleware' => 'authcheck:Administrator', 'uses' =>'ProductController@postIndex']);
Route::get('/products/sort/{column}', ['middleware' => 'authcheck:Administrator', 'uses' =>'ProductController@sortProducts']);
Route::post('/products/sort/{column}', ['middleware' => 'authcheck:Administrator', 'uses' =>'ProductController@sortProducts']);
Route::get('/productedit/{pid}/{mode}', ['middleware' => 'authcheck:Administrator', 'uses' =>'ProducteditController@getIndex']);
Route::post('/productedit/{pid}/{mode}', ['middleware' => 'authcheck:Administrator', 'uses' =>'ProducteditController@postIndex']);
Route::get('/salespeople', ['middleware' => 'authcheck:Administrator', 'uses' =>'SalespersonController@getIndex']);
Route::post('/salespeople', ['middleware' => 'authcheck:Administrator', 'uses' =>'SalespersonController@postIndex']);
Route::get('/salespeople/sort/{column}', ['middleware' => 'authcheck:Administrator', 'uses' =>'SalespersonController@sortSalespeople']);
Route::post('/salespeople/sort/{column}', ['middleware' => 'authcheck:Administrator', 'uses' =>'SalespersonController@sortSalespeople']);
Route::get('/salespersonedit/{sid}/{mode}', ['middleware' => 'authcheck:Administrator', 'uses' =>'SalespersoneditController@getIndex']);
Route::post('/salespersonedit/{sid}/{mode}', ['middleware' => 'authcheck:Administrator', 'uses' =>'SalespersoneditController@postIndex']);
Route::get('/salestransactions', ['middleware' => 'authcheck:End User', 'uses' =>'SalesTransactionController@getIndex']);
Route::post('/salestransactions', ['middleware' => 'authcheck:End User', 'uses' =>'SalesTransactionController@postIndex']);
Route::get('/salestransactions/sort/{column}', ['middleware' => 'authcheck:End User', 'uses' =>'SalesTransactionController@sortSalestransactions']);
Route::post('/salestransactions/sort/{column}', ['middleware' => 'authcheck:End User', 'uses' =>'SalesTransactionController@sortSalestransactions']);
Route::get('/salestransactionedit/{txid}/{mode}', ['middleware' => 'authcheck:End User', 'uses' =>'SalestransactioneditController@getIndex']);
Route::post('/salestransactionedit/{txid}/{mode}', ['middleware' => 'authcheck:End User', 'uses' =>'SalestransactioneditController@postIndex']);
Route::get('/salesreport', ['middleware' => 'authcheck:End User', 'uses' =>'SalesTransactionController@getReport']);
Route::get('/users', ['middleware' => 'authcheck:Administrator', 'uses' =>'UserController@getIndex']);
Route::post('/users', ['middleware' => 'authcheck:Administrator', 'uses' =>'UserController@postIndex']);
Route::get('/users/sort/{column}', ['middleware' => 'authcheck:Administrator', 'uses' =>'UserController@sortUsers']);
Route::post('/users/sort/{column}', ['middleware' => 'authcheck:Administrator', 'uses' =>'UserController@sortUsers']);
Route::get('/useredit/{uid}/{mode}', ['middleware' => 'authcheck:Administrator', 'uses' =>'UsereditController@getIndex']);
Route::post('/useredit/{uid}/{mode}', ['middleware' => 'authcheck:Administrator', 'uses' =>'UsereditController@postIndex']);

Route::get('/manual', function() {
    $filename = 'user_manual.pdf';
    $path = public_path().DIRECTORY_SEPARATOR.'docs'.DIRECTORY_SEPARATOR.$filename;
    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; '.$filename,
    ]);
});

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
