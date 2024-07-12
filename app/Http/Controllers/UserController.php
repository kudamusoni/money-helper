<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()]
        ]);

        try {
            $user = new User;
            $user->first_name = $data['firstName'];
            $user->last_name = $data['lastName'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);

            $user->save();

            return response()->json([
                "message" => "Success: User has been created"
            ]);
        } catch (\Throwable $e) {
            Logger($e->getMessage());
            return response('Error: User not created', 500);
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()]
        ]);

        $user = User::where('email', '=', $data['email'])->first();

        if (!Hash::check($data['password'], $user->password)) {
            return response(400)->json([
                "message" => "Error: User credentials don't match"
            ]);
        }

        return response(200)->json([
            "message" => "Success: User has been created"
        ]);
    }
}
