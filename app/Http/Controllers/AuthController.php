<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request; 
use App\Http\Controllers\ApiController; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends ApiController
{
    /** 
     * Register api 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse 
     */ 
	public function register(Request $request)
	{ 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:6', 
            'repeat_password' => 'required|same:password', 
        ]);
		if ($validator->fails()) 
	    { 
	        return $this->respondNotValidated($validator->errors());           
	    }
		try { 

	        $input = $request->all(); 
	        $input['password'] = bcrypt($input['password']); 

	        DB::beginTransaction();
	        $user = User::create($input); 
	        $token =  $user->createToken('laravelAppToken')->accessToken; 

	        DB::commit();
            return response()->json([
                'message' => 'Successfully register.',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 201);

       	}catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
	}

	/** 
     * login api 
     * 
     * @return \Illuminate\Http\JsonResponse
     */ 
    public function login()
    { 


         $users = User::whereEmail(request('email'))->first();

         if (!$users) {

            return $this->respondNotAuthorized('Wrong email or password');
        }

        if (!Hash::check(request('password'), $users->password)) {

             return $this->respondNotAuthorized('Wrong email or password');
        }

        try {

	        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 

	            $user = Auth::user(); 
	            $token =  $user->createToken('laravelAppToken')->accessToken; 
	            
	            return response()->json([
                    'message' => 'Successfully login.',
                    'data' => [
                        'user' => auth()->user(),
                        'token' => $token,
                    ],
                ], 200);
	        } 
	        else{ 

	            return $this->respondNotAuthorized('Unauthorised');
	        } 
 
        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /** 
     * users api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function users(){ 
    	try {

            $user = Auth::user(); 
            
	        return response()->json([
	            'message' => 'Successfully get auth user.',
	            'data' => [
	                'user' => auth()->user(),
	            ],
	        ], 200);	

        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    } 

    /** 
     * Logout api 
     * 
     * @return \Illuminate\Http\jsonResponse 
     */ 
    public function logout()
    {
  
	     try {

	        $accessToken = auth()->user()->token();
		    $refreshToken = DB::table('oauth_refresh_tokens')
		        ->where('access_token_id', $accessToken->id)
		        ->update([
		            'revoked' => true
		        ]);
		    $accessToken->revoke();
            return response()->json([
                'message' => 'Successfully logout.',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
	}

}
