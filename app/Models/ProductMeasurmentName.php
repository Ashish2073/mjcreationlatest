<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeasurmentName extends Model
{
    use HasFactory;
    protected $table = "product_measurment_parameters";

    protected $fillable = [
        'name',


    ];
}
