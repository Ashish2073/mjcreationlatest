<?php

namespace App\Imports;

use App\Models\VendorProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Productcategory;
use App\Models\Productbrand;
use Maatwebsite\Excel\Concerns\ToCollection; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class VendorProductImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $response;
    private $current=0; 

    public $sheeterror=[];

    public $productcategoryArrayData=[];
//     public function model(array $row)
//     {
//         $this->current++;

//         if($this->current>1){
        
//             $product_category_id=Productcategory::where('name',$row[0])->first();

//             if(!isset( $product_category_id)){
//                 $sheetError[] = [
//                     'message' => 'University not given!',
//                     'record' => $row[0],
//                     'rowNumber' => $this->current,
//                 ];

//                 $this->response=['error'=>$sheetError];

//                 return $this->response;

//              }else{
                
//              }
             
//             //     $vendorProduct=new VendorProduct();

//             // }
          

        

       
//     }
// }

    // public function rules(): array
    // {
    //     return [
    //         'product_category' => 'required',
    //         'password' => 'required|min:5',
    //         'email' => 'required|email|unique:users'
    //     ];

    // }

    public function collection(Collection $records){
        $records = $records->reject(function ($item) {
            return empty(array_filter($item->all(), function ($value) {
                return !is_null($value);
            }));
        });

        $productNameIdArr = Productcategory::getNameIdIndexedArray();
        $productBrandNameArr=Productbrand::getProductBrandIdIndexedArray();
        $dataToInsertOrUpdate=[];
        
        $sheetError = []; 
        $rowNumber = 1;

      
        foreach($records as $k=>$record){
            $rowNumber++;


              $dataToInsertOrUpdate[$k]['vendor_id']=1;
              $dataToInsertOrUpdate[$k]['status']='1';

          
            if(!isset($record['product_category'])){
              
                
                Log::debug('Product Category  not given !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product Category not given!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];
         
            

            }


            if(!isset($record['product_title'])){

                Log::debug('product title  not given !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product title not given!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];
          


            }else{
                $dataToInsertOrUpdate[$k]['product_title']=trim(($record['product_title']));
            }

            if(!isset($record['brand_name'])){

                Log::debug('Brand  not given !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Brand not given!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];
         


            }
            if(!isset($record['total_product_quantity'])){

                Log::debug('Product Quantity not given !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product Quantity not given!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];
           


            }elseif(!is_numeric($record['total_product_quantity'])){
                Log::debug('Product Quantity not numeric !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product Quantity not numeric !',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];


            }else{
                $dataToInsertOrUpdate[$k]['product_total_stock_quantity']=trim(($record['total_product_quantity']));


            }

            if(!isset($record['discription'])){

                Log::debug('Product Description   not given !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product Description not given!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];
           


            }else{

                $dataToInsertOrUpdate[$k]['discription']=trim(($record['discription']));

            }


            if(!isset($record['product_warrenty'])){

                Log::debug('Product Warrenty   not given !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product Warrenty not given!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];
           


            }else{

                $dataToInsertOrUpdate[$k]['product_warrenty']=trim(($record['product_warrenty']));

            }






          
            if(!isset($productNameIdArr[trim(strtolower($record['product_category']))])){
                // dd($productNameIdArr);productBrandNameArr
                // Log::debug('Product Category not matched With our Records !' . json_encode($record));
                $sheetError[] = [
                'message' => 'Product Category not matched With our Records!',
                'record' => $record,
                'rowNumber' => $rowNumber,
            ];


           

            }else{
                $dataToInsertOrUpdate[$k]['product_category_id']=$productNameIdArr[trim(strtolower($record['product_category']))];
            }

            if(!isset($productBrandNameArr[trim(strtolower($record['brand_name']))])){
                $sheetError[] = [
                    'message' => 'Product Brands  not matched With our Records!',
                    'record' => $record,
                    'rowNumber' => $rowNumber,
                ];

            }else{
                $dataToInsertOrUpdate[$k]['brand_id']=$productBrandNameArr[trim(strtolower($record['brand_name']))];

            }

            




        }

        if(empty($sheetError)){


          
            $vendorProduct=VendorProduct::upsert($dataToInsertOrUpdate,['product_title'],['product_total_stock_quantity','discription','product_warrenty','brand_id','product_category_id']);

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
