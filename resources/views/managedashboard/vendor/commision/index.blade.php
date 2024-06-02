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


    <section style="width: 80%">

        <div id="commisionaddform" hidden class="form-sec mt-5 justify-content-center p-3 mb-2">
            @include('managedashboard.vendor.commision.add')
        </div>


        <div class="container mt-5 table-responsive col-12" id="commisionmaintable">



            <div class="content-header-right text-md-right col-md-3 col-12">
                <div class="form-group">

                    <button onclick="showAddForm()" class="btn-icon btn btn-primary btn-round btn-sm">
                        <i class="ti-plus"></i>
                    </button>




                </div>
            </div>










            <div class="p-3 row shadow" style="background: #ffced785;">
                <div class="col-md-12">

                    <h3 style="font-family:serif">Category Wise Commision </h3>
                    <table class="discount-list-data-table table table-striped category-commision"
                        style="width:100%;    margin-left: -17px;">
                        <thead>
                            <tr>

                                <th>Sr No.</th>
                                <th>Vendor Name </th>
                                <th>Vendor Profile Image</th>
                                <th>Category Name</th>
                                <th>Amount </th>
                                <th>Type </th>
                                <th>Commision Priority</th>

                                <th>Created Date </th>
                                <th>Updated Date </th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>


            </div>

            <div class="p-3 row shadow mt-5" style="background: #ffced785;">
                <div class="col-md-12">

                    <h3 style="font-family:serif">Product Wise Commision </h3>
                    <table class="discount-list-data-table table table-striped product-commision" style="width:100%;  ">
                        <thead>
                            <tr>

                                <th>Sr No.</th>
                                <th>Vendor Name </th>
                                <th>Vendor Profile Image</th>
                                <th>Product Name</th>
                                <th>Product Image </th>
                                <th>Amount </th>
                                <th>Type </th>
                                <th>Commision Priority</th>

                                <th>Created Date </th>
                                <th>Updated Date </th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>


            </div>


            {{-- <table class="discount-list-data-table table table-striped" style="width:100%">
                <thead>
                    <tr>

                        <th>Sr No.</th>
                        <th>Discount Title </th>
                        <th>Discount Baneer Image</th>
                        <th>Start Date</th>

                        <th>End Date </th>

                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> --}}


            {{-- <table class="discount-list-data-table table table-striped" style="width:100%">
                <thead>
                    <tr>

                        <th>Sr No.</th>
                        <th>Discount Title </th>
                        <th>Discount Baneer Image</th>
                        <th>Start Date</th>

                        <th>End Date </th>

                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> --}}



        </div>
    </section>

@endsection

