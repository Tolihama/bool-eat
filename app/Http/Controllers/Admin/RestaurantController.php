<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->db_restaurant_check()) {
            $restaurant = Restaurant::where('user_id', Auth::id())->first();
            return redirect()->route('admin.restaurant.show', $restaurant->slug);
        } else {
            return redirect()->route('admin.restaurant.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if ($this->db_restaurant_check()) {

            $restaurant = Restaurant::where('user_id', Auth::id())->first();
            return redirect()->route('admin.restaurant.show', $restaurant->slug);

        } else {

            return view('admin.restaurant.create', compact('categories'));
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate($this->store_validation_rules(), $this->validation_messages());
        $data = $request->all();

        // New Restaurant istance
        $new_restaurant = new Restaurant();

        // User id assign to restaurant
        $new_restaurant->user_id = Auth::id();

        // Slug
        $slug = Str::slug($data['name'], '-');
        $count = 1;
        $base_slug = $slug;

        while(Restaurant::where('slug', $slug)->first()) {
            $slug = $base_slug . '-' . $count;
        }

        $data['slug'] = $slug;

        /**
         * IMAGES
         */
        // Thumb
        if(array_key_exists('thumb', $data)) {
            $data['thumb'] = Storage::put('restaurant-image', $data['thumb']);
        } 

        // Cover
        if(array_key_exists('cover', $data)) {
            $data['cover'] = Storage::put('restaurant-image', $data['cover']);
        }

        $new_restaurant->fill($data);
        $new_restaurant->save();

        // Categories
        if(array_key_exists('categories', $data)) {
            $new_restaurant->categories()->attach($data['categories']);
        }

        return redirect()->route('admin.restaurant.show', $new_restaurant->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        if (! $restaurant) {
            abort(404);
        }

        return view('admin.restaurant.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $restaurant = Restaurant::where('slug', $slug)->first();
        $categories = Category::all();

        return view('admin.restaurant.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate($this->update_validation_rules(), $this->validation_messages());
        // $request->validate(function() {});

        $data = $request->all();
        $restaurant = Restaurant::where('slug', $slug)->first();

        if(array_key_exists('thumb', $data)) {
            if ($restaurant->thumb) {
                Storage::delete($restaurant->thumb);
            } 

            $data['thumb'] = Storage::put('restaurants-images', $data['thumb']);
        }

        if(array_key_exists('cover', $data)) {
            if ($restaurant->cover) {
                Storage::delete($restaurant->cover);
            } 

            $data['cover'] = Storage::put('restaurants-images', $data['cover']);
        }
       
      
        if ($data['name'] != $restaurant->name) {
            $slug = Str::slug($data['name'], '-');
            $count = 1;
            $base_slug = $slug;

            // run the cicle if found the post with same slug
            while (Restaurant::where('slug', $slug)->first()) {
                // gen new slug with counter
                $slug .= $base_slug . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }
        else {
            $data['slug'] = $restaurant->slug;
        }

        if(array_key_exists('categories', $data)) {
            $restaurant->categories()->sync($data['categories']);
        } else {
            $restaurant->categories()->detach();
        }

        $restaurant->update($data);

        return redirect()->route('admin.restaurant.show', $restaurant->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        if($restaurant->thumb) {
            Storage::delete($restaurant->thumb);
        }

        if($restaurant->cover) {
            Storage::delete($restaurant->cover);
        }


        $restaurant->delete();

        $restaurant->categories()->detach();

        return redirect()->route('admin.home');
    }

    /**
     * CHECK USER / RESTAURANT
     */
    private function db_restaurant_check() {
        if (DB::table('restaurants')->where('user_id', Auth::id())->exists()) {
            return $check = true;
        } else {
            return $check = false;
        }
    }

    /**
     * VALIDATION RULES
     */
    private function store_validation_rules() {
        return [
            'name' => 'required|max:100',
            'vat' => 'required|size:11',
            'address' => 'required|max:150',
            'thumb' => 'required|file|mimes:jpeg,jpg,bmp,png',
            'cover' => 'required|file|mimes:jpeg,jpg,bmp,png',
            'categories' => 'present|array|exists:categories,id',
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'Campo richiesto',
            'max' => 'Il campo :attribute ha un limite massimo di caratteri pari a :max',
            'size.vat' => 'La partita IVA deve essere di 11 cifre',
            'categories.present' => 'È necessario selezionare almeno una categoria',
            'categories.exists' => 'La categoria selezionata non esiste',
        ];
    }

    private function update_validation_rules() {
        return [
            'name' => 'required|max:100',
            'vat' => 'required|size:11',
            'address' => 'required|max:150',
            'categories' => 'present|array|exists:categories,id',
        ];
    }
}
