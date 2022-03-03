<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use SoftDeletes;

    /**
     * MASS ASSIGNMENT
     */
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

    /**
     * RELATIONS
     */
    // restaurants - dishes (one to many)
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    // orders - dishes (many to many)
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
