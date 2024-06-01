<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorCategoryCommision;
use App\Models\VendorOrderCommision;
use App\Models\VendorProductCommision;

class CommisionController extends Controller
{
    public function vendorcomission(Request $request)
    {
        return view('managedashboard.vendor.commision.index');


    }
}
