<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use Validator;
use Auth;
use Session;

class AuthController extends Controller {
    public function register(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:users',
                'email'     => 'required|string|email|max:255|unique:users',
                'password'  => 'required|string',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'errors', 'message' => $validator->errors()]);
            }
        
            $user = User::forceCreate([
                'username' => $request->username,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'user_token' => Str::random(80),
            ]);
    
            if (!$user) {
                return response()->json(['status' => 'errors', 'message' => 'Internal Server Error.']);
            }
            
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password,
            ];
            
            if (Auth::attempt($credentials, $request->remember)) {
                $data = [
                    'email'     => $user->email,
                    'username'      => $user->username,
                    'user_token'      => $user->user_token,
                ];
                return response()->json(['status' => 200, 'message' => 'Successfully registered.', 'data' => $data], 200);
            } else {
                return response()->json(['status' => 'errors', 'message' => 'User does not exist.']);
            }
        } else {
            return response()->json(['status' => 'errors', 'message' => 'wrong method.']);
        }
    }
    
    public function login(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email|max:255',
                'password' => 'required|string|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'errors', 'message' => $validator->errors()]);
            }
            
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password
            ];
            
            if (Auth::attempt($credentials, $request->remember)) {
                $user = User::select('username', 'email')->find(Auth::user()->id);

                Session::put([
                    'username' => $user->username,
                    'email' => $user->email
                ]);
                
                return response()->json([
                    'status' => 'success', 
                    'message' => 'Welcome to '.$user->username.'.', 
                    'data' => $user,
                    'session_username' => Session::get('username'),
                    'session_email' => Session::get('email')
                ]);
            } else {
                return response()->json(['status' => 'errors', 'message' => 'User does not exist.']);
            }
        } else {
            return response()->json(['status' => 'errors', 'message' => 'wrong method.']);
        }
    }

    public function logout(Request $request) {
        if ($request->isMethod('get')) {
            Session()->forget('username', 'email');
            Session()->flush();
            
            return response()->json(['status' => 200, 'message' => 'Successfully logout.'], 200);
        } else {
            return response()->json(['status' => 'errors', 'message' => 'wrong method.']);
        }
    }  
}
