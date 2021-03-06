<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * MASS ASSIGNMENT
     */
    protected $fillable = [
        'name',
        'slug',
        'thumb',
        'cover',
        'address',
        'vat'
    ];

    /**
     * RELATIONS
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
