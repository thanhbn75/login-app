<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialAuthService;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    protected $service;

    public function __construct(SocialAuthService $service)
    {
        $this->service = $service;
    }

    public function redirect($provider)
    {
        $driver = Socialite::driver($provider);
        
        // Nếu Facebook báo lỗi "Invalid Scopes: email" vì app chưa được cấu hình cho quyền truy cập email
        // Ta ghi đè scope mặc định của Socialite để chỉ xin quyền public_profile.
        if ($provider === 'facebook') {
            $driver->setScopes(['public_profile']);
        }

        return $driver->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $this->service->login($socialUser, $provider);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login failed!');
        }
    }
}