<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    use HasFactory;
    protected $table="product_categories";

    public static function getNameIdIndexedArray()
  {
    $records = self::all();
    $nameIdArr = [];
    foreach ($records as $record) {
      $nameIdArr[strtolower($record->name)] = $record->id;
    }
    return $nameIdArr;
  }
}
