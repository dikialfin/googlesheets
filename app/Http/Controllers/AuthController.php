<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback(Request $request)
    {
        $credential = [];
        $googleAuthData = Socialite::driver('google')->user();
        $selectedUser = User::where('email', $googleAuthData->getEmail())->first();

        if (!$selectedUser) {
            $newUser = new User;
            $newUser->name = $googleAuthData->getName();
            $newUser->email = $googleAuthData->getEmail();
            $newUser->password = password_hash("123456789", PASSWORD_DEFAULT);
            $newUser->save();
        }

        if (Auth::attempt([
            "email" => $googleAuthData->getEmail(),
            "password" => "123456789"
        ])) {
            return redirect()->intended("/periodictable");
        }
        
        return redirect()->back('401');
    }
}
