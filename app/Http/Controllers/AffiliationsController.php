<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Bonus;
use App\Models\Member;
use App\Models\User;
use App\Notifications\Affiliation;
use App\Notifications\ReferingMeNotification;
use App\Traits\Storers\Affiliator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function getNotifications($msg = null)
    {
        $notifs_a = Affiliate::all();
        $notifications_aff = [];

        foreach ($notifs_a as $notif) {
            $user = User::find($notif->referee_id);
            $member = Member::find($notif->referer_id);
            $notifications_aff[] = ['referer' => $member, 'referee' => $user, 'affiliate_id' => $notif->id, 'type' => 'affiliation', 'affiliation' => $notif];
        }
        return response()->json([
            'notifications' => $notifications_aff,
            'message' => $msg]);
    }

    public function affiliate(Request $request)
    {
        $admin = User::where('role', 'admin')->first();
    	$req = $request->email;
        $referer = auth()->user()->member;
    	$target = User::where('email', $req)->first();
        $token = str_replace('/', '', Hash::make(Str::random(30)));
    	if ($target !== null) {
            if ($target->id == auth()->user()->id) {
                return response()->json(['errors' => "Erreure: Vous ne pouvez pas effectuer cette requête"]);
            }
            $waiting = count(Affiliate::where('referee_id', $target->id)->where('referer_id', $referer->id)->get()->toArray());

            if ($waiting > 0) {
                return response()->json(['errors' => "Erreure: Vous avez déjà effectuer cette demande... UVAR vous prie de patienter"]);
            }
    		$user_member = $target->member;
    		if ($user_member !== null) {
    			//Le user est deja membre
                if ($user_member->referer_id !== null) {
                    return response()->json(['errors' => "Cet utilisateur est déja un membre réferé"]);
                }
                else{
                    $affiliation = Affiliate::create(['referer_id' => $referer->id, 'referee_id' => $target->id, 'token' => $token]);
                    if ($admin) {
                       $admin->notify(new Affiliation($referer, $target));
                       $target->notify(new ReferingMeNotification($referer, $affiliation));
                    }
                    //Mise à jour
                    return response()->json(['success' => "Mise à jour en cours: Vous serez notifié"]);
                }
    		}
    		else{
                $affiliation = Affiliate::create(['referer_id' => $referer->id, 'referee_id' => $target->id, 'token' => $token]);
                if ($admin) {
                    $target->notify(new ReferingMeNotification($referer, $affiliation));
                   $admin->notify(new Affiliation($referer, $target));
                }
    			return response()->json(['success' => "Opération réussie!"]);
    		}
    	}
    	else{
    		return response()->json(['errors' => "L'adresse ne correspond à aucun utilisateur. Rassurez-vous que l'utilisateur s'est déja enregistré"]);
    	}
    }


    
}
