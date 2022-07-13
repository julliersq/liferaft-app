<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class LocationsController extends Controller
{
    /**
     * Return a list of all the countries
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Country::all();
    }

    /**
     * Return a list of all the states based on $country
     *
     * @param  int  $location
     * @return \Illuminate\Http\Response
     */
    public function show($country_code)
    {               
        
        //return State::all();
        //return response()->json(State::where('country_code', $location));
//        return var_dump(State::where('country_code', $location)->get());
return 'country_code is '. $country_code; //State::where('country_code', 226)->get();
    
    }
}
