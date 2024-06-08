<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Productcategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorCategoryCommision;
use Illuminate\Validation\Rule;
use App\Models\VendorOrderCommision;
use App\Models\VendorProductCommision;
use Yajra\DataTables\Facades\Datatables;
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


    public function vendorcommisioncategorylist(Request $request)
    {

        $vendorCommision = VendorCategoryCommision::query()
            ->join('vendors', 'vendors.id', '=', 'vendor_commision_categories.vendor_id')
            ->join('product_categories', 'product_categories.id', '=', 'vendor_commision_categories.category_id')
            ->select(
                'vendors.name as name',
                'vendors.id as vendor_id',
                'vendor_commision_categories.id as id',
                'vendors.vendor_image as vendorimage',
                'product_categories.name as category_name',
                \DB::raw("DATE_FORMAT(vendor_commision_categories.created_at ,'%d/%m/%Y') AS created_date"),
                \DB::raw("DATE_FORMAT(vendor_commision_categories.updated_at ,'%d/%m/%Y') AS updated_date"),
                'vendor_commision_categories.amount as amount',
                'vendor_commision_categories.type as type',
                'vendor_commision_categories.priority as commisionpriority'
            )
            ->orderBy('vendor_commision_categories.created_at', 'desc');





        return Datatables::of($vendorCommision)
            ->addIndexColumn()

            ->addColumn('vendor_profile_image', function ($row) {
                if (isset($row->vendor_image)) {
                    $url = asset("vendor_image/{$row->vendorimage}");
                } else {
                    $url = asset("vendor_image/vendor_vector.jpeg");
                }


                $vendorimg = "<img src={$url} width='30'  height='50' />";

                return $vendorimg;
            })

            ->addColumn('commisionpriority', function ($row) {

                $commisionpriority_text = $row->commisionpriority == 1 ? 'Active' : 'Inactive';

                $commisionpriority_btn = $row->commisionpriority == 1 ? 'btn btn-success' : 'btn btn-danger';

                $commisionpriority_status = "<button type='button' id='commisionprioritychange$row->id' onclick='changecommisionpriority($row->id,$row->vendor_id)' 
                class='$commisionpriority_btn ml-2'>$commisionpriority_text</button>";

                return $commisionpriority_status;



            })





            ->addColumn('action', function ($row) {
                $btn = '<button type="button" id="editcategorycommision' . $row->id . '" onclick="editCategoryCommision(' . $row->id . ',' . $row->vendor_id . ')" class="edit btn btn-primary mr-2" style="margin-right: 5px;"><i class="ti-pencil-alt"></i></button>';
                $btn .= '<button type="button" onclick="deleteCategoryCommision(' . $row->id . ', ' . $row->vendor_id . ')" class="delete btn btn-danger "><i class="ti-trash"></i></button>';
                return $btn;
            })


            ->rawColumns(['action', 'vendor_profile_image', 'commisionpriority'])
            ->make(true);




    }


    public function vendorcommisionproductlist(Request $request)
    {

        $vendorCommision = VendorProductCommision::query()
            ->join('vendors', 'vendors.id', '=', 'vendor_commision_products.vendor_id')
            ->join('vendor_products', 'vendor_products.id', '=', 'vendor_commision_products.product_id')
            ->select(
                'vendors.name as name',
                'vendors.vendor_image as vendorimage',
                'vendor_products.product_title as product_title',
                \DB::raw("DATE_FORMAT(vendor_commision_products.created_at ,'%d/%m/%Y') AS created_date"),
                \DB::raw("DATE_FORMAT(vendor_commision_products.updated_at ,'%d/%m/%Y') AS updated_date"),
                'vendor_commision_products.amount as amount',
                'vendor_commision_products.type as type',
                'vendor_commision_products.priority as commisionpriority',
                'vendor_products.product_banner_image as vendor_product_banner_image',
                'vendor_commision_products.id as id'
            )
            ->orderBy('vendor_commision_products.created_at', 'desc');





        return Datatables::of($vendorCommision)
            ->addIndexColumn()

            ->addColumn('vendor_profile_image', function ($row) {
                if (isset($row->vendor_image)) {
                    $url = asset("vendor_image/{$row->vendorimage}");
                } else {
                    $url = asset("vendor_image/vendor_vector.jpeg");
                }


                $vendorimg = "<img src={$url} width='30'  height='50' />";

                return $vendorimg;
            })

            ->addColumn('commisionpriority', function ($row) {

                $commisionpriority_text = $row->commisionpriority == 1 ? 'Active' : 'Inactive';

                $commisionpriority_btn = $row->commisionpriority == 1 ? 'btn btn-success' : 'btn btn-danger';

                $commisionpriority_status = "<button type='button' id='commisionprioritychange$row->id' onclick='changecommisionpriority($row->id)' 
                class='$commisionpriority_btn ml-2'>$commisionpriority_text</button>";

                return $commisionpriority_status;



            })

            ->addColumn('product_image', function ($row) {
                $url = asset("product/banner/{$row->vendor_product_banner_image}");

                $productimg = "<img src={$url} width='30' id='openModalImageShow' height='50' />";

                return $productimg;
            })





            ->addColumn('action', function ($row) {
                $btn = '<button type="button" id="editVendorCommisionProduct' . $row->id . '" onclick="editVendorCommisionProduct(' . $row->id . ')" class="edit btn btn-primary mr-2" style="margin-right: 5px;"><i class="ti-pencil-alt"></i></button>';
                $btn .= '<button type="button" onclick="deleteVendorCommisionProduct(' . $row->id . ')" class="delete btn btn-danger "><i class="ti-trash"></i></button>';
                return $btn;
            })


            ->rawColumns(['action', 'vendor_profile_image', 'commisionpriority', 'product_image'])
            ->make(true);




    }


    public function vendorcommisionperorderlist(Request $request)
    {

        $vendorCommision = VendorOrderCommision::query()
            ->join('vendors', 'vendors.id', '=', 'vendor_commision_orders.vendor_id')
            ->select(
                'vendors.name as name',
                'vendors.vendor_image as vendorimage',
                \DB::raw("DATE_FORMAT(vendor_commision_orders.created_at ,'%d/%m/%Y') AS created_date"),
                \DB::raw("DATE_FORMAT(vendor_commision_orders.updated_at ,'%d/%m/%Y') AS updated_date"),
                'vendor_commision_orders.amount as amount',
                'vendor_commision_orders.type as type',
                'vendor_commision_orders.priority as commisionpriority',
                'vendor_commision_orders.id as id'

            )
            ->orderBy('vendor_commision_orders.created_at', 'desc');





        return Datatables::of($vendorCommision)
            ->addIndexColumn()

            ->addColumn('vendor_profile_image', function ($row) {
                if (isset($row->vendor_image)) {
                    $url = asset("vendor_image/{$row->vendorimage}");
                } else {
                    $url = asset("vendor_image/vendor_vector.jpeg");
                }


                $vendorimg = "<img src={$url} width='30'  height='50' />";

                return $vendorimg;
            })

            ->addColumn('commisionpriority', function ($row) {

                $commisionpriority_text = $row->commisionpriority == 1 ? 'Active' : 'Inactive';

                $commisionpriority_btn = $row->commisionpriority == 1 ? 'btn btn-success' : 'btn btn-danger';

                $commisionpriority_status = "<button type='button' id='commisionprioritychange$row->id' onclick='changecommisionpriority($row->id)' 
                class='$commisionpriority_btn ml-2'>$commisionpriority_text</button>";

                return $commisionpriority_status;



            })







            ->addColumn('action', function ($row) {
                $btn = '<button type="button" id="editordercommision' . $row->id . '" onclick="editordercommision(' . $row->id . ')" class="edit btn btn-primary mr-2" style="margin-right: 5px;"><i class="ti-pencil-alt"></i></button>';
                $btn .= '<button type="button" onclick="deleteordercommision(' . $row->id . ')" class="delete btn btn-danger "><i class="ti-trash"></i></button>';
                return $btn;
            })


            ->rawColumns(['action', 'vendor_profile_image', 'commisionpriority'])
            ->make(true);




    }


    public function editvendorcommisioncategory(Request $request)
    {

        $vendorcategorycommision = VendorCategoryCommision::where('id', $request->id)->select('amount', 'type', 'priority', 'category_id')->first();
        $vendorCategory = Productcategory::find($vendorcategorycommision->category_id);
        $vendors = Vendor::find($request->vendor_id);



        if (isset($vendors->vendor_image)) {
            $url = asset("vendor_image/{$vendors->vendor_image}");
        } else {
            $url = asset("vendor_image/vendor_vector.jpeg");
        }


        return response()->json([
            'vendorcategory' => $vendorCategory,
            'vendorcategorycommision' => $vendorcategorycommision,
            'vendor_id' => $request->vendor_id,
            'vendor_name' => $vendors->name,
            'category_name' => $vendorCategory->name,
            'url' => $url,
            'id' => $request->id,
        ]);
    }


    public function updatecommisioncategory(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'category_commision_amount' => 'required',
            'category_commision_type' => 'required'

        ], [
            'category_commision_amount.required' => 'Please enter the amount',
            'category_commision_type.required' => 'please select the type field'
        ]);




        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),


            ], 422);


        }


        $vendorCommisionCategory = VendorCategoryCommision::find($request->id);

        $vendorCommisionCategory->amount = $request->category_commision_amount;

        $vendorCommisionCategory->type = $request->category_commision_type;

        $vendorCommisionCategory->save();

        return response()->json([
            'success' => true,
            "message" => "Updated Successfully",
            "amount" => $vendorCommisionCategory->amount,
            "type" => $vendorCommisionCategory->type,

        ], 200);




    }

    public function deleteCategoryCommision(Request $request)
    {

        $categoryCommision = VendorCategoryCommision::find($request->id);

        if ($categoryCommision) {
            $categoryCommision->delete();
            return response()->json(['message' => 'Category Commison  deleted successfully']);
        } else {
            return response()->json(['message' => 'Category Commison data not found'], 404);
        }

    }

    public function editvendorproductcommision(Request $request)
    {

        $vendorProductCommision = VendorProductCommision::where('id', $request->id)->select('vendor_id', 'product_id', 'amount', 'type', 'priority')->first();

        $vendors = Vendor::find($vendorProductCommision->vendor_id);

        $vendor_products = VendorProduct::find($vendorProductCommision->product_id);



        if (isset($vendors->vendor_image)) {
            $vendorimage = asset("vendor_image/{$vendors->vendor_image}");
        } else {
            $vendorimage = asset("vendor_image/vendor_vector.jpeg");
        }

        if (isset($vendor_products->product_banner_image)) {
            $productimageurl = asset("product/banner/{$vendor_products->product_banner_image}");

        } else {
            $oroductimageurl = asset("vendor_image/vendor_vector.jpeg");
        }

        return response()->json([


            'vendor_id' => $request->vendor_id,
            'vendor_name' => $vendors->name,
            'product_name' => $vendor_products->product_title,
            'vendorimage' => $vendorimage,
            'productimageurl' => $productimageurl,
            'amount' => $vendorProductCommision->amount,
            'type' => $vendorProductCommision->type,
            'id' => $request->id,
        ]);

    }

    public function updatecommisionproduct(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'product_commision_amount' => 'required',
            'product_commision_type' => 'required'

        ], [
            'product_commision_amount.required' => 'Please enter the amount',
            'product_commision_type.required' => 'please select the type field'
        ]);




        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),


            ], 422);


        }


        $vendorCommisionProduct = VendorProductCommision::find($request->id);

        $vendorCommisionProduct->amount = $request->product_commision_amount;

        $vendorCommisionProduct->type = $request->product_commision_type;

        $vendorCommisionProduct->save();

        return response()->json([
            'success' => true,
            "message" => "Updated Successfully",
            "amount" => $vendorCommisionProduct->amount,
            "type" => $vendorCommisionProduct->type,
        ], 200);

    }


    public function deletevendorcommisionproduct(Request $request)
    {

        $productCommision = VendorProductCommision::find($request->id);

        if ($productCommision) {
            $productCommision->delete();
            return response()->json(['message' => 'Product Commison  deleted successfully']);
        } else {
            return response()->json(['message' => 'Product Commison data not found'], 404);
        }

    }

    public function editordercommision(Request $request)
    {

        $vendorOrderCommision = VendorOrderCommision::where('id', $request->id)->select('vendor_id', 'amount', 'type', 'priority')->first();



        $vendors = Vendor::find($vendorOrderCommision->vendor_id);







        if (isset($vendors->vendor_image)) {
            $vendorimage = asset("vendor_image/{$vendors->vendor_image}");
        } else {
            $vendorimage = asset("vendor_image/vendor_vector.jpeg");
        }



        return response()->json([


            'vendor_id' => $request->vendor_id,
            'vendor_name' => $vendors->name,
            'vendorimage' => $vendorimage,
            'amount' => $vendorOrderCommision->amount,
            'type' => $vendorOrderCommision->type,
            'id' => $request->id,
        ]);

    }


    public function updatordercommision(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'perorder_commision_amount' => 'required',
            'perorder_commision_type' => 'required'

        ], [
            'perorder_commision_amount.required' => 'Please enter the amount',
            'perorder_commision_type.required' => 'please select the type field'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),


            ], 422);


        }


        $vendorCommisionOrder = VendorOrderCommision::find($request->id);

        $vendorCommisionOrder->amount = $request->perorder_commision_amount;

        $vendorCommisionOrder->type = $request->perorder_commision_type;

        $vendorCommisionOrder->save();

        return response()->json([
            'success' => true,
            "message" => "Updated Successfully",
            "amount" => $vendorCommisionOrder->amount,
            "type" => $vendorCommisionOrder->type,
        ], 200);









    }


    public function deletevendorcommisionperorder(Request $request)
    {

        $perOrderCommision = VendorOrderCommision::find($request->id);

        if ($perOrderCommision) {
            $perOrderCommision->delete();
            return response()->json(['message' => 'Per Order Commison  deleted successfully']);
        } else {
            return response()->json(['message' => 'Per Order Commison data not found'], 404);
        }



    }






}
