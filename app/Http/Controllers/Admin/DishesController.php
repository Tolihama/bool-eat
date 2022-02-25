<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Dish;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();

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
        $request->validate($this->validation_rules(), $this->validation_messages() );

        $data = $request->all();
        $new_dish = new Dish();

        //add img 
        if(array_key_exists ('thumb', $data)){
            $data['thumb'] = Storage::put('dishes-imgages', $data['thumb']);
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

        return view('admin.dishes.show', $new_dish->slug);


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
        return view('admin.dishes.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //validation rules

    private function validation_rules(){
        return [
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'ingredients' => 'required|max:255',
            // 'thumb' => 'required|file|mimes:jpg,jpeg,bmp,png'
        ];
    }

    private function validation_messages(){
        return [
            'required' => 'The :attribute is a required filed!',
            'max' => 'Max :max characters allowed for the :attribute!',
        ];
    }

}
