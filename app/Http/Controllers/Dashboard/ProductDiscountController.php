<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Productcategory;
use App\Models\Productbrand;
use App\Models\VendorProduct;
use App\Models\ProductDiscount;
use App\Models\ProductMeasurmentName;
use App\Models\ProductMeasurmentUnit;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VendorProductImport;
use App\Models\Productspecficationheading;
use App\Imports\ProductSpecificationImport;
use App\Imports\ProductPrimaryCostImport;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use App\Models\ProductPriceDetail;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;



class ProductDiscountController extends Controller
{

    public function productdiscountview(Request $request)
    {
        if ($request->ajax()) {

            if (isset($request->vendor_id)) {

                $vendorProducts = VendorProduct::query()
                    ->join('product_categories', 'vendor_products.product_category_id', '=', 'product_categories.id')
                    ->join('product_brands', 'vendor_products.brand_id', '=', 'product_brands.id')
                    ->where('vendor_id', $request->vendor_id)
                    ->select('vendor_products.*', \DB::raw("DATE_FORMAT(vendor_products.created_at ,'%d/%m/%Y') AS created_date"), 'product_categories.name as product_categories_name', 'product_brands.name as brandname')
                    ->orderBy('vendor_products.created_at', 'desc');

            } else {

                if (Auth::guard('vendor')->user()->role == 1) {
                    $vendorProducts = VendorProduct::query()
                        ->join('product_categories', 'vendor_products.product_category_id', '=', 'product_categories.id')
                        ->join('product_brands', 'vendor_products.brand_id', '=', 'product_brands.id')
                        ->select('vendor_products.*', \DB::raw("DATE_FORMAT(vendor_products.created_at ,'%d/%m/%Y') AS created_date"), 'product_categories.name as product_categories_name', 'product_brands.name as brandname')
                        ->orderBy('vendor_products.created_at', 'desc');
                } else {
                    $vendorProducts = VendorProduct::query()
                        ->join('product_categories', 'vendor_products.product_category_id', '=', 'product_categories.id')
                        ->join('product_brands', 'vendor_products.brand_id', '=', 'product_brands.id')
                        ->where('vendor_id', Auth::guard('vendor')->user()->id)
                        ->select('vendor_products.*', \DB::raw("DATE_FORMAT(vendor_products.created_at ,'%d/%m/%Y') AS created_date"), 'product_categories.name as product_categories_name', 'product_brands.name as brandname')
                        ->orderBy('vendor_products.created_at', 'desc');


                }

            }





            return Datatables::of($vendorProducts)
                ->addIndexColumn()
                ->addColumn('product_image', function ($row) {
                    $url = asset("product/banner/{$row->product_banner_image}");

                    $productimg = "<img src={$url} width='30'  height='50'  />";

                    return $productimg;
                })

                ->addColumn('imgsrc', function ($row) {
                    $url = asset("product/banner/{$row->product_banner_image}");

                    return $url;

                })



                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" onclick="editProduct(' . $row->id . ',' . $row->product_category_id . ')" class="edit btn btn-primary mr-2"><i class="ti-pencil-alt"></i></button>';
                    $btn .= '<button type="button" onclick="deleteProduct(' . $row->id . ')" class="delete btn btn-danger "><i class="ti-trash"></i></button>';
                    return $btn;
                })


