{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

@extends('managedashboard.layout.main')
@section('title', 'Vendor Commision')
@include('managedashboard.layout.loader')
@section('content')

    <style>
        .form-sec {
            width: 100%;
            max-width: 100%;
        }
    </style>

    <section class="form-sec mt-5 justify-content-center p-3 mb-2">

        <!-- First Card Row -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <div id="vendorBox" class=" row border p-3 mb-3">
                            <h5>Vendor Details</h5>
                            <p id="vendorInfo">Click on a table row to see details</p>

                        </div>
                        <table class="table table-bordered vendor_data">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Vendor Name</th>
                                    <th>Vendor Email </th>
                                    <th>Vendor Image</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Card Row -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5>Commission on Per Order</h5>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" placeholder="Enter amount">
                        </div>
                        <div class="form-group">
                            <label for="type">Select Type</label>
                            <select class="form-control" id="type">
                                <option value="flat">Flat</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" onclick="saveData()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Card Row -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <div id="productBox" class="border p-3 mb-3">
                            <h5>Selected Product</h5>
                            <p id="productInfo">Choose a product</p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <h5>Commission on Vendor Product</h5>
                        <div class="form-group">
                            <label for="productAmount">Amount</label>
                            <input type="number" class="form-control" id="productAmount" placeholder="Enter amount">
                        </div>
                        <div class="form-group">
                            <label for="productType">Select Type</label>
                            <select class="form-control" id="productType">
                                <option value="flat">Flat</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" onclick="saveProductData()">Save</button>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection

@section('page-script')

    <script>
        dataTable();


        function dataTable() {




            var table = $('.vendor_data').DataTable({

                // Add this line to enable buttons

                stateSave: true,
                "bDestroy": true,
                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('vendor.detail') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",

                    }
                },
                success: (data) => {

                    console.log(data);


                },
                columns: [{
                        data: 'DT_RowIndex', // Serial number column
                        name: 'serial_number',
                        orderable: false,
                        searchable: false,

                    },


                    {
                        data: 'name',
                        name: 'name',
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true
                    },
                    {

                        data: 'vendor_profile_image',
                        name: 'vendor_profile_image',
                        orderable: false,
                        searchable: false,

                    },

                ],
                language: {
                    // Customization for the "Entries per page" text
                    lengthMenu: "Show _MENU_ Entries per Page"
                },
                rowCallback: function(row, data) {
                    // Apply click event to the row
                    $(row).on('click', function() {
                        // Show product name and its ID on console choosedProductId
                        console.log('Product Name:', data.name);
                        console.log('Product ID:', data.id);


                        choosenProduct = `<div class="col-lg-2 mb-3 d-flex align-items-stretch" id="productnewelement${data.id}">
                                            <div class="card position-relative">

                                                <img src="${data.vendor_image}"
                                                    class="card-img-top" alt="Card Image">
                                            
                  
                                             
                                                   
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">${data.name}</h5>
                                                    <button type="button" onclick="removeChossenProductElemet('productnewelement${data.id}',${data.id})" class="delete btn btn-danger "><i
                                                            class="ti-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>`;






                        $('#vendorBox').append(choosenProduct);






                    });
                }


            });



        };
    </script>


@endsection
