<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Models
use App\User;
use App\Restaurant;
use App\Dish;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('last-seeder');
        $total_data = count($data);
        $i = 0;

        foreach ($data as $item) {
            // New user
            $user = new User();
            $user->name = $item['name'];
            $user->email = $item['email']; // verificare sia presente nel config
            $user->password = Hash::make('12345678');
            $user->save();

            // New restaurant
            $restaurant = new Restaurant();
            $restaurant->name = $item['name'];
            $restaurant->user_id = DB::table('users')->orderBy('id', 'desc')->first()->id;
            $restaurant->slug = Str::slug($item['name'], '-');
            $restaurant->thumb = $item['thumb'];
            $restaurant->cover = $item['cover'];
            $restaurant->address = $item['address'];
            $restaurant->vat = '06245000820';
            $restaurant->save();

            // Categories
            foreach ($item['category'] as $category) {
                $restaurant->categories()->attach($category);
            }

            // Dishes
            $restaurant_id = DB::table('restaurants')->orderBy('id', 'desc')->first()->id;
            foreach ($item['dishes'] as $dish) {
                $new_dish = new Dish();
                $new_dish->name = $dish['name'];
                $new_dish->restaurant_id = $restaurant_id;
                $new_dish->slug = Str::slug($new_dish->name, '-');
                $new_dish->ingredients = $dish['ingredients'];
                $new_dish->description = $dish['description'];
                $new_dish->price = floatval($dish['price']);
                $new_dish->thumb = $dish['thumb'];
                $new_dish->is_visible = true;
                $new_dish->save();
            }

            // Update count
            $i++;
            $percent = ($i / $total_data) * 100;
            $formatted_percent = number_format($percent, 2, '.', ',');
            echo "{$formatted_percent}% \n";
        }
    }
}
