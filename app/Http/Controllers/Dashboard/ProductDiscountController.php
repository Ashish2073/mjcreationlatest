<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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


class ProductDiscountController extends Controller
{

    public function productdiscountview(Request $request)
    {
        $vendorProduct = VendorProduct::where('vendor_id', 1)->select('id', 'product_title')->get();
        return view('managedashboard.product.productdiscount', ['vendorProduct' => $vendorProduct]);

    }
}
