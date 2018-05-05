<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;

class LoginController extends Controller
{
    private static $provider = 'google';
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver(self::$provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver(self::$provider)->user();

        $authUser = $this->findOrCreateUser($user, self::$provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);

        // $user->token;
    }

    public function findOrCreateUser($user)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => self::$provider,
            'provider_id' => $user->id
        ]);
    }
}
