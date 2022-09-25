<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    use QueryCacheable;

    public $cacheFor = 60; // cache time, in seconds
    public $cacheDriver = 'file';


    public $timestamps = false;

    protected $fillable = [
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
    ];
}
