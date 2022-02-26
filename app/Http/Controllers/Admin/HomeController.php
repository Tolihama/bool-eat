<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Restaurant;

class HomeController extends Controller
{
    public function index($id)
    {
        $user_restaurant = Restaurant::where('user_id', $id)->first();
        return view('admin.home', compact('user_restaurant'));
    }
}
