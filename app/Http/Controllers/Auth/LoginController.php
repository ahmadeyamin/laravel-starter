<?php

namespace App\Http\Controllers\Auth;

use Route;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * authenticated after auth
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        // Update data after login
        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip()
        ]);

        //Redirect after login
        redirect($this->redirectTo)->with('success',"Hi $user->name, Welcome Back!");
    }



    /**
     * redirectToProvider
     *
     * @param  mixed $provider
     * @return void
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * handleProviderCallback
     *
     * @param  mixed $provider
     * @return void
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // Find existing user.
        $existingUser = User::whereEmail($user->getEmail())->first();

        if ($user->getEmail() == null) {
            abort(403,'No Email Found With Your Account');
        }



        if ($existingUser)
        {

            if($existingUser->is_blocked)
                abort(403,'You Are Blocked');

            $existingUser->update([
                'last_login_at' => now(),
                'last_login_ip' => request()->ip(),
                'provider_token' => $user->token,
                'provider' => $provider,
            ]);

            Auth::login($existingUser);
        } else {
            // Create new user.

            if (!Route::has('register'))
                abort(403,'Registation Disabled');

            $newUser = User::create([
                'role_id' => '1',
                'last_login_at' => now(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'status' => true,
                'last_login_ip' => request()->ip(),
                'provider_token' => $user->token,
                'provider' => $provider,
                'username' => Str::slug($user->getId()).'_'.(int) microtime(true),
            ]);
            // upload images
            if ($user->getAvatar()) {
                try {
                    $newUser->addMediaFromUrl($user->getAvatar())->toMediaCollection('avatar');
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            Auth::login($newUser);
        }
        return redirect($this->redirectPath())->with('success','You have successfully logged in with '.ucfirst($provider).'!');
    }
}
