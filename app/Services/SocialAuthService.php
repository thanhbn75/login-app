<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthService
{
    public function login($socialUser, $provider)
    {
        $user = User::where('provider_id', $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail() ?? $socialUser->getId().'@fake.com',
                'avatar' => $socialUser->getAvatar(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'student_id' => '20201234',
                'password' => bcrypt('123456'),
            ]);
        }

        Auth::login($user);
        return $user;
    }
}