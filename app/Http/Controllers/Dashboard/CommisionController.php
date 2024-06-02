<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorCategoryCommision;
use Illuminate\Validation\Rule;
use App\Models\VendorOrderCommision;
use App\Models\VendorProductCommision;

use Illuminate\Support\Facades\Validator;
use App\Models\VendorProduct;

class CommisionController extends Controller
{
    public function vendorcomission(Request $request)
    {
        return view('managedashboard.vendor.commision.index');


    }

    public function vendorCategory(Request $request)
    {

        $vendorCategory = VendorProduct::vendorCategory($request->vendor_id);

        return response()->json([
            'vendorcategory' => $vendorCategory
        ]);

    }


    public function vendorcommisionperorder(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|unique:vendor_commision_orders',
            'perorderamount' => 'required',
            'perorderamount_commision_type' => 'required'

        ], [
            'vendor_id.unique' => 'All ready apply on it per order commision',
            'vendor_id.required' => 'Vendor Data required'
        ]);




        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),


            ], 422);


        }


        $vendorCommisionPerOrder = new VendorOrderCommision();

        $vendorCommisionPerOrder->vendor_id = $request->vendor_id;

        $vendorCommisionPerOrder->amount = $request->perorderamount;

        $vendorCommisionPerOrder->type = $request->perorderamount_commision_type;

        $vendorCommisionPerOrder->save();


        return response()->json([
            'message' => 'vendor commision on per order add successfully'
        ]);




    }


    public function vendorcommisioncategory(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required',
            'categoryamount' => 'required',
            'category_commision_type' => 'required',
            'category_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = VendorCategoryCommision::
                        where('vendor_id', $request->vendor_id)
                        ->where('category_id', $value)
                        ->exists();

                    if ($exists) {
                        $fail('On this vendor all ready apply commision on this category.');
                    }
                }
            ],
        ], [
            'vendor_id.required' => 'Vendor Data required',
            'category_id.required' => 'Please select Category Data',
        ]);





        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),


            ], 422);


        }


        $vendorCommisionCategory = new VendorCategoryCommision();

        $vendorCommisionCategory->vendor_id = $request->vendor_id;
        $vendorCommisionCategory->category_id = $request->category_id;

        $vendorCommisionCategory->amount = $request->categoryamount;

        $vendorCommisionCategory->type = $request->category_commision_type;

        $vendorCommisionCategory->save();


        return response()->json([
            'message' => 'vendor commision on Category add successfully'
        ]);




    }

    public function vendorcommisionproduct(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required',
            'product_commison_amount' => 'required',
            'product_commision_type' => 'required',
            'product_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = VendorProductCommision::
                        whereIn('product_id', $request->product_id)
                        ->where('vendor_id', $request->vendor_id)
                        ->exists();

                    if ($exists) {
                        $fail("On this Vendor's products commision all ready apply.");
                    }
                }
            ],
        ], [
            'vendor_id.required' => 'Vendor Data required',
            'product_id.required' => 'Please select product',
        ]);





        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),


            ], 422);


        }

        $productDiscounts = [];
        foreach ($request->product_id as $productId) {
            $productDiscounts[] = [
                'product_id' => $productId,
                'vendor_id' => $request->vendor_id,
                'amount' => $request->product_commison_amount,
                'type' => $request->product_commision_type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }


        $vendorProductCommison = VendorProductCommision::insert($productDiscounts);




        return response()->json([
            'message' => 'vendor commision on Category add successfully'
        ]);




    }


}
