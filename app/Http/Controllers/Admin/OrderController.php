<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\Dish;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant_id = DB::table('restaurants')->where('user_id', Auth::id())->first()->id;
        $orders = Order::where('restaurant_id', $restaurant_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['restaurant'])->where('id', $id)->first();
        if($order->restaurant->user_id != Auth::id()){
            abort(403);
        }

        $dishes = DB::table('dish_order')
                    ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
                    ->where('order_id', $id)
                    ->select(["quantity", "dishes.name", "dishes.slug", "dishes.thumb"])
                    ->get();
        return view('admin.orders.show', compact('order', 'dishes'));
    }
}
