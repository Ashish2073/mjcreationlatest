<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productspecficationheading extends Model
{
    use HasFactory;
    protected $table = "products_specification_headings";

    protected $fillable = [
        'name',


    ];
}
