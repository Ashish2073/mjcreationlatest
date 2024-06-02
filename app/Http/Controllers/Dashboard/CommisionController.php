<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorCategoryCommision;
use App\Models\VendorOrderCommision;
use App\Models\VendorProductCommision;
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
}
