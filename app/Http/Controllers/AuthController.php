<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\SocialAccount;
use App\Models\User;
use Auth;
use GuzzleHttp\Exception\ClientException;
use InvalidArgumentException;
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
        try {
            return Socialite::driver($provider)->redirect();
        } catch (InvalidArgumentException $exception) {
            return abort(404);
        }
    }

    public function callback($provider)
    {
        try {
            $socialite_user = Socialite::driver($provider)->user();
        } catch (InvalidStateException $exception) {
            return redirect()->route('auth.redirect', [
                'provider' => $provider
            ]);
        } catch (InvalidArgumentException $exception) {
            abort(404);
        }  catch (ClientException $exception) {
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
        foreach ($circles as $_circle) {

            $circle = Circle::whereName($_circle['name'])->first();

            if( $circle == null ) {
                $circle = Circle::create([
                    'name' => $_circle['name']
                ]);
            }

            $isLeader   = isset($_circle['status']) && $_circle['status'] == 'körvezető';
            $isPr       = isset($_circle['title']) && in_array('PR menedzser', $_circle['title']);

            if( $circle->users()->where('user_id', $user->id)->exists() ) {
                $user->circles()->updateExistingPivot($circle->id, [
                    'leader'    => $isLeader,
                    'pr'        => $isPr
                ]);
            } else {
                $user->circles()->attach($circle->id, [
                    'leader'    => $isLeader,
                    'pr'        => $isPr
                ]);
            }

        }
    }
}