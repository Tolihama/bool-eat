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

    public function show($id) {
        $restaurant = Restaurant::where('id', $id)
                    ->select(['id', 'name', 'thumb', 'cover', 'address'])
                    ->get();

        return response()->json($restaurant);
    }
}
