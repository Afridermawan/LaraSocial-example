<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as UserProvider;
use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\User;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->checkUser($user, $provider);
        auth()->login($authUser);

        return redirect()->route('home');
    }

    private function checkUser(UserProvider $userProvider, $provider)
    {
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $userProvider->getId())
            ->first();

        if (!$socialAccount) {
            $user = User::firstOrCreate(['email' => $userProvider->getEmail()], [
                'name' => $userProvider->getName(),
            ]);

            $socialAccount = SocialAccount::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $userProvider->getId(),
            ]);
        }

        return $socialAccount->user;
    }
}
