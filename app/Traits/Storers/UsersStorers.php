<?php
namespace App\Traits\Storers;

use App\Models\User;
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => str_replace('/', '', Hash::make(Str::random(20))),
        ]);
    }




}