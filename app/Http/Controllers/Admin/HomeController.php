<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Restaurant;

class HomeController extends Controller
{
    public function index()
    {
/*         if ($id != Auth::id()) {
            abort(403);
        }

        $user_restaurant = Restaurant::where('user_id', $id)->first();
        return view('admin.home', compact('user_restaurant')); */
        return view('admin.home');
    }
}
