<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Restaurant;
use App\Dish;

class HomeController extends Controller
{
    public function index()
    {
        $user_restaurant = Restaurant::where('user_id', Auth::id())->first();

        if ($user_restaurant) {
            $dishes = Dish::where('restaurant_id', $user_restaurant->id)->get();
            $dishes_paginate = Dish::where('restaurant_id', $user_restaurant->id)->paginate(5);
        } else {
            $dishes = [];
            $dishes_paginate = $dishes;
        }
        return view('admin.home', compact('user_restaurant', 'dishes', 'dishes_paginate'));
    }
}
