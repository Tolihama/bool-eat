<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * MASS ASSIGNMENT
     */
    protected $fillable = [
        'restaurant_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'notes'
    ];
    
    /**
     * RELATIONS
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function dishes()
    {
        return $this->belongsToMany('App\Dish');
    }
}
