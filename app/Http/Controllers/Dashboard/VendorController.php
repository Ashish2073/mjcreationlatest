<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

                ->addColumn('url', function ($row) {
                    if (isset($row->vendor_image)) {
                        $url = asset("vendor_image/{$row->vendor_image}");
                    } else {
                        $url = asset("vendor_image/vendor_vector.jpeg");
                    }

                    return $url;

                })






                ->rawColumns(['vendor_profile_image', 'status', 'url'])
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


    public function editprofile()
    {

        return view('managedashboard.vendor.editprofile');

    }

    public function vendorupdateprofile(Request $request)
    {
        $vendor_id = Auth::guard('vendor')->user()->id;

        // Validate the input
        $validator = Validator::make($request->all(), [
            'email' => Rule::unique('vendors')->ignore($vendor_id),
            'phone_no' => [
                'nullable',
                Rule::unique('vendors')->ignore($vendor_id)
            ],
        ]);

        $validator->sometimes('password', 'string|min:8|confirmed', function ($input) {
            return !empty($input->password);
        });

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errormessage' => $validator->errors(),
            ], 422);
        }

        $vendorProfile = Vendor::find($vendor_id);

        // Update profile details
        $vendorProfile->name = $request->name;
        $vendorProfile->email = $request->email;

        if (isset($request->password)) {
            $vendorProfile->password = Hash::make($request->password);
        }

        // Check if phone number is set in the request
        if (isset($request->phone_no)) {
            $vendorProfile->phone_no = $request->phone_no;
        } else {
            $vendorProfile->phone_no = null; // Set to null if not provided
        }

        if ($request->hasFile('profile_image')) {
            $originName = $request->file('profile_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $fileName = $fileName . '__' . time() . '.' . $extension;
            $request->file('profile_image')->move(public_path('vendor_image'), $fileName);

            $vendorProfile->vendor_image = $fileName;
        }

        $vendorProfile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'vendor' => $vendorProfile,
        ]);
    }




}
