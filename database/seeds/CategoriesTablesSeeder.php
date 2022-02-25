<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('categories-seed');

        foreach ($categories as $category){
            $new_category = new Category();
            $new_category->name = $category['name'];
            $new_category->slug = Str::slug($new_category->name,'-');
            $new_category->thumb = $category['img'];
            
            $new_category->save(); 
        }
    }
}
