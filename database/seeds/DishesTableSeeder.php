<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = config('diches-seed');

        foreach ($dishes as $dish){
            $new_dish = new Dish();
            $new_dish->name = $dish['name'];
            $new_dish->restaurant_id = DB::table('restaurants')->select('id')->first();
            $new_dish->slug = Str::slug($new_dish->name,'-');
            $new_dish->ingredients = $dish['ingredients'];
            $new_dish->description = $dish['description'];
            $new_dish->price = $dish['price'];
            $new_dish->is_visible = $dish[0];
            
            $new_dish->save(); 
        }
    }
}
