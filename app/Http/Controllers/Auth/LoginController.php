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
        $this->middleware('guest')->except(['logout', 'getConnected', 'getUserMember']);
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
            
            $user = auth()->user();
            $member = null;
            if ($user) {
                if ($user->member !== null) {
                    $member = $user->member;
                    $image = $user->member->images;
                }
                return response()->json(['success' => ['user' => $user, 'active_member_photo' => $image, 'active_member' => $member]]);
            }
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

    public function getConnected()
    {
        $user = auth()->user();
        if ($user !== null) {
            return response()->json(['success' => $user]);
        }
        else{
            return response()->json(['disconnected' => true]);
        }

    }

    public function getUserMember()
    {
        $user = auth()->user();
        if ($user) {
            if ($user->member !== null) {
                $active_member_photo = $user->member->images;
                return response()->json(['active_member_photo' => $active_member_photo, 'user_member' => $user->member, 'active_member' => $user->member]);
            }
            else{
                return response()->json(['user_member' => null, 'active_member_photo' => [], 'active_member' => null]);
            }
        }
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            // return $response;
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => true]);
        // return $request->wantsJson()
        //     ? new JsonResponse([], 204)
        //     : redirect('/');
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
