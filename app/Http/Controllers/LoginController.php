<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($service)
    {
        $user = Socialite::driver($service)->user();
        switch ($service){
            case 'qq':
                dd($user);
                break;
            case 'github':
                dd($user);
                break;
        }
        // $user->token;
    }
}
