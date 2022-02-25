<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'restaurant_id',
        'thumb',
        'ingredients',
        'is_visible'
    ];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
