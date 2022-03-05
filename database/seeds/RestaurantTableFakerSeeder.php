<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

use App\User;
use App\Restaurant;


class RestaurantTableFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 100; $i++){
            $new_user = new User;
            $new_user->name = $faker->word();
            $new_user->email = "user{$i}@email.com";
            $new_user->password = Hash::make('012345678');
            $new_user->save();

            $new_restaurant = new Restaurant();
            $new_restaurant->name = $faker->word(rand(1, 5), true); 
            $new_restaurant->user_id = DB::table('users')->select('id')->where('email', "user{$i}@email.com")->first()->id;

            //SLUG
            $slug = Str::slug($new_restaurant->name,'-');
            $count = 1;
            $base_slug = $slug;
            while (Restaurant::where('slug', $slug)->first()) {
                $slug = $base_slug . '-' . $count;
                $count++;
            }
            $new_restaurant->slug = $slug;

            $new_restaurant->thumb = $faker->imageUrl(200, 200, 'restaurant_thumb', true);
            $new_restaurant->cover = $faker->imageUrl(640, 480, 'restaurant_cover', true);
            $new_restaurant->address = "via di prova n {$i} ";
            $new_restaurant->vat = "12345678912";
            $new_restaurant->save();

            $categories = [];
            $num_categories = rand(1, 3);
            do {
                $rand_category = rand(1, 11);
                if (!in_array($rand_category, $categories)) {
                    array_push($categories, $rand_category);
                } else {
                }
            } while (count($categories) <= $num_categories);
            $new_restaurant->categories()->sync($categories);
            echo "{$i}%\n";
        }
    }
}
