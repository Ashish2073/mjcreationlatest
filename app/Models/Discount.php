<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VendorProduct;

class Discount extends Model
{
    use HasFactory;
    protected $table = "discounts";

    public function products()
    {
        return $this->belongsToMany(VendorProduct::class, 'product_discounts')
            ->withTimestamps();
    }



}
