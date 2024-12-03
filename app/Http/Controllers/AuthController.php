<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Account;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('mail', 'password');
    
        if (!$credentials) {
            return response([
                'success' => false,
                'message' => "user name & password not null"
            ], 400);
            // Đăng nhập thành công
            return response()->json(['message' => 'Login successful'], 200); 
        }
        
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('auth');
            return response()->json([
                'token' => $token->plainTextToken,
                'success' => true,
                'message' => 'Login successful'
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => "user name or password incorrect"
        ],401);
    } 
    public function logout(Request $request)
    {

    }

    public function profile(Request $request){
        return response()->json([
            'success' => true,
            'account' => $request->user()
        ]);
    } 
    public function register(RegisterRequest $request)
    {
        // Create a new user
        $account = Account::create([
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'mail' => $request->mail,
            'password' => bcrypt($request->password),
            // 'phone' => $request->phone,
            'role_id' => '2',
            'job_created_at' => $request->job_created_at,
            'job_position_id' => $request->job_position_id,
            
        ]);
    
        // Generate a token for the user
        $token = $account->createToken('auth')->plainTextToken;
    
        // Return a success response with the token
        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'account' => $account,
            'token' => $token,
        ], 201);
    }
}
