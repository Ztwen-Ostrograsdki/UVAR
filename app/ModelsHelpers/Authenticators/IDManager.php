<?php

namespace App\ModelsHelpers\Authenticators;

use App\Models\Member;
use App\Models\User;
use App\Models\Visitors;
use App\Notifications\NewVisitorNotification;

class IDManager{

	private $ID;

	public function __construct(Member $member){

	}


	public static function __GENERATOR($member)
	{
		
	}

	public static function __INCREMENT_VISITORS()
	{
		$admin = User::where('role', 'admin')->first();
        $ip = request()->ip();
        $existed = Visitors::where('ip_address', $ip)->first();

        if (!$existed) {
            $new_visitor = Visitors::create(['ip_address' => $ip]);
            if ($new_visitor) {
                $admin->notify(new NewVisitorNotification(count(Visitors::all())));
            }
        }
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

	public static function __ADMIN_EMAIL_KEY()
	{
		return 'uvaracademie@gmail.com';
	}




}