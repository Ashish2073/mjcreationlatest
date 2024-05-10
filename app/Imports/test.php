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

class ProductPrimaryCostImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public $response;


    public $sheeterror = [];
    public function collection(Collection $records)
    {

        $records = $records->reject(function ($item) {
            return empty (array_filter($item->all(), function ($value) {
                return !is_null($value);
            }));
        });


        dd($records);



        $productNameIdArr = Productcategory::getNameIdIndexedArray();
        $productTitleNameArr = VendorProduct::getProductTitleIdIndexedArray();

        $productBrandNameArr = Productbrand::getProductBrandIdIndexedArray();


        $sheetError = [];
        $rowNumber = 1;

        $convertedArray = [];

        // Iterate through the original array
        foreach ($records as $k => $item) {


            //   $convertedArray[$k]['vendor_id']=1;
            //   $convertedArray[$k]['status']='1';



            if (!isset($item['product_category'])) {


                Log::debug('Product Category  not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Product Category not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];



            }

            if (!isset($item['product_title'])) {
                Log::debug('Product Title  not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Product Title not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }

            if (!isset($item['measurment_parameter_name'])) {
                Log::debug('Measurment Parameter  not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Measurment Parameter not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }

            if (!isset($item['measurment_unit_name'])) {
                Log::debug('Measurment unit  not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Measurment unitnot given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }

            if (!isset($item['product_measurment_quantity'])) {
                Log::debug('Product Measurment  not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Measurment quantity not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }

            if (!isset($item['product_measurment_quantity_price'])) {
                Log::debug('Product price  not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'product price not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }

            if (!isset($item['product_currency_type'])) {
                Log::debug('Product currency not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Currency not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }

            if (!isset($item['product_stock_quantity'])) {
                Log::debug('Product Stock quantity not given !' . json_encode($item));
                $sheetError[] = [
                    'message' => 'Product Stock quantity not given!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];

            }





            if (!isset($productTitleNameArr[trim(strtolower($item['product_title']))])) {
                $sheetError[] = [
                    'message' => 'Product Title not matched With our Records!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];
            }


            if (!isset($productNameIdArr[trim(strtolower($item['product_category']))])) {
                // dd($productNameIdArr);productBrandNameArr
                // Log::debug('Product Category not matched With our Records !' . json_encode($record));
                $sheetError[] = [
                    'message' => 'Product Category not matched With our Records!',
                    'record' => $item,
                    'rowNumber' => $rowNumber,
                ];




            }









            $productTitle = stripslashes(trim($item['product_title']));

            $productMeasumentName = stripslashes(trim($item['measurment_parameter_name']));
            $measurmentUnitName = stripslashes(trim($item['measurment_unit_name']));


            $productMeasurementQuantity = stripslashes(trim($item['product_measurment_quantity']));
            $productSpecification = stripslashes(trim($item['product_measurment_quantity_price']));
            $productCurrencyType = stripslashes(trim($item['product_currency_type']));
            $productStockQuantity = stripslashes(trim($item['product_stock_quantity']));

            $productCategory_Id = $productNameIdArr[stripcslashes(trim(strtolower($item['product_category'])))];
            $productBrandNameId = $productBrandNameArr[stripcslashes(trim(strtolower($item['brand_name'])))];

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
                    'measurment_parameter_name' => $productMeasumentName,
                    'measurment_unit_name' => $measurmentUnitName,
                    'product_measurment_quantity' => json_encode([$productMeasurementQuantity]),
                    'product_measurment_quantity_price' => json_encode([$productCurrencyType]),
                    'product_currency_type' => json_encode([$productCurrencyType]),
                    'product_stock_quantity' => json_encode([$productStockQuantity]),
                    'vendor_id' => 1,
                    'status' => '1',
                    'product_category_id' => $productCategory_Id,
                    'brand_id' => $productBrandNameId
                ];
            } else {
                // If product found, append data to existing entry
                $convertedArray[$index]['product_measurment_quantity'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_measurment_quantity'], true), [$productMeasurementQuantity]));
                $convertedArray[$index]['product_measurment_quantity_price'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_measurment_quantity_price'], true), [$productCurrencyType]));
                $convertedArray[$index]['product_currency_type'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_currency_type'], true), [$productCurrencyType]));
                $convertedArray[$index]['product_stock_quantity'] = json_encode(array_merge(json_decode($convertedArray[$index]['product_stock_quantity'], true), [$productStockQuantity]));
            }
        }

        // Output the converted array

        // Output the converted array



        if (empty($sheetError)) {



            $vendorProduct = VendorProduct::upsert($convertedArray, ['product_title'], ['product_measurment_quantity', 'product_measurment_quantity_price', 'product_currency_type', 'product_stock_quantity']);

        }



        if (empty($sheetError)) {

            $this->response = [
                'success' => true,
                'title' => 'Sheet Imported',
                'code' => 'success',
                'message' => 'Sheet imported successfully',

            ];

            return $this->response;

        } else {


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
