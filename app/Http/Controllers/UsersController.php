<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AffiliationsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Mail\Gmail;
use App\Models\Affiliate;
use App\Models\Bonus;
use App\Models\Member;
use App\Models\User;
use App\Notifications\AffiliationRequestedNotification;
use App\Notifications\MessagerNotification;
use App\Notifications\RegisterUser;
use App\Traits\Storers\UsersStorers;
use App\Traits\Validators\TraitUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    use TraitUsers;
    use UsersStorers;

    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'manageAffiliationExternally']);
        $this->middleware('admin')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }


    public function getUsers()
    {
        $users = User::withTrashed('deleted_at')->with('member')->get();
        
        return response()->json(['users' => $users]);
    }




    public function getUser(int $id)
    {
        if (auth()->user()->id !== $id) {
            return abort(403, "Vous n'etes pas autorisé");
        }
        if (!is_int($id)) {
            return abort(404, 'Page introuvable');
        }
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'Page introuvable');
        }

        $notifs_a = Affiliate::where('referee_id', $user->id)->get();
        $requests = [];

        foreach ($notifs_a as $notif) {
            $member = Member::find($notif->referer_id);
            $requests[] = ['member' => $member, 'affiliation' => $notif];
        }
        
        return response()->json(['user' => $user, 'requests' => $requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json(['invalids' => $validator->errors()]);
        }
        else{
            $user = $this->__createUser($request->all());
            $user->notify(new RegisterUser());
            if ($user) {
                return response()->json(['success' => "Votre inscription s'est bien déroulée! Veuillez à présent confirmer votre inscrition"]);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (auth()->user()->id !== $id) {
            return abort(403, "Vous n'etes pas autorisé");
        }
        if (!is_int($id)) {
            return abort(404, 'Page introuvable');
        }
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'Page introuvable');
        }
        return view('users.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    // public function IDoNotRecognizedThatRequest(int $referer, int $referee)
    // {

    //     $aff = Affiliate::where('referee_id', $referee)->where('referer_id', $referer)->first();
    //     if ($aff) {
    //         $referer = Member::find($aff->referer_id);
    //         $referee = User::find($aff->referee_id);
    //         $aff->delete();
    //         if ($aff && $referee && $referer) {
    //             $referer->user->notify(new AffiliationRequestedNotification($referer, $referee, false, 'par lui même!'));
    //         }
    //         return redirect('/');
    //     }
    // }

    public function manageMyIncomingAffiliation(int $referer, int $referee, string $token, string $r, string $key, string $externe)
    {
        $admin = User::where('role', 'admin')->first();
        $aff = Affiliate::where('referee_id', $referee)->where('referer_id', $referer)->first();

        if ($aff) {
            $realToken = $aff->token;
            $realKey = $aff->token;
            if ($key == $realKey && $token == $realToken) {
                $referer = Member::find($referer);
                $referee = User::find($referee);

                if ($referer && $referee) {
                    if ($r == 'yes') {
                        $aff->update(['accepted' => true]);
                        $referee->notify(new MessagerNotification("Vous venez de reconnaître la demande d'affiliation de {$referee->name}. Veuillez contacter UVAR pour finaliser la procedure de creation de compte membre UVAR.", "Acceptation d'affiliation de membre", false, $aff));
                        if ($admin) {
                            $admin->notify(new MessagerNotification("$referee->name vient de reconnaître la demande d'affiliation de {$referee->name}.", "Acceptation d'affiliation de membre", true, $aff));
                        }
                        if ($externe == 'yes') {
                            return redirect('/');
                        }
                        else{
                            return response()->json(['success' => $referer]);
                        }
                    }
                    elseif ($r == 'no') {
                        $aff->delete();
                        $referer->user->notify(new AffiliationRequestedNotification($referer, $referee, false, 'ceci par lui même!'));
                        if ($externe == 'yes') {
                            return redirect('/');
                        }
                        else{
                            if ($externe !== 'yes') {
                                return response()->json(['success' => "Affiliation refusée avec succès"]);
                            }
                            return redirect('/');
                        }
                    }
                    else{
                        if ($externe !== 'yes') {
                            return response()->json(['errors' => "Requête invalide, vous n'êtes pas authorisé"]);
                        }
                        return abort(403, "Vous n'êtes pas authorisé");
                    }
                }
                else{
                    if ($externe !== 'yes') {
                        return response()->json(['errors' => "Requête invalide, vous n'êtes pas autho"]);
                    }
                    return abort(403, "Vous n'êtes pas authorisé");
                }
            }
            else{
                if ($externe !== 'yes') {
                    return response()->json(['errors' => "Requête invalide, vous n'êtes pas authorisé"]);
                }
                return abort(403, "Vous n'êtes pas authorisé");
            }
        }
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user && $user->role == 'admin') {
            return response()->json(['errors' => "Cette action ne peut-être effectuée sur l' utilisateur $user->name "]);
        }
        if ($user) {
            $user->forceDelete();
            return response()->json(['success' => "L'utilisateur $user->name a bien été supprimé définitivement de la base de données ainsi que le membre conséquent!"]);
        }
        return response()->json(['errors' => "Cet utilisateur est inconnue!"]);
    }



}
