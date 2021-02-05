<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Bonus;
use App\Models\Member;
use App\Models\User;
use App\Notifications\Affiliation;
use App\Traits\Storers\Affiliator;
use Illuminate\Http\Request;

class AffiliationsController extends Controller
{

	use Affiliator;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('notifications.index');
    }

    public function getNotifications()
    {
        $notifs_a = Affiliate::all();
        $notifications_aff = [];

        foreach ($notifs_a as $notif) {
            $user = User::find($notif->referee_id);
            $member = Member::find($notif->referer_id);
            $notifications_aff[] = ['referer' => $member, 'referee' => $user];
        }
        return response()->json(['notifications' => 
                $notifications_aff,
            ]);
    }

    public function affiliate(Request $request)
    {
        $admin = User::find(1);
    	$req = $request->email;
        $referer = auth()->user()->member;
    	// $referer = auth()->user->member;
    	$target = User::where('email', $req)->first();
    	if ($target !== null) {
            if ($target->id == auth()->user()->id) {
                return response()->json(['errors' => "Erreure: Vous ne pouvez pas effectuer cette requête"]);
            }
            $waiting = count(Affiliate::where('referee_id', $target->id)->get()->toArray());

            if ($waiting > 0) {
                return response()->json(['errors' => "Erreure: Cet utilisateur est déja en cours de maintenance membre"]);
            }
    		$user_member = $target->member;
    		if ($user_member !== null) {
    			//Le user est deja membre
                if ($user_member->referer_id !== null) {
                    return response()->json(['errors' => "Cet utilisateur est déja un membre réferé"]);
                }
                else{

                    $affiliation = Affiliate::create(['referer_id' => $referer->id, 'referee_id' => $target->id]);
                    $admin->notify(new Affiliation($referer, $target));
                    //Mise à jour
                    return response()->json(['success' => "Mise à jour en cours: Vous serez notifié"]);
                }
    		}
    		else{
                $affiliation = Affiliate::create(['referer_id' => $referer->id, 'referee_id' => $target->id]);
                $admin->notify(new Affiliation($referer, $target));
    			return response()->json(['success' => "Opération réussie!"]);
    		}
    	}
    	else{
    		return response()->json(['errors' => "L'adresse ne correspond à aucun utilisateur. Rassurez-vous que l'utilisateur s'est déja enregistré"]);
    	}
    }


    public function manageAffiliation(Request $request)
    {
        $status = $request->status;
        $aff = Affiliate::where('referee_id', $request->referee)->first();

        if ($status) {
            if ($aff !== null) {
                $referer = Member::find($aff->referer_id);
                $referee = User::find($aff->referee_id);
                if ($referer !== null && $referee !== null) {
                    if ($referee->member !== null) {
                        $member = Member::find($referee->member->id);
                        $member->referer = $referer->id;
                        $member->save();
                        Bonus::create([
                            'beneficier' => $referer->id,
                            'value' => Bonus::__bonuser(),
                            'title' => 'Affiliation de ' . $referee->name
                            ]);
                        $aff->delete();
                        return $this->getNotifications();
                    }
                    else{
                        
                    }
                    return response()->json([$referer, $referee]);
                }
                else{
                    $aff->delete();
                    return $this->getNotifications();
                }
            }
        }
        else{
            $aff->delete();
            return $this->getNotifications();
        }
        return response()->json($request->all());
    }
}