                ->rawColumns(['action', 'product_image', 'imgsrc'])
                ->make(true);


        }

        // $vendorProduct = VendorProduct::where('vendor_id', 1)->select('id', 'product_title')->get();
        // return view('managedashboard.product.productdiscount', ['vendorProduct' => $vendorProduct]);

    }

    public function saveproductdiscount(Request $request)
    {

        DB::beginTransaction();


        try {

            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'discount_title' => 'required|unique:discounts',
                'discount_banner_image' => 'required|image|mimes:jpeg,png,svg|max:1024',
                'product_discount_detail' => 'required',
                'product' => 'required',
                "discount_type" => 'required',
                'bulk_discount.quantity' => 'required_if:discount_type,1|integer|min:1',
                'bulk_discount.amount' => 'required_if:discount_type,1|numeric|min:0',
                'combo_discount.amount' => 'required_if:discount_type,2|numeric|min:0',
                'bulk_discount.amount_type' => 'required_if:discount_type,1|in:0,1',
                'combo_discount.amount_type' => 'required_if:discount_type,2|in:0,1',

            ], [

                'start_date.required' => 'Discount Start Date is required',
                'end_date.required' => 'Discount End Date is required',
                'discount_title.required' => 'Discount title field required',
                'discount_title.unique' => 'Discount title should be unique',
                'bulk_discount.quantity.required_if' => 'Bulk product quantity is required for bulk discount.',
                'bulk_discount_amount.required_if' => 'Bulk discount amount is required for bulk discount.',
                'combo_discount.amount.required_if' => 'Combo discount amount is required for combo discount.',
                'bulk_discount.amount_type.required_if' => 'Bulk amount type is required for bulk discount.',
                'combo_discount.amount_type.required_if' => 'Combo amount type is required for combo discount.',
                'product_discount_details.required' => 'Product discount details are required.',

            ]);


            if ($validator->fails()) {
                return response()->json([
                    'sucess' => false,
                    'errormessage' => $validator->errors(),


                ], 422);


            }


            $newdiscount = new Discount();
            $newdiscount->discount_title = $request->discount_title;
            $newdiscount->start_date = $request->start_date;
            $newdiscount->end_date = $request->end_date;
            $newdiscount->discount_type = $request->discount_type;
            $newdiscount->discount_data = json_encode($request->bulk_discount ?? $request->combo_discount);

            $newdiscount->details = $request->product_discount_detail;

            if ($request->hasFile('discount_banner_image')) {
                $originName = $request->file('discount_banner_image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('discount_banner_image')->getClientOriginalExtension();
                $fileName = $fileName . '__' . time() . '.' . $extension;
                $request->file('discount_banner_image')->move(public_path('product/banner'), $fileName);

                $newdiscount->banner_image = $fileName;

            }



            $newdiscount->save();


            $productDiscounts = [];
            foreach ($request->product as $productId) {
                $productDiscounts[] = [
                    'product_id' => $productId,
                    'discount_id' => $newdiscount->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }


            ProductDiscount::insert($productDiscounts);
            DB::commit();
            return response()->json(['message' => 'Discount created and applied to products successfully'], 201);



        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create discount and apply to products', 'error' => $e->getMessage()], 500);
        }




    }

    public function productdiscountlistview(Request $request)
    {

        if ($request->ajax()) {


            $discounts = Discount::query()

                ->orderBy('discounts.created_at', 'desc');



            return Datatables::of($discounts)
                ->addIndexColumn()
                ->addColumn('banner_image', function ($row) {
                    $url = asset("product/banner/{$row->banner_image}");

                    $discountimg = "<img src={$url} width='30' id='openModalImageShow' height='50' onclick='showProductImage({$row->id})' />";

                    return $discountimg;
                })



                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" onclick="editDiscount(' . $row->id . ')" class="edit btn btn-primary mr-2"><i class="ti-pencil-alt"></i></button>';
                    $btn .= '<button type="button" onclick="deleteDiscount(' . $row->id . ')" class="delete btn btn-danger "><i class="ti-trash"></i></button>';
                    return $btn;
                })


                ->rawColumns(['action', 'banner_image'])
                ->make(true);


        }

        return view('managedashboard.product.discount.index');



    }


    public function discounteditview(Request $request)
    {






        $discountData = Discount::join('product_discounts', 'product_discounts.discount_id', '=', 'discounts.id')
            ->join('vendor_products', 'vendor_products.id', '=', 'product_discounts.product_id')
            ->where('discounts.id', $request->discountid)
            ->select(
                'discounts.id as discount_id',
                'discounts.start_date as start_date',
                'discounts.end_date as end_date',
                'discounts.banner_image as banner_image',
                'discounts.discount_title as discount_title',
                'discounts.details as details',
                'discounts.discount_type as discount_type',
                'discounts.discount_data as discount_data',
                DB::raw('GROUP_CONCAT(vendor_products.id) as product_ids'),
                DB::raw('GROUP_CONCAT(vendor_products.product_title) as product_titles'),
                DB::raw('GROUP_CONCAT(vendor_products.product_banner_image) as product_banner_image')
            )
            ->groupBy(
                'discounts.id',
                'discounts.start_date',
                'discounts.end_date',
                'discounts.banner_image',
                'discounts.discount_title',
                'discounts.details',
                'discounts.discount_type',
                'discounts.discount_data'
            )

            ->get()
            ->map(function ($item) {

                return [
                    'discount_id' => $item->discount_id,
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date,
                    'banner_image' => $item->banner_image,
                    'discount_title' => $item->discount_title,
                    'details' => $item->details,
                    'discount_type' => $item->discount_type,
                    'discount_data' => json_decode($item->discount_data, true),
                    'products' => collect(explode(',', $item->product_ids))->map(function ($id, $index) use ($item) {
                        return [
                            'product_id' => $id,
                            'product_title' => explode(',', $item->product_titles)[$index],
                            'product_banner_image' => explode(',', $item->product_banner_image)[$index],
                        ];
                    })->all(),
                ];
            })
            ->toArray();


        if (empty($discountData)) {
            $discountData = Discount::where('id', $request->discountid)->get()->map(function ($item) {
                return [
                    'discount_id' => $item->id,
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date,
                    'banner_image' => $item->banner_image,
                    'discount_title' => $item->discount_title,
                    'details' => $item->details,
                    'discount_type' => $item->discount_type,
                    'discount_data' => json_decode($item->discount_data, true),
                ];
            });
        }


        $responseHtml = view::make('managedashboard.product.discount.edit', ['discountData' => $discountData])->render();

        return response()->json([
            'sucess' => true,
            'responsehtml' => $responseHtml
        ], 200);


    }



    public function productdiscountupdate(Request $request)
    {

        DB::beginTransaction();


        try {



            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'discount_title' => 'required',
                Rule::unique('discounts')->ignore($request->discount_id),

                'product_discount_detail' => 'required',
                'product' => 'required',
                "discount_type" => 'required',
                'bulk_discount.quantity' => 'required_if:discount_type,1|integer|min:1',
                'bulk_discount.amount' => 'required_if:discount_type,1|numeric|min:0',
                'combo_discount.amount' => 'required_if:discount_type,2|numeric|min:0',
                'bulk_discount.amount_type' => 'required_if:discount_type,1|in:0,1',
                'combo_discount.amount_type' => 'required_if:discount_type,2|in:0,1',

            ], [

                'start_date.required' => 'Discount Start Date is required',
                'end_date.required' => 'Discount End Date is required',
                'discount_title.required' => 'Discount title field required',
                'discount_title.unique' => 'Discount title should be unique',
                'bulk_discount.quantity.required_if' => 'Bulk product quantity is required for bulk discount.',
                'bulk_discount_amount.required_if' => 'Bulk discount amount is required for bulk discount.',
                'combo_discount.amount.required_if' => 'Combo discount amount is required for combo discount.',
                'bulk_discount.amount_type.required_if' => 'Bulk amount type is required for bulk discount.',
                'combo_discount.amount_type.required_if' => 'Combo amount type is required for combo discount.',
                'product_discount_details.required' => 'Product discount details are required.',

            ]);


            if ($validator->fails()) {
                return response()->json([
                    'sucess' => false,
                    'errormessage' => $validator->errors(),


                ], 422);


            }





            $newdiscount = Discount::find($request->discount_id);
            $newdiscount->discount_title = $request->discount_title;
            $newdiscount->start_date = $request->start_date;
            $newdiscount->end_date = $request->end_date;
            $newdiscount->discount_type = $request->discount_type;
            $newdiscount->discount_data = json_encode($request->bulk_discount ?? $request->combo_discount);

            $newdiscount->details = $request->product_discount_detail;

            if ($request->hasFile('discount_banner_image')) {
                $originName = $request->file('discount_banner_image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('discount_banner_image')->getClientOriginalExtension();
                $fileName = $fileName . '__' . time() . '.' . $extension;
                $request->file('discount_banner_image')->move(public_path('product/banner'), $fileName);

                $newdiscount->banner_image = $fileName;

            }



            $newdiscount->save();



            if ($newdiscount) {



                $productIds = $request->product;
                $currentProductDiscounts = ProductDiscount::where('discount_id', $request->discount_id)->get();
                $currentProductIds = $currentProductDiscounts->pluck('product_id')->toArray();



                $productsToAdd = array_diff($productIds, $currentProductIds);
                $productsToRemove = array_diff($currentProductIds, $productIds);



                // Insert new product discounts
                // dd($productsToAdd);
                // foreach ($productsToAdd as $productId) {
                //     ProductDiscount::updateOrCreate(
                //         ['discount_id' => $request->discount_id, 'product_id' => $productId],
                //         ['discount_id' => $request->discount_id, 'product_id' => $productId]
                //     );
                // }

                $insertData = [];
                foreach ($productsToAdd as $productId) {
                    $insertData[] = [
                        'discount_id' => $request->discount_id,
                        'product_id' => $productId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                if (!empty($insertData)) {
                    ProductDiscount::insert($insertData);
                }



                // Remove old product discounts
                ProductDiscount::where('discount_id', $request->discount_id)
                    ->whereIn('product_id', $productsToRemove)
                    ->delete();





                // ProductDiscount::where('discount_id', $request->discount_id)->delete();
                // $productDiscounts = [];
                // foreach ($request->product as $productId) {
                //     $productDiscounts[] = [
                //         'product_id' => $productId,
                //         'discount_id' => $newdiscount->id,
                //         'created_at' => now(),
                //         'updated_at' => now(),
                //     ];
                // }


                // ProductDiscount::insert($productDiscounts);
            }
            DB::commit();
            return response()->json(['message' => 'Discount updated and applied to products successfully'], 201);



        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update discount and apply to products', 'error' => $e->getMessage()], 500);
        }







    }


    public function deletediscount(Request $request)
    {

        DB::beginTransaction();
        try {



            $productDiscountDeatil = ProductDiscount::where('discount_id', $request->discount_id)->delete();
            $productDiscount = Discount::findOrFail($request->discount_id);

            $productDiscount->delete();


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'sucess' => false,
                'errormessage' => $e->getMessage(),
            ], 500);

        }



    }





}
