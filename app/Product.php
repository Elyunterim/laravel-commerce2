<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'featured','recommend'];
}