@section('page-script')

    <script>
        dataTable();

        vendorCategoryCommision();

        vendorCommisionProductList();



        $(".productcommisiontype").select2({
            placeholder: "Select a product commission",
            allowClear: true
        });

        $(".productcommisiontype").select2({
                placeholder: "Select a product commission type",
                allowClear: true
            }

        )

        $(".vendorcategories").select2({
                placeholder: "Select a product commission type",
                allowClear: true
            }

        )

        function showAddForm() {
            $("#commisionaddform").removeAttr('hidden');
            $("#commisionmaintable").attr('hidden', 'true');
        }

        function hideAddForm() {
            $("#commisionaddform").attr('hidden', 'true');
            $("#commisionmaintable").removeAttr('hidden');

        }

        var choosedVendorProductId = [];
        var choosrdVendorId = "";


        function removeChossenProductElemet(id, productid) {
            console.log(id);
            console.log(productid);
            let index = choosedVendorProductId.indexOf(productid);

            if (index !== -1) {
                choosedVendorProductId.splice(index, 1);
            }
            $(`#${id}`).remove();

        }

        function removeChossenvendorElemet(id, vendor_id) {


            choosrdVendorId = "";
            $(`#${id}`).remove();

        }


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
                        // Show product name and its ID on console choosedVendorProductId
                        console.log('Product Name:', data.name);
                        console.log('Product ID:', data.id);

                        choosrdVendorId = data.id;





                        choosenProduct = ` <h5>Vendor Details</h5>
                        <div class="col-lg-2 mb-3 d-flex align-items-stretch" id="productnewelement${data.id}">
                                            <div class="card position-relative">

                                                <img src="${data.url}"
                                                    class="card-img-top" alt="Card Image">
                                            
                  
                                             
                                                   
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">${data.name}</h5>
                                                    <button type="button" onclick="removeChossenvendorElemet('productnewelement${data.id}',${data.id})" class="delete btn btn-danger "><i
                                                            class="ti-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>`;

                        $('#productBox').html("");

                        vendorProductTable(data.id);

                        vendorCategory(data.id);



                        $('#vendorBox').html(choosenProduct);









                    });
                }


            });



        };




        function vendorProductTable(id) {



            console.log(id);

            var vendor_id = id;
            var table = $('.vendor-product-table').DataTable({



                stateSave: true,
                "bDestroy": true,
                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('product.list') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        vendor_id: vendor_id

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
                        data: 'product_title',
                        name: 'product_title',
                        searchable: true
                    },

                    {

                        data: 'product_image',
                        name: 'product_image',
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
                        // Show product name and its ID on console choosedVendorProductIdEdit
                        console.log('Product Name:', data.product_title);
                        console.log('Product ID:', data.id);
                        choosedVendorProductId.push(data.id);

                        choosenProduct = `<div class="col-lg-2 mb-3 d-flex align-items-stretch" id="vendorproductnewelement${data.id}">
                                    <div class="card position-relative">

                                        <img src="${data.imgsrc}"
                                            class="card-img-top" alt="Card Image" style="width:8vw;object-fit:contain">
                                    
          
                                     
                                           
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">${data.product_title}</h5>
                                            <button type="button" onclick="removeChossenProductElemet('vendorproductnewelement${data.id}',${data.id})" class="delete btn btn-danger "><i
                                                    class="ti-trash"></i></button>
                                        </div>
                                    </div>
                                </div>`;






                        $('#productBox').append(choosenProduct);






                    });
                }


            });



        };



        function vendorCategory(id) {

            let vendor_id = id;
            console.log(vendor_id);

            var formData = new FormData();

            formData.append('vendor_id', vendor_id);

            $.ajax({
                url: "{{ route('vendors.category') }}",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },

                beforeSend: function() {

                },

                success: (data) => {

                    let vendorCategory = data.vendorcategory;


                    console.log(vendorCategory);

                    let vendorCategoryLength = vendorCategory.length;

                    let vendorCategoryHtml = "<option></option>";

                    for (let i = 0; i < vendorCategoryLength; i++) {
                        vendorCategoryHtml = vendorCategoryHtml +
                            `<option value='${vendorCategory[i].category_id}'>${vendorCategory[i].categoryname}</option>`;

                    }




                    console.log(vendorCategoryHtml);

                    $("#vendorcategory").html(vendorCategoryHtml);

                    $(".vendorcategories").select2({
                            placeholder: "Select a product Category",
                            allowClear: true
                        }

                    )








                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        toastr.error(
                            "something gets wroung"
                        );






                    }



                }
            });





        }


        function saveDataOnPerOrderVendorCommmisionVendorCommmision() {

            let formData = new FormData();

            formData.append("vendor_id", choosrdVendorId)

            formData.append('perorderamount', $('#perorderamount').val());

            formData.append('perorderamount_commision_type', $('#ordertype').val());

            $.ajax({
                url: "{{ route('vendors.commisionperorder') }}",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },

                beforeSend: function() {

                    $("#vendor_id_error").html("");

                    $("#perorderamount_error").html(" ");

                    $("#perorderamount_commision_type_error").html(" ");


                },

                success: (data) => {

                    toastr.success(
                        "Commison per order save Successfully"
                    );



                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        toastr.error(
                            "something gets wroung"
                        );

                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                $(`[id="${fieldName}_error"]`).html(errorMessageBrand[
                                    fieldName][
                                    0
                                ]);

                            }

                        }






                    }



                }
            });







        }



        function savecategorycommision() {

            let formData = new FormData();

            formData.append("vendor_id", choosrdVendorId)

            formData.append('categoryamount', $('#category_commison_amount').val());

            formData.append('category_commision_type', $('#categorytype').val());

            formData.append('category_id', $('#vendorcategory').val());

            $.ajax({
                url: "{{ route('vendors.commisioncategory') }}",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },

                beforeSend: function() {

                    $("#vendor_id_error").html("");

                    $("#categoryamount_error").html(" ");

                    $("#category_commision_type_error").html(" ");

                    $("#category_id_error").html(" ");


                },

                success: (data) => {

                    toastr.success(
                        "Commison per order save Successfully"
                    );



                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        toastr.error(
                            "something gets wroung"
                        );

                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                $(`[id="${fieldName}_error"]`).html(errorMessageBrand[
                                    fieldName][
                                    0
                                ]);

                            }

                        }






                    }



                }
            });


        }

        function saveProductCommision() {

            let formData = new FormData();

            formData.append("vendor_id", choosrdVendorId)

            formData.append('product_commison_amount', $('#product_commison_amount').val());

            formData.append('product_commision_type', $('#product_commison_type').val());

            let uniqueArraychoosedVendorProductId = [...new Set(choosedVendorProductId)];
            let selectedProducts = uniqueArraychoosedVendorProductId;

            if (selectedProducts) {
                selectedProducts.forEach(productId => {
                    formData.append('product_id[]', productId);
                });
            }





            $.ajax({
                url: "{{ route('vendors.commisionproduct') }}",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },

                beforeSend: function() {

                    $("#vendor_id_error").html("");

                    $("#product_commison_amount_error").html(" ");

                    $("#product_commision_type_error").html(" ");

                    $("#product_id_error").html(" ");


                },

                success: (data) => {

                    toastr.success(
                        "Commison on product apply  Successfully"
                    );



                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        toastr.error(
                            "something gets wroung"
                        );

                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                $(`[id="${fieldName}_error"]`).html(errorMessageBrand[
                                    fieldName][
                                    0
                                ]);

                            }

                        }






                    }



                }
            });




        }



        function vendorCategoryCommision() {




            var table = $('.category-commision').DataTable({

                dom: '<"top"lfB>rt<"bottom"ip><"clear">', // Add this line to enable buttons
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 4, 5, 6, 7] // Exclude the action and product image columns
                        },

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columnns: [0, 1, 2, 4, 5, 6, 7] // Exclude the action and product image columns
                        }
                    }
                ],

                stateSave: true,
                "bDestroy": true,
                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('vendors.vendorcommisioncategorylist') }}",
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
                        name: 'vendors.name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'vendor_profile_image',
                        name: 'vendor_profile_image',
                        orderable: true,
                        searchable: true
                    },

                    {

                        data: 'category_name',
                        name: 'product_categories.name',
                        orderable: true,
                        searchable: true


                    },
                    {
                        data: 'amount',
                        name: 'vendor_commision_categories.amount ',
                        orderable: true,
                        searchable: true

                    },
                    {
                        data: 'type',
                        name: 'vendor_commision_categories.type',
                        orderable: true,
                        searchable: true

                    },
                    {
                        data: 'commisionpriority',
                        name: 'commisionpriority',
                        orderable: true,
                        searchable: false

                    },


                    {
                        data: 'created_date',
                        name: 'created_date',
                        orderable: true,
                        searchable: false
                    },

                    {
                        data: 'updated_date',
                        name: 'updated_date',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false
                    }


                ],
                language: {
                    // Customization for the "Entries per page" text
                    lengthMenu: "Show _MENU_ Entries per Page"
                }


            });



        };


        function vendorCommisionProductList() {
            var table = $('.product-commision').DataTable({

                dom: '<"top"lfB>rt<"bottom"ip><"clear">', // Add this line to enable buttons
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7, 8, 9] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7, 8, 9] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7, 8, 9] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7, 8, 9] // Exclude the action and product image columns
                        },

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7, 8, 9] // Exclude the action and product image columns
                        }
                    }
                ],

                stateSave: true,
                "bDestroy": true,
                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('vendors.vendorcommisionproductlist') }}",
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
                        name: 'vendors.name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'vendor_profile_image',
                        name: 'vendor_profile_image',
                        orderable: true,
                        searchable: true
                    },

                    {

                        data: 'product_title',
                        name: 'vendor_products.product_title',
                        orderable: true,
                        searchable: true


                    },
                    {
                        data: 'product_image',
                        name: 'product_image',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'amount',
                        name: 'vendor_commision_products.amount ',
                        orderable: true,
                        searchable: true

                    },
                    {
                        data: 'type',
                        name: 'vendor_commision_products.type',
                        orderable: true,
                        searchable: true

                    },
                    {
                        data: 'commisionpriority',
                        name: 'commisionpriority',
                        orderable: true,
                        searchable: false

                    },


                    {
                        data: 'created_date',
                        name: 'created_date',
                        orderable: true,
                        searchable: false
                    },

                    {
                        data: 'updated_date',
                        name: 'updated_date',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false
                    }


                ],
                language: {
                    // Customization for the "Entries per page" text
                    lengthMenu: "Show _MENU_ Entries per Page"
                }


            });



        }
    </script>


@endsection
