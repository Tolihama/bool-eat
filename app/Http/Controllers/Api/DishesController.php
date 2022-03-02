<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Dish;

class DishesController extends Controller
{
    public function index($restaurant) {
        $dishes = Dish::where('restaurant_id', $restaurant)
                ->where('is_visible', '1')
                ->select(['id', 'restaurant_id', 'name', 'slug', 'thumb', 'ingredients', 'description', 'price'])
                ->get();

        return response()->json($dishes);
    }
}
