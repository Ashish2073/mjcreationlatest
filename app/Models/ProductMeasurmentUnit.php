<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeasurmentUnit extends Model
{
    use HasFactory;
    protected $table = "product_measurment_units";

    protected $fillable = [
        'name',


    ];
}
