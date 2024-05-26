<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VendorProduct;
use App\Models\ProductDiscount;

class Discount extends Model
{
    use HasFactory;
    protected $table = "discounts";

    public function products()
    {
        return $this->belongsToMany(Discount::class, 'product_discounts')
            ->withTimestamps();
    }



}
