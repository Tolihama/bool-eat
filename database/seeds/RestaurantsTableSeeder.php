<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurants-seed');
        $users = config('users-seed');
  
        for ($i = 0; $i < count($users); $i++){
            $new_user = new User;
            $new_user->name = $users[$i]['username'];
            $new_user->email = $users[$i]['e-mail'];
            $new_user->password = Hash::make('012345678');
            $new_user->bio = $users[$i]['bio'];
            $new_user->save();

            $new_restaurant = new Restaurant();
            $new_restaurant->name = $restaurants[$i]['name']; 
            $new_restaurant->user_id = DB::table('users')->select('id')->where('email',$users[$i]['e-mail'])->first()->id;
            $new_restaurant->slug = Str::slug($new_restaurant->name,'-');
            $new_restaurant->thumb = $restaurants[$i]['thumb'];
            $new_restaurant->cover = $restaurants[$i]['cover'];
            $new_restaurant->address = $restaurants[$i]['address'];
            $new_restaurant->vat = $restaurants[$i]['vat'];
            $new_restaurant->save();
            $new_restaurant->categories()->attach(rand(1, 11));
        }
    }
}
