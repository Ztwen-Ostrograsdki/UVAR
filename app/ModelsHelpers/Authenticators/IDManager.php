<?php

namespace App\ModelsHelpers\Authenticators;

use App\Models\Member;
use App\Models\User;

class IDManager{

	private $ID;

	public function __construct(Member $member){

	}


	public static function __GENERATOR($member)
	{
		
	}


	public static function __USER_LOCKER(User $user)
	{
		$user = $user->update(['confirmation_token' => 'locked']);
		if ($user) {
			return true;
		}
		return false;
	}

	public static function __USER_DISLOCKER(User $user)
	{
		$user = $user->update(['confirmation_token' => null]);
		if ($user) {
			return true;		
		}
		return false;
	}




}