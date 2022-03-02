<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Restaurant;

class RestaurantController extends Controller
{
    public function index() {
        $restaurants = Restaurant::with(['categories'])->get();

        return response()->json($restaurants);
    }

    public function show($slug) {
        $restaurant = Restaurant::where('slug', $slug)
                    ->with(['categories:id,name'])
                    ->select(['id', 'name', 'thumb', 'cover', 'address'])
                    ->first();

        if (!preg_match('/http/', $restaurant->thumb)) {
            $restaurant->thumb = url("storage/{$restaurant->thumb}");
        }
        if (!preg_match('/http/', $restaurant->cover)) {
            $restaurant->cover = url("storage/{$restaurant->cover}");
        }

        return response()->json($restaurant);
    }
}
