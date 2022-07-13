<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\CustomerInfoController;
use App\Models\Country;
use App\Models\State;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');    
});

Route::get('/countries', function () {
    return Country::all();
});

Route::get('/states', function () {
    return State::all();
});

Route::get('/states/{country_code}', function ($country_code) {
    if( isset($country_code) && $country_code > 0 ){
        return State::where('country_code', $country_code)->get();
    }
    else{
        abort(404); 
    }
});

Route::get('/customers/create', function () {
    return view('customer.create', [
        'countries' => Country::all(),        
    ]);  
});

Route::post('/customers/store', [CustomerInfoController::class, 'saveInfo']);