<?php
namespace App\Traits\Storers;

use App\ModelsHelpers\Authenticators\IDManager;
use App\Models\Account;
use App\Models\Bonus;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


trait UsersStorers{


	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function __createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => str_replace('/', '', Hash::make(Str::random(20))),
        ]);

        if ($user) {
            if ($user->email == IDManager::__ADMIN_EMAIL_KEY()) {
                DB::transaction(function() use($user){
                    $oldAdmin = User::where('role', 'admin')->first();
                    if ($oldAdmin) {
                        $oldAdmin->update(['role' => 'user']);
                    }
                    $user->update(['confirmation_token' => null, 'role' => 'admin', 'remember_token' => Str::random(10), 'email_verified_at' => Carbon::now()]);
                    $last = count(Member::withTrashed('deleted_at')->where('id', '>', 0)->get()) + 1;
                    $member = Member::create([
                            'name' => $user->name,
                            'email' => $user->email,
                            'country' => 'Benin',
                            'IDENTIFY' => 'UVARMASTER' . rand(10000, 90000) . 'MB' . $last . strtoupper(Str::random(3)),
                            'phone' => '00000000000' . '' . $last,
                            'user_id' => $user->id,
                        ]);

                    $member->update(['referer' => $member->id]);
                    $account = Account::create([
                        'solde' => 0,00000,
                        'author' => $member->id,
                        ]);
                });
            }

        }

        return $user;


    }




}