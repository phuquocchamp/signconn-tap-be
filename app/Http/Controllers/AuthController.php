<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return [
            "email" => $request->email,
            "password" => $request->password,
        ];
    }

    public function register(Request $request)
    {
        $messages = [
            "email.email" => "Error on email format!",
            "email.required" => "Email required!",
            "email.required" => "Password required"
        ];
        $validate = Validator::make($request->all(), [
            "email" => "email | required",
            "password" => "required",
        ], $messages);
        if ($validate->fails()) {
            return response()->json([
                "message" => $validate->errors()
            ],
                404
            );
        }
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->pasword),
            ]);

        return response() -> json([
            "message" => "Created successfully",
            ],
            200,
        );
    }
}
