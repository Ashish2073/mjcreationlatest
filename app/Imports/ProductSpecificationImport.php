<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Productcategory;
use App\Models\VendorProduct;
use App\Models\Productbrand;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ProductSpecificationImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public $response;


    public $sheeterror=[];

    public function collection(Collection $records)
    {
        $records = $records->reject(function ($item) {
            return empty(array_filter($item->all(), function ($value) {
                return !is_null($value);
            }));
        });


        

        $productNameIdArr = Productcategory::getNameIdIndexedArray();
        $productTitleNameArr=VendorProduct::getProductTitleIdIndexedArray();
       
        $productBrandNameArr=Productbrand::getProductBrandIdIndexedArray();
      
        
        $sheetError = []; 
        $rowNumber = 1;

        $convertedArray = [];

// Iterate through the original array
             foreach ($records as $k=>$item) {

                
            //   $convertedArray[$k]['vendor_id']=1;
            //   $convertedArray[$k]['status']='1';

   

                     if(!isset($item['product_category'])){
              
                
                     Log::debug('Product Category  not given !' . json_encode($item));
                                      $sheetError[] = [
                                      'message' => 'Product Category not given!',
                                      'record' => $item,
                                     'rowNumber' => $rowNumber,
                                     ];
 
    

    }

    if(!isset($item['product_title'])){
        Log::debug('Product Title  not given !' . json_encode($item));
        $sheetError[] = [
        'message' => 'Product Title not given!',
        'record' => $item,
        'rowNumber' => $rowNumber,
    ];

    }

    if(!isset($productTitleNameArr[trim(strtolower($item['product_title']))])){
     $sheetError[] = [
        'message' => 'Product Title not matched With our Records!',
        'record' => $item,
        'rowNumber' => $rowNumber,
        ];
    }


    if(!isset($productNameIdArr[trim(strtolower($item['product_category']))])){
        // dd($productNameIdArr);productBrandNameArr
        // Log::debug('Product Category not matched With our Records !' . json_encode($record));
        $sheetError[] = [
        'message' => 'Product Category not matched With our Records!',
        'record' => $item,
        'rowNumber' => $rowNumber,
    ];


   

    }









    $productTitle = stripslashes(trim($item['product_title']));
    $productHeading = stripslashes(trim($item['product_specification_heading']));
    $productSpecification = stripslashes(trim($item['product_specification']));
    $productDetails = stripslashes(trim($item['product_specification_details']));
    $productCategory_Id= $productNameIdArr[stripcslashes(trim(strtolower($item['product_category'])))];
    $productBrandNameId=$productBrandNameArr[stripcslashes(trim(strtolower($item['brand_name'])))];

    // Find existing product in converted array
    $index = null;
    foreach ($convertedArray as $key => $product) {
        if ($product['product_title'] === $productTitle) {
            $index = $key;
            break;
        }
    }

    // If product not found, create a new entry
    if ($index === null) {
        $convertedArray[] = [
            'product_title' => $productTitle,
            'product_specification_heading' => json_encode([$productHeading]),
            'product_specification' => json_encode([$productSpecification]),
            'product_specification_details' => json_encode([$productDetails]),
            'vendor_id' => 1,
            'status'=>'1',
            'product_category_id'=>$productCategory_Id,
            'brand_id'=>$productBrandNameId
        ];
    } else {
        // If product found, append data to existing entry
        $convertedArray[$index]['product_specification_heading'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_specification_heading'], true), [$productHeading]));
        $convertedArray[$index]['product_specification'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_specification'], true), [$productSpecification]));
        $convertedArray[$index]['product_specification_details'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_specification_details'], true), [$productDetails]));
    }
}

// Output the converted array

// Output the converted array



if(empty($sheetError)){


          
    $vendorProduct=VendorProduct::upsert($convertedArray,['product_title'],['product_specification_heading','product_specification','product_specification_details']);

}

       
        
if(empty($sheetError)){
           
    $this->response = [
        'success' => true,
        'title' => 'Sheet Imported',
        'code' => 'success',
         'message' => 'Sheet imported successfully',
        
    ];

    return $this->response;

}else{ 
    
  
    $this->response = [
        'success' => false,
        'title' => 'Sheet Not Imported',
        'code' => 'fail',
        'message' => 'Sheet Not Imported',
        'sheetError' => $sheetError,
    ];
   
  
    return $this->response;
   
    
}





}

public function chunkSize(): int
{
return 500;
}

public function batchSize(): int
{
return 100;
}




       
       




        
    }

