<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class MicrosoftController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        $mUser = Socialite::driver('microsoft')->user();

        $user = User::firstOrCreate(
            ['email' => $mUser->getEmail()],
            [
                'name' => $mUser->getName(),
                'microsoft_id' => $mUser->getId(),
                'auth_provider' => 'microsoft',
                'password' => null,
                'role' => 'staff',
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
