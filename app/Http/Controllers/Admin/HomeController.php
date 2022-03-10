<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Restaurant;
use App\Dish;
use App\Order;

class HomeController extends Controller
{
    public function index()
    {
        $user_restaurant = Restaurant::where('user_id', Auth::id())->first();

        if ($user_restaurant) {
            $dishes = Dish::where('restaurant_id', $user_restaurant->id)->get();
            $dishes_paginate = Dish::where('restaurant_id', $user_restaurant->id)->paginate(5);
            $orders = Order::where('restaurant_id', $user_restaurant->id)->orderBy('created_at', 'desc')->paginate(3);
        } else {
            $orders = [];
            $dishes = [];
            $dishes_paginate = $dishes;
        }
        return view('admin.home', compact('user_restaurant', 'dishes', 'dishes_paginate', 'orders'));
    }
}
