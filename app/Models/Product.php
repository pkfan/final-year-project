<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Rennokki\QueryCache\Traits\QueryCacheable;
// use Rennokki\QueryCache\Traits\QueryCacheable;



class Product extends Model
{
    use HasFactory,QueryCacheable;

    public $cacheFor = 60; // cache time, in seconds
    public $cacheDriver = 'file';
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'brand',
        'status',
        // i just put these fields because COUNT() and AVG() make database and laravel collection slow
        // so i have decided that count it first and then update and insert which take less RAM and CPU as well as less OPERATIONs 
        // i think there are two options to do that. first make a shedule of 24 hours which update all products ratings and stars and orders
        // second one is that just when someone update or create(i mean comments and orders of product) then count and update
        'stars',
        'ratings',
        'orders',
        'shop_id',
        'supplier_id',
        'category_id',
        'admin_id'
    ];

     // relation with other tables
     public function productImages()
     {
         return $this->hasMany(ProductImage::class);
     }

     public function comments()
     {
         return $this->hasMany(Comment::class);
     }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
