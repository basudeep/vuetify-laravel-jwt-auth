<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class SignInController extends Controller
{
    

    public function __invoke(Request $request){

        
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email )->first();
        if($user){
            if(auth()->attempt($credentials)){
                if(!$token = auth()->attempt($credentials)){
                    return response()->json([
                        'message' => 'Unauthorized'
                    ], 401 );
                }else{
                    return response()->json([
                        'token' => $token
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Password is Wrong'
                ], 401);
            }
    
        }else{
            return response()->json([
                'message' => 'User Not Found'
            ], 401 );
        }

        // if(! $token = auth()->attempt($credentials)){
        //     return response()->json([
        //         'error' => 'Unauthorized'
        //     ], 401);
        // }
        // return response()->json([
        //     'token' => $token
        // ], 200);
    }
}
