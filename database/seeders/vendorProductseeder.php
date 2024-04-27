<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorProduct;
use Faker\Factory as faker;

class vendorProductseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();

        for($i=0;$i<10000;$i++){

        
        $vendorProduct=new VendorProduct();
        $vendorProduct->vendor_id=1;

        $vendorProduct->product_category_id=1;
        $vendorProduct->product_title=$faker->name.$i;
        $vendorProduct->brand_id=2;
        $vendorProduct->product_total_stock_quantity=160;
        $vendorProduct->discription=NuLL;
        $vendorProduct->product_warrenty=NULL;


        $vendorProduct->measurment_parameter_name=NULL;
       
        $vendorProduct->measurment_unit_name=NULL;



        $vendorProduct->product_measurment_quantity=NUll;

        $vendorProduct->product_measurment_quantity_price=NUll;

        $vendorProduct->product_currency_type=NUll;

        $vendorProduct->product_stock_quantity=NULL;
       
        $vendorProduct->product_color=NULL;
        $vendorProduct->product_color_stock=NULL;

        
        $vendorProduct->product_specification_heading=Null;
        $vendorProduct->product_specification=Null;

        $vendorProduct->product_specification_details=Null;

       

          
            $vendorProduct->product_banner_image=NULL;

      

       

            


            $vendorProduct->product_image_gallery=NULL;





        

    


            $vendorProduct->product_color_banner_image=NULL;





        


       

              

                
            $vendorProduct->product_color_image_gallery=NULL;
        

       








        $vendorProduct->save();

        }
    
}
}
