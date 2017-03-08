<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\SocialAccount;
use App\Models\User;
use Auth;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialite_user = Socialite::driver($provider)->user();
        } catch (InvalidStateException $exception) {
            return redirect()->route('auth.redirect', [
                'provider' => $provider
            ]);
        } catch (ClientException $exception) {
            return redirect()->route('auth.redirect', [
                'provider' => $provider
            ]);
        }

        $account = SocialAccount::whereProvider($provider)
            ->where('provider_id', $socialite_user->id)
            ->first();

        if( $account == null ) {

            $user = User::create([
                'name'  => $socialite_user->name,
                'email' => $socialite_user->email
            ]);

            SocialAccount::create([
                'user_id'       => $user->id,
                'provider'      => $provider,
                'provider_id'   => $socialite_user->id
            ]);

            $this->registerCircles($user, $socialite_user->circles);

            Auth::login($user);

        } else {
            if( !Auth::check() ) {

                $this->registerCircles($account->user, $socialite_user->circles);

                Auth::login($account->user);
            }
        }

        return redirect()->intended('/');
    }

    private function registerCircles(User $user, array $circles)
    {
        $user->detachCircles();

        foreach ($circles as $circ) {

            $circle = Circle::whereName($circ['name'])->first();

            if( $circle == null ) {
                $circle = Circle::create([
                    'name' => $circ['name']
                ]);
            }

            $user->circles()->attach($circle->id);
        }
    }
}