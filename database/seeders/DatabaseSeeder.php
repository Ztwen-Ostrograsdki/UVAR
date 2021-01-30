<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(20)->create();

     //    $users = \App\Models\User::all();
     //    $levels = ['beginner', 'level-1', 'level-2', 'level-3', 'level-4'];
    	// $countries = ['Bénin', 'Togo', 'Ghana', 'France', 'Brezil', 'Sénégal', 'Belgique', 'Nigéria'];
    	// $sexes = ['male', 'female'];

     //    foreach ($users as $user) {
     //    	$last = (\App\Models\Member::count());
     //    	if ($last <= 9) {
     //    		$last = '0' + $last;
     //    	}
     //    	else{
     //    		$last = $last;
     //    	}
     //    	$country = $countries[rand(0, 7)];
     //    	$sexe = $sexes[rand(0, 1)];
     //    	$l = rand(0, 4);
     //        $member = \App\Models\Member::create([
     //            'name' => $user->name,
     //            'email' => $user->email,
     //            'IDENTIFY' => 'UVAR' . rand(10000, 90000) . 'Mb' . $last,
     //            'level' => $levels[$l],
     //            'country' => $country,
     //            'phone' => rand(51978425, 99989899),
     //            'sexe' => $sexe,
     //            'user_id' => $user->id
     //        ]);
     //    }

        
    }
}
