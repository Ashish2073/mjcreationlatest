<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Productcategory;
use App\Models\Productbrand;
use App\Models\VendorProduct;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VendorProductImport;
use App\Models\Productspecficationheading;
use App\Imports\ProductSpecificationImport;
use App\Imports\ProductPrimaryCostImport;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use App\Models\ProductPriceDetail;

class ProductController extends Controller
{
    public function vendorproductview()
    {
        $product_category = Productcategory::where('parent_id', 0)->get();

        $product_brands = Productbrand::select('name', 'id')->get();

        $product_specification_headings = Productspecficationheading::select('name', 'id')->get();


        return view('managedashboard.product.add', ['product_category' => $product_category, 'product_specification_headings' => $product_specification_headings, 'product_brands' => $product_brands]);
    }


    public function handleChange(Request $request)
    {


        $product_category = Productcategory::where('parent_id', $request->selectedvalue)->get();





        if (json_decode($product_category) != []) {
            $optionHtml = "<option selected disabled>Open this select menu</option>";
        } else {
            $optionHtml = "<option selected disabled>No Record Found</option>";
        }


        foreach ($product_category as $data) {

            $optionHtml = $optionHtml . "<option value='" . $data->id . "'>" . ucwords($data->name) . "</option>";
        }




        $htmlResponse = '<div class="col-md-4" id="' . $request->selectedtext . '">
            <label for="" class="form-label"> ' . $request->selectedtext . ' ' . 'Category</label>
            <select onchange="selectSubproductcategory(this)" id="select' . $request->selectedtext . '" class="form-select"
                name="product_category[]" aria-label="Default select example">'

            . $optionHtml .
            '</select>
    
                </div>';

        return response()->json([
            'sucess' => true,
            'id' => "select$request->selectedtext",
            'responsehtml' => $htmlResponse
        ], 200);


    }


