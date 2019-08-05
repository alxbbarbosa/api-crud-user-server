<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api',
            ['except' => [
                    'register', 'authenticate'
                ]
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->only('name', 'email', 'password',
                    'password_confirmation'),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data             = $request->only('name', 'email', 'password');
        $data['password'] = bcrypt($data['password']);
        $user             = User::create($data);

        $token   = $user->createToken('teste')->accessToken;
        $message = 'User has been created successful, Please confirm yourself by clicking on verify user button sent to you on your email';
        return response()->json(compact('message', 'user'), 201);
    }

    public function user()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return response()->json(compact('user'));
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            if (is_null($user->email_verified_at)) {
                return response()->json(['error' => 'Please Verify Email'], 401);
            }

            $token = $user->createToken('teste')->accessToken;
            return response()->json(compact('user', 'token'));
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->user()->AauthAcessToken()->delete();
            return response()->json(['Logout']);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}