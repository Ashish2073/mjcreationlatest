<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPriceDetail;
use App\Models\ProductDiscount;
use App\Models\Discount;
use App\Models\Productcategory;

class VendorProduct extends Model
{
  use HasFactory;
  protected $table = "vendor_products";

  protected $fillable = [
    'vendor_id',
    'product_category_id',
    'product_title',
    'brand_id',
    'product_total_stock_quantity',
    'discription',
    'product_warrenty',
    'measurment_parameter_name',
    'measurment_unit_name',
    'product_measurment_quantity',
    'product_measurment_quantity_price',
    'product_currency_type',
    'product_stock_quantity',
    'product_color',
    'product_color_stock',
    'product_other_expenditure_cost',
    'product_other_expenditure_currency_type',
    'product_other_expenditure_resaon',
    'product_specification_heading',
    'product_specification',
    'product_specification_details',
    'product_discount_name',
    'product_discount_percentage',
    'product_discount_start_date',
    'product_discount_end_date',
    'product_discount_detail',
    'product_banner_image',
    'product_image_gallery',
    'product_color_image_gallery',
    'product_color_banner_image',
    'product_color_image_gallery'



  ];

  public static function getProductTitleIdIndexedArray()
  {
    $records = self::all();
    $nameIdArr = [];
    foreach ($records as $record) {
      $nameIdArr[strtolower($record->product_title)] = $record->id;
    }
    return $nameIdArr;
  }


  public static function getBranIdIndexedArray()
  {
    $records = self::all();
    $nameIdArr = [];
    foreach ($records as $record) {
      $nameIdArr[strtolower($record->product_title)] = $record->brand_id;
    }
    return $nameIdArr;
  }



  public function productMeasurmentPriceDeatils()
  {
    return $this->hasMany(ProductPriceDetail::class, 'product_id');
  }


  public function discounts()
  {
    return $this->belongsToMany(Discount::class, 'product_discounts')
      ->withTimestamps();
  }

  public static function vendorCategory($id)
  {
    $vendorProductCategories = Productcategory::select('product_categories.name as categoryname', 'product_categories.id as category_id')
      ->join('vendor_products', 'vendor_products.product_category_id', '=', 'product_categories.id')
      ->where('vendor_products.vendor_id', $id)
      ->distinct()
      ->get();

    return $vendorProductCategories;
  }


}
