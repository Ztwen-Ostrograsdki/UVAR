<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Traits\Storers\Affiliator;
use Illuminate\Http\Request;

class AffiliationsController extends Controller
{

	use Affiliator;

    public function affiliate(Request $request)
    {
    	$req = $request->email;
    	// $referer = auth()->user->member;

    	$target = User::where('email', $req)->first();
    	if ($target !== null) {
    		$already = Member::where('email', $req)->first();
    		if ($already !== null) {
    			//Le user est deja membre
    		}
    		else{
    			// $this->__MemberBuilder($referer, $target);
    			return response()->json(['success' => "Opération réussie!"]);
    		}
    	}
    	else{
    		return response()->json([
    				'invalids' => [
    					'email' => ["L'adresse ne correspond à aucun utilisateur. Rassurez-vous que l'utilisateur s'est déja enregistré"]
    					]
    				]);
    	}
    }
}
