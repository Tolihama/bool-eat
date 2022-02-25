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
        $dishes = config('dishes-seed');

        foreach ($dishes as $dish){
            $new_dish = new Dish();
            $new_dish->name = $dish['name'];
            $new_dish->restaurant_id = DB::table('restaurants')->select('id')->first()->id;
            $new_dish->slug = Str::slug($new_dish->name,'-');
            $new_dish->ingredients = $dish['ingredients'];
            $new_dish->description = $dish['description'];
            $new_dish->price = floatval($dish['price']);
            $new_dish->thumb = $dish['thumb'];
            $new_dish->is_visible = false;
            
            $new_dish->save(); 
        }
    }
}
