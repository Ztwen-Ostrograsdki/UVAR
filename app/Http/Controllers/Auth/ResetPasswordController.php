<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\Validators\TraitResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    use TraitResetPassword;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(Request $request)
    {
        return view('users.newPassword');
    }


    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {

        $old = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();
        if ($old) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $v = $this->validateResetPasswordNow($request->all());
                if ($v->fails()) {
                    return response()->json(['invalids' => $v->errors()]);
                }
                else{
                    DB::transaction(function() use($user, $request){
                        $user->update(['password' => Hash::make($request->password), 'remember_token' => Str::random(10)]);
                        DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->delete();
                    });
                    return response()->json(['success' => "Votre mot de passe a été réinitialisé avec succès! Vous pouvez vous connecter à nouveau!"]);
                }
            }
            return response()->json(['errors' => "L'adresse mail est inconnue"]);
            DB::table('password_resets')->where('email', $request->email)->delete();
        }
        return response()->json(['errors' => "Votre requête est inconnue: Les données ne correspondent pas!"]);

    }


    protected function validateResetPasswordNow(array $request)
    {
        return $this->validateResetRequest($request);
    }



    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['errors' => $response]);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['success' => 'votre mot de passe a bien été réinitialisé']);
    }



}
