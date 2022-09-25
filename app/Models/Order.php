<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'shipping_address',
        'description',
        'order_date',
        'status',
        'quantity',
    ];

    // relation with other tables
    public function product()
    {
        return $this->hasOne(Product::class);
    }

}