    public function saveproduct(Request $request)
    {



        DB::beginTransaction();

        try {





            $validator = Validator::make($request->all(), [
                'product_category' => 'required',
                'product_title' => 'required|unique:vendor_products',
                'product_brand_id' => 'required',
                'product_quantity' => 'required',
                'product_discription' => 'required',
                'product_measurment_parameter' => 'required',
                'product_measurment_unit' => 'required',
                'product_measurment_price_detail.*.price' => 'required',
                'product_measurment_price_detail.*.measurment_quantity' => 'required',
                'product_measurment_price_detail.*.currency' => 'required',
                'product_measurment_price_detail.*.stock' => 'required',
                'product_specification.*.name' => 'required',
                'product_specification.*.heading' => 'required',

                'product_specification.*.detail' => 'required',




            ], [
                'product_measurment_price_detail.*.price' => 'Product price required',
                'product_measurment_price_detail.*.measurment_quantity' => 'Product measurment quantity required',
                'product_measurment_price_detail.*.currency' => 'Product currency type required',
                'product_measurment_price_detail.*.stock' => 'Product stock required',
                'product_specification.*.name' => 'Product specfication required',

                'product_specification.*.detail' => 'Product Specification detail required',

                'product_specification.*.heading' => 'Specification heading field is required',
            ]);



            if ($validator->fails()) {
                return response()->json([
                    'sucess' => false,
                    'errormessage' => $validator->errors(),


                ], 422);


            }







            $vendorProduct = new VendorProduct();
            $vendorProduct->vendor_id = 1;

            $vendorProduct->product_category_id = $request->product_category[count($request->product_category) - 1];
            $vendorProduct->product_title = $request->product_title;
            $vendorProduct->brand_id = ($request->product_brand_id);
            $vendorProduct->product_total_stock_quantity = $request->product_quantity;
            $vendorProduct->discription = $request->product_discription;
            $vendorProduct->product_warrenty = $request->product_warrenty;


            $vendorProduct->measurment_parameter_name = $request->product_measurment_parameter;

            $vendorProduct->measurment_unit_name = $request->product_measurment_unit;



            // product_color_stock $vendorProduct->product_other_expenditure_cost=json_encode($request->product_other_price) ?? Null;

            // $vendorProduct->product_other_expenditure_resaon=json_encode($request->product_other_expenditure_resaon)??Null;

            // $vendorProduct->product_other_expenditure_currency_type=json_encode($request->product_other_expenditure_currency_type)??Null;
            $product_specification_modified_data = [];
            foreach ($request->product_specification as $data) {
                $product_specification_modified_data['heading'][] = $data['heading'];
                $product_specification_modified_data['name'][] = $data['name'];
                $product_specification_modified_data['detail'][] = $data['detail'];
            }



            $vendorProduct->product_specification_heading = isset($product_specification_modified_data['heading']) ? json_encode($product_specification_modified_data['heading']) : Null;
            $vendorProduct->product_specification = json_encode($product_specification_modified_data['name']) ?? Null;

            $vendorProduct->product_specification_details = json_encode($product_specification_modified_data['detail']) ?? Null;

            // $vendorProduct->product_discount_name=json_encode($request->product_discount_name) ?? Null;

            // $vendorProduct->product_discount_percentage=json_encode($request->product_discount_percentage)?? Null;

            // $vendorProduct->product_discount_start_date= json_encode($request->product_discount_start_date)?? Null;

            // $vendorProduct->product_discount_end_date=json_encode($request->product_discount_end_date) ?? Null;

            // $vendorProduct->product_discount_detail=json_encode($request->product_discount_detail) ?? Null;


            if ($request->hasFile('product_banner_image')) {
                $originName = $request->file('product_banner_image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('product_banner_image')->getClientOriginalExtension();
                $fileName = $fileName . '__' . time() . '.' . $extension;
                $request->file('product_banner_image')->move(public_path('product/banner'), $fileName);

                $vendorProduct->product_banner_image = $fileName;

            }

            if ($request->hasFile('product_image_gallery')) {

                $product_image_file_name = [];
                foreach ($request->file('product_image_gallery') as $image) {
                    $originName = $image->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();

                    $fileName = $fileName . '__' . time() . '.' . $extension;


                    $image->move(public_path('product/gallery'), $fileName);

                    array_push($product_image_file_name, $fileName);

                }


                $vendorProduct->product_image_gallery = json_encode($product_image_file_name);





            }

            if ($request->hasFile('product_color_banner_image')) {

                $product_color_banner_image_file_name = [];
                foreach ($request->file('product_color_banner_image') as $image) {

                    $originName = $image->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();

                    $fileName = $fileName . '__' . time() . '.' . $extension;


                    $image->move(public_path('product/gallery'), $fileName);

                    array_push($product_color_banner_image_file_name, $fileName);

                }


                $vendorProduct->product_color_banner_image = json_encode($product_color_banner_image_file_name);





            }


            if (isset($request->product_color_image_gallery)) {
                $product_color_image_gallery_file_name = [];
                foreach ($request->product_color_image_gallery as $k => $images) {



                    foreach ($images as $l => $img) {

                        $originName = $img->getClientOriginalName();
                        $fileName = pathinfo($originName, PATHINFO_FILENAME);
                        $extension = $img->getClientOriginalExtension();

                        $fileName = $fileName . '__' . time() . '.' . $extension;


                        $img->move(public_path('product/gallery'), $fileName);

                        $product_color_image_gallery_file_name[$k][$l] = $fileName;


                    }

                }
                $vendorProduct->product_color_image_gallery = json_encode($product_color_image_gallery_file_name);
            }

            $vendorProduct->save();

            if ($vendorProduct) {


                $productMeasurmentPriceDeatildata = $request->product_measurment_price_detail;
                foreach ($productMeasurmentPriceDeatildata as &$item) {
                    $item['color'] = json_encode($item['color']);
                    $item['stock_color_wise'] = json_encode($item['stock_color_wise']);
                    $item['product_id'] = $vendorProduct->id;
                }


                ProductPriceDetail::insert($productMeasurmentPriceDeatildata);


            }




            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'sucess' => false,
                'errormessage' => $e->getMessage(),
            ], 500);
        }



    }

    public function textareaimageupload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '__' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('textarea'), $fileName);
            $url = asset('textarea/' . $fileName);
            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => $url,
            ]);

        }
    }


    public function bulkimport(Request $request)
    {
        return view('managedashboard.product.bulkimport');

    }

    public function importproductdata(Request $request)
    {

        $request->validate([
            'import_product_file' => 'required|max:2048',
        ]);

        $productImport = new VendorProductImport();
        Excel::import($productImport, $request->file('import_product_file'));

        // dd($productImport->response);  

        return response()->json($productImport->response);
    }

    public function importproductspecificationdata(Request $request)
    {
        $request->validate([
            'import_product_specification_file' => 'required|max:2048',
        ]);

        $productImport = new ProductSpecificationImport();
        Excel::import($productImport, $request->file('import_product_specification_file'));

        // dd($productImport->response);  

        return response()->json($productImport->response);

    }


    public function importproductprimarycostdata(Request $request)
    {
        $request->validate([
            'import_product_primary_cost_data_file' => 'required|max:2048',
        ]);

        $productImport = new ProductPrimaryCostImport();
        Excel::import($productImport, $request->file('import_product_primary_cost_data_file'));

        // dd($productImport->response);  

        return response()->json($productImport->response);

    }


    function productlistview(Request $request)
    {
        return view('managedashboard.product.index');

    }
    public function productlistshow(Request $request)
    {

        if ($request->ajax()) {


            $vendorProducts = VendorProduct::query()
                ->join('product_categories', 'vendor_products.product_category_id', '=', 'product_categories.id')
                ->join('productbrands', 'vendor_products.brand_id', '=', 'productbrands.id')
                ->select('vendor_products.*', 'product_categories.name as product_categories_name', 'productbrands.name as brandname')
                ->orderBy('vendor_products.created_at', 'desc');



            return Datatables::of($vendorProducts)
                ->addIndexColumn()
                ->addColumn('product_image', function ($row) {
                    $url = asset("product/banner/{$row->product_banner_image}");

                    $productimg = "<img src={$url} width='30' height='50' />";

                    return $productimg;
                })
                // ->addColumn('product_title',function ($row) {
                //     return $row->product_title;
                // })->addIndexColumn()


                // ->addColumn('product_total_stock_quantity',function ($row) {
                //     return $row->product_total_stock_quantity;
                // })->addIndexColumn()

                // ->addColumn('product_categories_name',function ($row){
                //     return $row->product_categories_name;

                // })->addIndexColumn()

                // ->addColumn('brandname',function ($row){
                //     return $row->bandname;

                // })->addIndexColumn()

                // ->addColumn('created_at',function ($row){
                //     return $row->created_at;

                // })->addIndexColumn()


                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" href="edit/' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $btn;
                })


                ->rawColumns(['action', 'product_image'])
                ->make(true);


        }

    }

    public function addbrandname(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'brandName' => 'required|string|',
            'brandImage' => 'required|image|mimes:jpeg,jpg,png|max:2048',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),
            ], 422);


        }


        if ($request->hasFile('brandImage')) {
            $originName = $request->file('brandImage')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('brandImage')->getClientOriginalExtension();
            $fileName = $fileName . '__' . time() . '.' . $extension;
            $request->file('brandImage')->move(public_path('product/brand'), $fileName);



        }




        $brand = Productbrand::updateOrCreate(
            ['name' => $request->brandName], // Search criteria
            ['brand_image_name' => $fileName] // Fields to update or create
        );


        if ($brand) {
            return response()->json([
                'sucess' => true,
                'brand' => $brand,
            ], 200);

        }







    }







}
