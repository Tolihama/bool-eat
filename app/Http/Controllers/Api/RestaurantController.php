<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['categories:name'])
            ->select(["id", "name", "thumb", "cover", "address", "slug"])
            ->paginate(15);

        foreach ($restaurants as $restaurant) {
            if (!preg_match('/http/', $restaurant->thumb)) {
                $restaurant->thumb = url("storage/{$restaurant->thumb}");
            }
            if (!preg_match('/http/', $restaurant->cover)) {
                $restaurant->cover = url("storage/{$restaurant->cover}");
            }
        }

        return response()->json($restaurants);
    }

    public function filtered_by_categories($categories)
    {
        // Search of the restaurants id linked with the categories
        $restaurantsId = DB::table("category_restaurant")
            ->whereIn("category_id", explode(",", $categories))->select("restaurant_id")->distinct()->get();
        $restaurantsIdArray = [];
        foreach ($restaurantsId as $restaurant) {
            $restaurantsIdArray[] = $restaurant->restaurant_id;
        }
        $restaurants = Restaurant::with(['categories:name'])
            ->whereIn("id", $restaurantsIdArray)
            ->select(['id', 'slug', 'name', 'thumb', 'cover', 'address'])
            ->paginate(15);

        foreach ($restaurants as $restaurant) {
            if (!preg_match('/http/', $restaurant->thumb)) {
                $restaurant->thumb = url("storage/{$restaurant->thumb}");
            }
            if (!preg_match('/http/', $restaurant->cover)) {
                $restaurant->cover = url("storage/{$restaurant->cover}");
            }
        }
        return response()->json($restaurants);
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)
            ->with(['categories:id,name'])
            ->select(['id', 'name', 'slug', 'thumb', 'cover', 'address'])
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
