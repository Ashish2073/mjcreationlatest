<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Rules\StockMatchesStockColorWise;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Productcategory;
use App\Models\Productbrand;
use App\Models\VendorProduct;
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
use Illuminate\Support\Facades\Auth;

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
            <select onchange="selectSubproductcategory(this)" id="select' . $request->selectedtext . '" class="form-select product_category_main"
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
                'product_measurment_price_detail.*.stock' => ['required', 'numeric', new StockMatchesStockColorWise()],
                'product_specification.*.name' => 'required',
                'product_specification.*.heading' => 'required',

                'product_specification.*.detail' => 'required',




            ], [
                'product_measurment_price_detail.*.price' => 'Product price required',
                'product_measurment_price_detail.*.measurment_quantity' => 'Product measurment quantity required',
                'product_measurment_price_detail.*.currency' => 'Product currency type required',
                'product_measurment_price_detail.*.stock.required' => 'Product stock required',
                'product_specification.*.name' => 'Product specfication required',

                'product_specification.*.detail' => 'Product Specification detail required',

                'product_specification.*.heading' => 'Specification heading field is required',
            ]);

            $validator->after(function ($validator) use ($request) {
                $productColors = $request->input('product_color', []);
                $productColorBannerImages = $request->file('product_color_banner_image', []);

                if (count($productColors) !== count($productColorBannerImages)) {
                    $validator->errors()->add('product_color', 'The number of product colors must match the number of product color banner images.');
                }

                foreach ($productColorBannerImages as $index => $image) {
                    if (!isset($productColors[$index]) || empty($productColors[$index])) {
                        $validator->errors()->add('product_color.' . $index, 'Each product color banner image must have a corresponding product color Name.');
                    }
                }
            });


            if ($validator->fails()) {
                return response()->json([
                    'sucess' => false,
                    'errormessage' => $validator->errors(),


                ], 422);


            }







            $vendorProduct = new VendorProduct();
            $vendorProduct->vendor_id = Auth::guard('vendor')->user()->id;
            $vendorProduct->sku = strtoupper(substr($request->product_title, 0, 3) . '-' . ($request->product_category[count($request->product_category) - 1]) . '-' . $request->product_brand_id . '-' . $request->product_measurment_parameter . '-' . $request->product_measurment_unit . '-' . date('dmY') . '-' . date('His'));

            $vendorProduct->product_category_id = $request->product_category[count($request->product_category) - 1];
            $vendorProduct->product_title = $request->product_title;
            $vendorProduct->brand_id = ($request->product_brand_id);
            $vendorProduct->product_total_stock_quantity = $request->product_quantity;
            $vendorProduct->discription = $request->product_discription;
            $vendorProduct->product_warrenty = $request->product_warrenty;


            $vendorProduct->measurment_parameter_name = $request->product_measurment_parameter;

            $vendorProduct->measurment_unit_name = $request->product_measurment_unit;

            $vendorProduct->product_color = json_encode($request->product_color);



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



        $product_category = Productcategory::where('parent_id', 0)->get();

        $product_brands = Productbrand::select('name', 'id')->get();

        $product_specification_headings = Productspecficationheading::select('name', 'id')->get();

        $productmeasurmentname = ProductMeasurmentName::select('name', 'id')->get();

        $productmeasurmentunitname = ProductMeasurmentUnit::select('name', 'id')->get();


        return view('managedashboard.product.index', [
            'product_category' => $product_category,
            'product_specification_headings' => $product_specification_headings,
            'product_brands' => $product_brands,
            'productmeasurmentname' => $productmeasurmentname,
            'productmeasurmentunitname' => $productmeasurmentunitname
        ]);






    }
    public function productlistshow(Request $request)
    {

        if ($request->ajax()) {


            $vendorProducts = VendorProduct::query()
                ->join('product_categories', 'vendor_products.product_category_id', '=', 'product_categories.id')
                ->join('product_brands', 'vendor_products.brand_id', '=', 'product_brands.id')
                ->select('vendor_products.*', \DB::raw("DATE_FORMAT(vendor_products.created_at ,'%d/%m/%Y') AS created_date"), 'product_categories.name as product_categories_name', 'product_brands.name as brandname')
                ->orderBy('vendor_products.created_at', 'desc');



            return Datatables::of($vendorProducts)
                ->addIndexColumn()
                ->addColumn('product_image', function ($row) {
                    $url = asset("product/banner/{$row->product_banner_image}");

                    $productimg = "<img src={$url} width='30' id='openModalImageShow' height='50' onclick='showProductImage({$row->id})' />";

                    return $productimg;
                })



                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" onclick="editProduct(' . $row->id . ',' . $row->product_category_id . ')" class="edit btn btn-primary mr-2"><i class="ti-pencil-alt"></i></button>';
                    $btn .= '<button type="button" onclick="deleteProduct(' . $row->id . ')" class="delete btn btn-danger "><i class="ti-trash"></i></button>';
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



    public function productimage(Request $request)
    {
        $ProductImage = VendorProduct::where('id', $request->ProductId)->select('product_image_gallery')->first();

        $imageGallery = json_decode($ProductImage->product_image_gallery, true);


        $responsehtml = view::make('managedashboard.product.productimageshow', ['imageGallery' => $imageGallery])->render();


        return response()->json([
            'sucess' => true,
            'responsehtml' => $responsehtml
        ], 200);



    }



    public function editproduct(Request $request)
    {


        $product_category = Productcategory::where('parent_id', 0)->get();

        $product_sub_category_by_id = Productcategory::where('id', $request->ProductCategoryId)->select('parent_id', 'name', 'id')->first();

        $product_sub_category = Productcategory::where('parent_id', $product_sub_category_by_id->parent_id)->get();



        $product_brands = Productbrand::all();

        $product_specification_heading_edit = Productspecficationheading::select('name', 'id')->get();


        $productmeasurmentname = ProductMeasurmentName::select('name', 'id')->get();

        $productmeasurmentunitname = ProductMeasurmentUnit::select('name', 'id')->get();


        $productpricedetails = ProductPriceDetail::where('product_id', $request->ProductId)->get();





        $vendorProducts = VendorProduct::join('product_categories', 'vendor_products.product_category_id', '=', 'product_categories.id')
            ->join('productbrands', 'vendor_products.brand_id', '=', 'productbrands.id')
            ->select(
                'vendor_products.*',
                'product_categories.name as product_categories_name',
                'productbrands.name as brandname',
                'productbrands.id as brandsid'
            )
            ->where('vendor_products.id', $request->ProductId)
            ->get();


        $responsehtml = view::make('managedashboard.product.edit', [
            'product_sub_category_by_id' => $product_sub_category_by_id,
            'product_specification_heading_edit' => $product_specification_heading_edit,
            'product_category' => $product_category,
            'product_brands' => $product_brands,
            'vendorProducts' => $vendorProducts,
            'product_sub_category' => $product_sub_category,
            'productmeasurmentname' => $productmeasurmentname,
            'productmeasurmentunitname' => $productmeasurmentunitname,
            'productpricedetails' => $productpricedetails,

        ])->render();


        return response()->json([
            'sucess' => true,
            'responsehtml' => $responsehtml
        ], 200);







    }


    public function productmeasurmentsave(Request $request)
    {

        Validator::extend('unique_measurement_parameter', function ($attribute, $value, $parameters, $validator) {
            $parameterCount = ProductMeasurmentName::where('name', $value)->count();
            return $parameterCount === 0;
        });



        // Define custom error messages
        $messages = [
            'unique_measurement_parameter' => 'Parameter Name Already Exists',
        ];
        $validator = Validator::make($request->all(), [
            'measurment_parameter_name' => [
                'required',
                'unique_measurement_parameter'
            ]





        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),
            ], 422);


        }






        $parameter = ProductMeasurmentName::updateOrCreate(
            ['name' => $request->measurment_parameter_name], // Search criteria

        );


        if ($parameter) {
            return response()->json([
                'sucess' => true,
                'parameter' => $parameter,
            ], 200);

        }


    }


    public function productmeasurmentunitsave(Request $request)
    {

        Validator::extend('unique_measurement_parameter_unit', function ($attribute, $value, $parameters, $validator) {
            $parameterCount = ProductMeasurmentUnit::where('name', $value)->count();
            return $parameterCount === 0;
        });

        $messages = [
            'unique_measurement_parameter_unit' => 'Unit Name Already Exists',
        ];

        $validator = Validator::make($request->all(), [
            'measurment_parameter_unit_name' => ['required', 'string', 'unique_measurement_parameter_unit'],



        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),
            ], 422);


        }


        $parameter = ProductMeasurmentUnit::updateOrCreate(
            ['name' => $request->measurment_parameter_unit_name], // Search criteria

        );


        if ($parameter) {
            return response()->json([
                'sucess' => true,
                'parameter' => $parameter,
            ], 200);

        }

    }


    public function productaddspecificationheading(Request $request)
    {

        Validator::extend('unique_product_specification_heading', function ($attribute, $value, $parameters, $validator) {
            $parameterCount = Productspecficationheading::where('name', $value)->count();
            return $parameterCount === 0;
        });

        $messages = [
            'unique_product_specification_heading' => 'Heading Name Already Exists',
        ];

        $validator = Validator::make($request->all(), [
            'product_specification_heading_name' => ['required', 'string', 'unique_product_specification_heading'],



        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'errormessage' => $validator->errors(),
            ], 422);


        }

        $parameter = Productspecficationheading::updateOrCreate(
            ['name' => $request->product_specification_heading_name], // Search criteria

        );


        if ($parameter) {
            return response()->json([
                'sucess' => true,
                'parameter' => $parameter,
            ], 200);

        }


    }


    public function updateproduct(Request $request)
    {



        DB::beginTransaction();






        try {










            $validator = Validator::make($request->all(), [
                'product_category' => 'required',
                'product_title' => 'required',
                Rule::unique('vendor_products')->ignore($request->product_id),
                'product_brand_id' => 'required',
                'product_quantity' => 'required',
                'product_discription' => 'required',
                'product_measurment_parameter' => 'required',
                'product_measurment_unit' => 'required',
                'product_measurment_price_detail.*.price' => 'required',
                'product_measurment_price_detail.*.measurment_quantity' => 'required',
                'product_measurment_price_detail.*.currency' => 'required',
                'product_measurment_price_detail.*.stock' => ['required', 'numeric', new StockMatchesStockColorWise()],
                'product_specification.*.name' => 'required',
                'product_specification.*.heading' => 'required',

                'product_specification.*.detail' => 'required',




            ], [
                'product_measurment_price_detail.*.price' => 'Product price required',
                'product_measurment_price_detail.*.measurment_quantity' => 'Product measurment quantity required',
                'product_measurment_price_detail.*.currency' => 'Product currency type required',
                'product_measurment_price_detail.*.stock.required' => 'Product stock required',
                'product_specification.*.name' => 'Product Specification required',
                'product_specification.*.detail' => 'Product Specification detail required',
                'product_specification.*.heading' => 'Specification heading field is required',
            ]);




            if (isset($request->product_color_banner_image_existing) && ($request->file('product_color_banner_image') == false)) {
                $validator->after(function ($validator) use ($request) {
                    $productColors = $request->input('product_color', []);
                    $productColorBannerImages = $request->input('product_color_banner_image_existing', []);



                    // if (count($productColors) !== count($productColorBannerImages)) {
                    //     $validator->errors()->add('product_color', 'The number of product colors must match the number of product color banner images.');
                    // }

                    foreach ($productColorBannerImages as $index => $image) {
                        if (!isset($productColors[$index]) || empty($productColors[$index])) {
                            $validator->errors()->add('product_color.' . $index, 'Each product color banner image must have a corresponding product color Name.');
                        }
                    }
                });

            }



            if ($request->file('product_color_banner_image') && !isset($request->product_color_banner_image_existing)) {
                $validator->after(function ($validator) use ($request) {
                    $productColorNew = $request->input('product_color', []);
                    $productColorNewBannerImages = $request->file('product_color_banner_image', []);





                    foreach ($productColorNewBannerImages as $index => $image) {
                        if (!isset($productColorNew[$index]) || empty($productColorNew[$index])) {
                            $validator->errors()->add('product_color.' . $index, 'Each product color banner image must have a corresponding product color Name.');
                        }
                    }

                });
            }


            if ($request->file('product_color_banner_image') && isset($request->product_color_banner_image_existing)) {


                $validator->after(function ($validator) use ($request) {
                    $productColorBannerImageLength = count($request->file('product_color_banner_image'));
                    $productExistingBannerImageLength = count($request->product_color_banner_image_existing);
                    $productColorNew = $request->input('product_color', []);

                    $sum = $productColorBannerImageLength + $productExistingBannerImageLength;









                    for ($i = 0; $i < $sum; $i++) {
                        if (!isset($productColorNew[$i]) || empty($productColorNew[$i])) {

                            $validator->errors()->add('product_color.' . $i, 'Each product color banner image must have a corresponding product color Name.');
                        }

                    }

                });



            }





            if ($validator->fails()) {
                return response()->json([
                    'sucess' => false,
                    'errormessage' => $validator->errors(),


                ], 422);


            }







            $vendorProduct = VendorProduct::find($request->product_id);
            $vendorProduct->vendor_id = Auth::guard('vendor')->user()->id;

            $vendorProduct->product_category_id = $request->product_category[count($request->product_category) - 1];
            $vendorProduct->product_title = $request->product_title;
            $vendorProduct->brand_id = $request->product_brand_id;
            $vendorProduct->product_total_stock_quantity = $request->product_quantity;
            $vendorProduct->discription = $request->product_discription;
            $vendorProduct->product_warrenty = $request->product_warrenty;
            $vendorProduct->product_color = json_encode($request->product_color);


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

            } else {
                if (isset($request->product_banner_image_existing)) {
                    $vendorProduct->product_banner_image = $request->product_banner_image_existing[0];

                }

            }






            if ($request->hasFile('product_image_gallery') || isset($request->product_image_gallery_existing)) {

                $product_image_file_name = [];

                if (isset($request->product_image_gallery_existing)) {
                    $productImageGalleryExisting = $request->product_image_gallery_existing;
                    $productImageGalleryExistingLength = count($request->product_image_gallery_existing);
                    for ($k = 0; $k < $productImageGalleryExistingLength; $k++) {

                        if (!isset($request->product_image_gallery[$k])) {
                            array_push($product_image_file_name, $productImageGalleryExisting[$k]);
                        }


                    }
                }



                if (($request->hasFile('product_image_gallery'))) {
                    foreach ($request->file('product_image_gallery') as $image) {
                        $originName = $image->getClientOriginalName();
                        $fileName = pathinfo($originName, PATHINFO_FILENAME);
                        $extension = $image->getClientOriginalExtension();

                        $fileName = $fileName . '__' . time() . '.' . $extension;


                        $image->move(public_path('product/gallery'), $fileName);

                        array_push($product_image_file_name, $fileName);

                    }
                }

                $vendorProduct->product_image_gallery = json_encode($product_image_file_name);

            }








            if ($request->hasFile('product_color_banner_image') || isset($request->product_color_banner_image_existing)) {

                $product_color_banner_image_file_name = [];



                if (isset($request->product_color_banner_image_existing)) {

                    $product_color_banner_image_existing_length = count($request->product_color_banner_image_existing);

                    for ($w = 0; $w < $product_color_banner_image_existing_length; $w++) {


                        if (isset($request->product_color_banner_image_existing[$w])) {

                            $product_color_banner_image_file_name[$w] = $request->product_color_banner_image_existing[$w];
                        }

                    }

                    ksort($product_color_banner_image_file_name);

                    $product_color_banner_image_file_name = array_values($product_color_banner_image_file_name);





                }





                // dd($request->hasFile('product_color_banner_image'), $product_color_banner_image_file_name);
                if (($request->hasFile('product_color_banner_image'))) {



                    foreach ($request->file('product_color_banner_image') as $m => $image) {

                        $originName = $image->getClientOriginalName();
                        $fileName = pathinfo($originName, PATHINFO_FILENAME);
                        $extension = $image->getClientOriginalExtension();

                        $fileName = $fileName . '__' . time() . '.' . $extension;


                        $image->move(public_path('product/gallery'), $fileName);



                        if (isset($product_color_banner_image_file_name)) {



                            array_push($product_color_banner_image_file_name, $fileName);





                        } else {
                            $product_color_banner_image_file_name[$m] = $fileName;
                        }



                    }

                }






                $vendorProduct->product_color_banner_image = json_encode($product_color_banner_image_file_name);





            }









            if (isset($request->product_color_image_gallery_edit) && isset($request->product_color_image_gallery_existing)) {




                $product_color_image_gallery_file_name = [];

                $product_color_image_gallery_file_name_existing = [];





                if (isset($request->product_color_image_gallery_existing)) {
                    $productcolorimagegalleryexisting = $request->product_color_image_gallery_existing;

                    $productcolorimagegalleryexistingLength = count($request->product_color_image_gallery_existing);

                    for ($l = 0; $l < $productcolorimagegalleryexistingLength; $l++) {


                        if (isset($productcolorimagegalleryexisting[$l])) {
                            $subproductcolorimagegalleryexisting = count($productcolorimagegalleryexisting[$l]);
                            for ($n = 0; $n < $subproductcolorimagegalleryexisting; $n++) {
                                if (isset($productcolorimagegalleryexisting[$l][$n])) {

                                    $product_color_image_gallery_file_name_existing[$l][$n] = $productcolorimagegalleryexisting[$l][$n];

                                }
                            }

                            ksort($product_color_image_gallery_file_name_existing[$l]);

                            $product_color_image_gallery_file_name_existing[$l] = array_values($product_color_image_gallery_file_name_existing[$l]);


                        }

                    }


                }



                if (isset($request->product_color_image_gallery_edit)) {

                    $product_color_image_gallery_new_element = $request->product_color_image_gallery_edit;



                    foreach ($product_color_image_gallery_new_element as $k => $images) {



                        foreach ($images as $l => $img) {

                            $originName = $img->getClientOriginalName();
                            $fileName = pathinfo($originName, PATHINFO_FILENAME);
                            $extension = $img->getClientOriginalExtension();

                            $fileName = $fileName . '__' . time() . '.' . $extension;


                            $img->move(public_path('product/gallery'), $fileName);

                            $product_color_image_gallery_file_name[$k][$l] = $fileName;


                        }

                    }

                }


                $combinedArray = [];

                foreach ($product_color_image_gallery_file_name as $index => $subArray) {
                    // Check if the index exists in array2
                    if (isset($product_color_image_gallery_file_name_existing[$index])) {
                        // Merge elements from both arrays
                        $combinedArray[$index] = array_merge($subArray, $product_color_image_gallery_file_name_existing[$index]);
                    } else {
                        // If index doesn't exist in array2, simply add elements from array1
                        $combinedArray[$index] = $subArray;
                    }
                }

                // Append remaining elements from array2
                foreach ($product_color_image_gallery_file_name_existing as $index => $subArray) {
                    // Check if index already exists in combinedArray
                    if (!isset($combinedArray[$index])) {
                        $combinedArray[$index] = $subArray;
                    }
                }

                // Output the combined array
                ksort($combinedArray);

                // Re-index the array starting from 0
                $combinedArray = array_values($combinedArray);



                // dd($product_color_image_gallery_file_name_existing, $product_color_image_gallery_file_name, ($combinedArray));

                $vendorProduct->product_color_image_gallery = json_encode($combinedArray);


            }



            if (isset($request->product_color_image_gallery_existing) && !isset($request->product_color_image_gallery_edit)) {
                // $product_color_image_gallery_file_name = [];



                // $product_color_image_gallery_file_name_existing = [];


                // if (isset($request->product_color_image_gallery_existing)) {
                //     $productcolorimagegalleryexisting = $request->product_color_image_gallery_existing;

                //     $productcolorimagegalleryexistingLength = count($request->product_color_image_gallery_existing);

                //     for ($l = 0; $l < $productcolorimagegalleryexistingLength; $l++) {
                //         $product_color_image_gallery_file_name_existing[$l] = $productcolorimagegalleryexisting[$l];

                //     }


                // }



                $vendorProduct->product_color_image_gallery = json_encode($request->product_color_image_gallery_existing);



            }




            if (isset($request->product_color_image_gallery_edit) && !isset($request->product_color_image_gallery_existing)) {
                $product_color_image_gallery_new_element = array_values($request->product_color_image_gallery_edit);

                $product_color_image_gallery_file_name = [];

                foreach ($product_color_image_gallery_new_element as $k => $images) {



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


                ProductPriceDetail::where('product_id', $request->product_id)->delete();

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


    public function deleteproduct(Request $request)
    {
        DB::beginTransaction();
        try {



            $productPriceDeatil = ProductPriceDetail::where('product_id', $request->ProductId)->delete();
            $product = VendorProduct::findOrFail($request->ProductId);

            $product->delete();


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
