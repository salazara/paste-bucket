<?php

// This is the authentication controller for api

// Notes:
// Link - https://medium.com/techcompose/create-rest-api-in-laravel-with-authentication-using-passport-133a1678a876
// The authentication controller for web is in the Auth folder (SCAFFOLDED via $ php artisan make:auth)

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

use App\Http\Controllers\Controller; 
use App\User; 
use Validator;

class UserController extends Controller 
{

    public $successStatus = 200;

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('token')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 

        } else { 

            return response()->json(['error' => 'login failed'], 401); 

        }

    }

    /** 
     * register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 

        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'c_password' => 'required|string|min:6|same:password',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error' => $validator->errors()], 401);            
        }
        
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('token')->accessToken;
        $success['name'] =  $user->name;
        
        return response()->json(['success' => $success], $this->successStatus); 

    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 

        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus);
    
    } 

}