<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Employer;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'phone_number' => 'required',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number
        ]);
        $user->save();
        if($request->type === 'customer') {
            $customer = new Customer([
                'user_id' => $user->getAttributes()["id"],
            ]);
            $customer->save();
        } else if ($request->type === 'manager') {
            $manager = new Manager([
                'user_id' => $user->getAttributes()["id"],
            ]);
            $manager->save();
        } else if ($request->type === 'employer') {
            $employer = new Employer([
                'user_id' => $user->getAttributes()["id"],
                'business_id' => $request->business_id,
            ]);
            $employer->save();
        }
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        // dd($credentials);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        dd('got');
        return response()->json($request->user());
    }
}
