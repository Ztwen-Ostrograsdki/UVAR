<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Action;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shopping;
use App\Models\ShoppingAction;
use App\Models\User;
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

        // $users = User::all();
        // $products = Product::all()->pluck('id')->toArray();


        // foreach ($users as $user) {
        //     $ts = array_slice($products, 0, rand(1, 4));
            
        //     Shopping::create([
        //         "user_id" => $user->id,
        //         "product_id" => ,
        //         "total" => rand(1, 10)
        //         ]);
        // }
        // \App\Models\User::factory(20)->create();
        // \App\Models\Action::factory(100)->create();


     //    $users = \App\Models\User::all();
     //    $levels = ['beginner', 'level-1', 'level-2', 'level-3', 'level-4'];
    	// $countries = ['Bénin', 'Togo', 'Ghana', 'France', 'Brezil', 'Sénégal', 'Belgique', 'Nigéria'];
    	// $sexes = ['male', 'female'];

     //    foreach ($users as $user) {
     //    	$last = (\App\Models\Member::count());
     //    	if ($last <= 9) {
     //    		$last = '0' . $last;
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
     //        $account = \App\Models\Account::create([
     //            'solde' => (float)rand(1000, 1000000),
     //            'author' => $member->id
     //        ]);

     //        $s_a = \App\Models\ShoppingAction::create([
     //            'action_id' => rand(1, 86),
     //            'member_id' => $member->id,
     //            'total' => rand(1, 7),
     //        ]);


     //    }
     //     \App\Models\Category::factory(10)->create();
        // \App\Models\Product::factory(30)->create();


          // $categories = Category::all()->pluck('id')->toArray();
          // $products = Product::all();
          // foreach ($products as $p) {
          //       $p->categories()->attach(array_slice($categories, 0, rand(1, 4))); 
          // }


        
    }
}
