<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AffiliationsController;
use App\Http\Controllers\RequestsController;
use App\ModelsHelpers\Authenticators\IDManager;
use App\Models\Account;
use App\Models\Action;
use App\Models\Affiliate;
use App\Models\Bonus;
use App\Models\Member;
use App\Models\RequestedAction;
use App\Models\ShoppingAction;
use App\Models\User;
use App\Notifications\AffiliationRequestedNotification;
use App\Notifications\Requested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.index');
    }


    public function manageRequest(string $type, int $request, int $response)
    {

        if ($type == 'action') {
            $request = RequestedAction::find($request);
            if ($request) {
                $action = Action::find($request->action_id);
                $member = Member::find($request->member_id);
                if ($response == 1) {
                    DB::transaction(function() use ($action, $member, $request){
                        $accepted = ShoppingAction::create(['action_id' => $action->id, 'member_id' => $member->id, 'total' => $request->total]);
                        $refresh = $request->delete();
                    });
                    $member->user->notify(new Requested('action', $action, $request, true));
                    if (auth()->user()->role == "admin") {
                        return (new RequestsController())->getRequests("Demande d'achat approuvé avec succès");
                    }
                    else{
                        return response()->json(['message' => "Demande d'achat approuvé avec succès"]);
                    }
                }
                else{
                    $rejected = $request->delete();
                    if ($rejected) {
                        $member->user->notify(new Requested('action', $action, $request, false));
                        if (auth()->user()->role == "admin") {
                            return (new RequestsController())->getRequests("Demande d'achat rejeté avec succès");
                        }
                        else{
                            return response()->json(['message' => "Demande d'achat rejeté avec succès"]);
                        }
                    }
                }
            }
            else{
                return response()->json(['errors' => "Votre achat est ambiguë"]);
            }
        }
    }

    public function manageAffiliation(Request $request)
    {
        $status = $request->status;
        $aff = Affiliate::where('id', $request->affiliate_id)->first();
        if ($aff) {
            $referer = Member::find($aff->referer_id);
            $referee = User::find($aff->referee_id);
        }
        else{
            return response()->json(['errors' => "Votre requête est inconnue"]);
        }
        if ($aff && !$aff->accepted && $referer && $referee && $status) {
           return response()->json(['errors' => "Vous ne pouvez pas effectuer cette requête! {$referee->name} doit d'abord accepeter cette affiliation!"]);
        }
        if ($status) {
            if ($aff !== null) {
                if ($referer !== null && $referee !== null) {
                    if ($referee->member !== null) {
                        $member = Member::find($referee->member->id);
                        DB::transaction(function() use ($referer, $referee, $aff, $member){
                            $member->referer = $referer->id;
                            $member->save();
                            Bonus::create([
                                'beneficier' => $referer->id,
                                'value' => Bonus::__bonuser(),
                                'title' => 'Affiliation de ' . $referee->name
                                ]);
                            $aff->delete();
                        });
                        $referer->user->notify(new AffiliationRequestedNotification($referer, $referee, true));
                        $referee->notify(new AffiliationRequestedNotification($referer));
                        return (new AffiliationsController())->getNotifications();
                    }
                    else{
                        DB::transaction(function() use ($referer, $referee, $aff){
                            $last = count(Member::withTrashed('deleted_at')->where('id', '>', 0)->get()) + 1;
                            $member = Member::create([
                                    'name' => $referee->name,
                                    'email' => $referee->email,
                                    'country' => 'Mon pays',
                                    'IDENTIFY' => 'UVAR' . rand(10000, 90000) . 'MB' . $last . strtoupper(Str::random(3)),
                                    'phone' => '00000000000' . '' . $last,
                                    'user_id' => $referee->id,
                                    'referer' => $referer->id,
                                ]);
                            $account = Account::create([
                                'solde' => 0,00000,
                                'author' => $member->id,
                                ]);
                            Bonus::create([
                            'beneficier' => $referer->id,
                            'value' => Bonus::__bonuser(),
                            'title' => 'Affiliation de ' . $referee->name
                            ]);
                            $aff->delete();
                        });
                        $referer->user->notify(new AffiliationRequestedNotification($referer, $referee, true));
                        $referee->notify(new AffiliationRequestedNotification($referer));
                        return (new AffiliationsController())->getNotifications(['success' => "Affiliation réussie"]);
                    }
                }
                else{
                    $aff->delete();
                    $referer->user->notify(new AffiliationRequestedNotification($referer, $referee, false));
                    return (new AffiliationsController())->getNotifications();

                }
            }
            else{
                return (new AffiliationsController())->getNotifications(['errors' => "Affiliation échoué, requête inconnue"]);
            }
        }
        else{
            $aff->delete();
            $referer->user->notify(new AffiliationRequestedNotification($referer, $referee, false));
            return (new AffiliationsController())->getNotifications();
        }
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
        return response()->json([$request->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('members.index');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function lockedUser(int $id)
    {
        $user = User::find($id);

        if ($user && $user->role == 'admin') {
            return response()->json(['errors' => "Cette action ne peut-être effectuée sur l'utilisateur $user->name "]);
        }

        if ($user) {
            if ($user->confirmation_token !== null) {
                if ($user->confirmation_token == 'locked') {
                    return response()->json(['errors' => "L'utilisateur $user->name est déjà bloqué!"]);
                }
                else{
                    return response()->json(['errors' => "L'utilisateur $user->name n'a pas encore confirmé son compte"]);
                }
            }
            $locked = IDManager::__USER_LOCKER($user);
            if ($locked) {
                return response()->json(['success' => "L'utilisateur $user->name a bien été bloqué!"]);
            }
            return response()->json(['errors' => "L'utilisateur $user->name n'a pas pu être bloqué!"]);

        }
        return response()->json(['errors' => "Cet utilisateur est inconnue!"]);
    }


    public function dislockedUser(int $id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->confirmation_token !== null) {
                if ($user->confirmation_token == 'locked') {
                    $dislocked = IDManager::__USER_DISLOCKER($user);
                    if ($dislocked) {
                        return response()->json(['success' => "L'utilisateur $user->name a bien été débloqué!"]);
                    }
                }
                else{
                    return response()->json(['errors' => "L'utilisateur $user->name n'a pas encore confirmé son compte"]);
                }
            }
            return response()->json(['errors' => "L'utilisateur $user->name n'était pas bloqué!"]);
        }
        return response()->json(['errors' => "Cet utilisateur est inconnue!"]);
    }


}
