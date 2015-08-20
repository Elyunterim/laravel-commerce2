<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'category_id',
        'name',
        'description',
        'price',
        'featured',
        'recommend'];

    public function category()
    {
        return $this->belongsTo('LaravelCommerce\Category');
    }

    public function images()
    {
        return $this->hasMany('LaravelCommerce\ProductImage');
    }

    public function tags()
    {
        return $this->belongsToMany('LaravelCommerce\Tag');
    }

    public function getNameDescritptionAttribute()
    {
        return $this->name . ' - ' . $this->description;
    }

    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();

        return implode(',', $tags);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured','=',1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend','=','1');
    }

    public function scopeOfCategory($query, $id)
    {
        return $query->where('category_id', '=', $id);
    }
}