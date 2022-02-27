<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Dish;
use App\Restaurant;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!DB::table('restaurants')->where('user_id', Auth::id())->exists()) {
            return redirect()->route('admin.restaurant.create')->with(
                'status', 
                'Non puoi creare un nuovo piatto nel menù se prima non hai registrato il tuo ristorante!'
            );
        }
        $restaurant_id = DB::table('restaurants')->where('user_id', Auth::id())->first()->id;
        $dishes = Dish::where('restaurant_id', $restaurant_id)->get();
        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->store_validation_rules(), $this->validation_messages() );
        

        $data = $request->all();
        $new_dish = new Dish();

        $data['restaurant_id']= Restaurant::where( 'user_id', Auth::id() )->first()->id;

        //add img 
        if(array_key_exists('thumb', $data)){
            $data['thumb'] = Storage::put('dishes-images', $data['thumb']);
        }

        // slug univoco
        $slug = Str::slug($data['name'], '-');
        $count = 1;
        $base_slug = $slug;

        while(Dish::where('slug', $slug)->first()){
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        if(array_key_exists ('is_visible', $data)){
            $data['is_visible'] = true;
        } else {
            $data['is_visible'] = false;
        }

        $new_dish->fill($data);

        // dd($new_dish);
        $new_dish->save();

        return redirect()->route('admin.dishes.show', $new_dish->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        if(! $dish){
            abort(404);
        }

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish_edit = Dish::find($id);
        
        if (! $dish_edit){
            abort(404);
        }
        return view('admin.dishes.edit', compact('dish_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->update_validation_rules(), $this->validation_messages());

        $data = $request->all();

        //update the resource
        $dish = Dish::find($id);

        //img update 
        if($data['name'] != $dish->name){

        // slug univoco
        $slug = Str::slug($data['name'], '-');
        $count = 1;
        $base_slug = $slug;

        while(Dish::where('slug', $slug)->first()){
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        } else {

            $data['slug'] = $dish->slug;
        }

        if(array_key_exists ('is_visible', $data)){
            $data['is_visible'] = true;
        } else {
            $data['is_visible'] = false;
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.show', $dish->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_dish = Dish::find($id);

        if($delete_dish->thumb){
            Storage::delete($delete_dish ->thumb);
        }

        $delete_dish->delete();

        return redirect()->route('admin.dishes.index')->with('deleted', $delete_dish->name);
    }


    /**
     * VALIDATION RULES
     */
    private function store_validation_rules() {
        return [
            'name' => 'required|max:50',
            'price' => 'required|numeric|min:0|max:999.99',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'thumb' => 'required|file|mimes:jpg,jpeg,bmp,png'
        ];
    }

    private function update_validation_rules() {
        return [
            'name' => 'required|max:50',
            'price' => 'required|numeric|min:0|max:999.99',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'thumb' => 'file|mimes:jpg,jpeg,bmp,png'
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'Campo richiesto',
            'max' => 'Il campo :attribute ha un limite massimo di caratteri pari a :max',
            'thumb.required' => "È richiesta un'immagine del piatto!"
        ];
    }
}
