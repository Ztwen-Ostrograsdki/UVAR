<?php
namespace App\Traits\Storers;

use App\Models\Account;
use App\Models\Member;
use App\Models\User;


trait Affiliator{


	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function __MemberBuilder($referer, User $user)
    {
        $done = Member::create([
            'name' => $user->name,
            'email' => $user->email,
            'referer' => $referer,
            'user_id' => $user->id,
        ]);
        if ($done) {
            $account = Account::create(['author' => $done->id]);
            if ($account) {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }




}
