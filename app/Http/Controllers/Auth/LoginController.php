<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->sendLoginResponse($request);
            
            // $user = auth()->user();
            // $admin = false;
            // $roles = $user->getRoles();
            
            // if (in_array('admin', $roles) || in_array('superAdmin', $roles)) {
            //     $admin = true;
            // }

            return response()->json(['success' => 'connexion réussie']);
        }
        else{

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            // $this->incrementLoginAttempts($request);
            // $this->sendFailedLoginResponse($request);

            return response()->json(['invalids'=> 
                    [
                        "email" => ["Les coordonnées que vous avez entrez ne correspondent pas!"],
                        "password" => ["Les coordonnées que vous avez entrez ne correspondent pas!"]
                    ],
                ]);
        }

       
        
    
    }

     /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function validateLogin(Request $request)
    // {

    //     $v = $request->validate([
    //         $this->username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    // }



    /**
     * where user should be redirect after login
     *
     *
     */
    // protected function redirectTo()
    // {
        
    // }
}
