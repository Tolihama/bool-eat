<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::select(['id','name','thumb'])->get();

        return response()->json($categories);
    }
}
