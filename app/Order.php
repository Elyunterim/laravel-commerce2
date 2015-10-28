<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
      'user_id',
        'total',
        'status'
    ];

    public function items()
    {
        return $this->hasMany('LaravelCommerce\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('LaravelCommerce\User');
    }
}
