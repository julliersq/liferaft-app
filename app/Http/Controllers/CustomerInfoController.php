<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;


class CustomerInfoController extends Controller
{
    /**
     * Show the form for creating Customer Information.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //display the form for creating customer information
        return view('customer.create', [
            'countries' => Country::all(),        
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveInfo(Request $request)
    {        
        //create an array for the customer information
        $customer = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'state_code' => $request->input('state_code'),
            'city' => $request->input('city'),
            'street' => $request->input('street'),
            'house-num' => $request->input('house-num'),
        ];    

        //validate the customer information
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'country' => 'required|max:255',
            'house-num' => 'required|integer',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
        ]);
         

        if ($validator->fails()) {
            //return false if the validation fails
            return ['success' => false, 'errors' => $validator->errors()];
        }      
        else{
            //save information to text file
            $customer_json = json_encode($customer);
            if (Storage::disk('local')->exists('customers.txt')) {
                $file_save_success = Storage::append('customers.txt', $customer_json);
            }
            else{
                $file_save_success = Storage::disk('local')->put('customers.txt', $customer_json, 'private');
            }
                        
            //return true if the validation passes and the information is saved
            if( $file_save_success ){
                return ['success' => true];
            }
            else{
                return ['success' => false, 'errors' => 'Error saving customer information'];
            }            
        }  
        
    }    
}
