<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\Datatables;

class VendorController extends Controller
{
    public function vendordetails(Request $request)
    {


        if ($request->ajax()) {


            $vendors = Vendor::query()
                ->select('vendors.*', \DB::raw("DATE_FORMAT(vendors.created_at ,'%d/%m/%Y') AS created_date"))
                ->orderBy('vendors.created_at', 'desc');



            return Datatables::of($vendors)
                ->addIndexColumn()
                ->addColumn('vendor_profile_image', function ($row) {
                    if (isset($row->vendor_image)) {
                        $url = asset("vendor_image/{$row->vendor_image}");
                    } else {
                        $url = asset("vendor_image/vendor_vector.jpeg");
                    }


                    $vendorimg = "<img src={$url} width='30'  height='50' />";

                    return $vendorimg;
                })

                ->addColumn('status', function ($row) {

                    $status_text = $row->status == 1 ? 'Active' : 'Inactive';

                    $status_btn = $row->status == 1 ? 'btn btn-success' : 'btn btn-danger';

                    $vendor_status = "<button type='button' id='statuschange$row->id' onclick='changeStatus($row->id)' 
                    class='$status_btn ml-2'>$status_text</button>";

                    return $vendor_status;



                })






                ->rawColumns(['vendor_profile_image', 'status'])
                ->make(true);


        }
    }


    public function vendorlist()
    {
        return view('managedashboard.vendor.index');
    }


    public function statusupdate(Request $request)
    {

        $vendor = Vendor::find($request->vendor_id);
        $vendor->status = $request->status;

        $vendor->save();

        return response()->json([
            'id' => $vendor->id,
            'status' => $vendor->status,

        ], 200);


    }



}
