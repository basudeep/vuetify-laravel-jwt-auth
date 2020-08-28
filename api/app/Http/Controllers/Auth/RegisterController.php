<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse; 


class RegisterController extends Controller
{
    public function __invoke(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required | email |unique:users',
            'password' => 'required | min:6',

        ]);
        if ($validator->fails()) {

        $message = $validator->errors()->first();
        $errors=$validator->errors();
        $code='200';

        $response = array(
            'success' => false,
            'message' => $message,
            "errors" => $errors
        );

        return new JsonResponse($response, $code);

        }

       $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);
        return ['message' => 'User Created'];
    }   
}
