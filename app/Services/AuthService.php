<?php

namespace App\Services;

use App\Http\Requests\RegisterRquest;
use App\Http\Requests\Sign_inRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;

class AuthService
{
    public function Register($request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'password' => FacadesHash::make($request['password']),
            ]);
            return response()->json(['message' => 'User Created success', "status" => 200]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(),  'status' => 500]);
        }
    }
    public function SignIn($request)
    {
        try {
            if (!Auth::attempt($request->only(['phone', 'password']))) {
                return response()->json(['message' => 'phone & Password does not match with our record.' ],401);
            }
            $user = User::where('phone', $request->phone)->first();
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $parts = explode('|', $token);
            $cleanToken = $parts[1];
            return response()->json(['message' => 'User Logged In Successfully', 'token' => $cleanToken], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
