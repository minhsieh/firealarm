<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserFacebook;


class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
                ->scopes(['email','public_profile','manage_pages','publish_pages'])
                ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $fb_user = Socialite::driver('facebook')->user();

        $user = User::where('email', $fb_user->email)->first();
        if(!$user){
            $user = new User;
            $user->name = $fb_user->name;
            $user->email = $fb_user->email;
            $user->password = bcrypt(md5(time().rand(1,9999999)));
            $user->save();
        }

        if(!$user->facebook){
            $user->facebook = new UserFacebook;
            $user->facebook->user_id = $user->id;
            $user->facebook->save();
        }

        $user->facebook->fb_id = $fb_user->id;
        $user->facebook->name = $fb_user->name;
        $user->facebook->email = $fb_user->email;
        $user->facebook->avatar = $fb_user->avatar;
        $user->facebook->token = $fb_user->token;
        $user->facebook->save();

        Auth::login($user);

        return redirect('/home');
    }
}
