@extends('managedashboard.layout.main')
@section('title', 'Vendor Commision')

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



            <div class="content-header-right text-md-left  col-12">
                <div class="form-group">

                    <button onclick="showAddForm()" class="btn-icon btn btn-primary btn-round btn-sm">
                        <i class="ti-plus"></i>
                    </button>




                </div>
            </div>








            <div id="changecategorycommisionmodal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="vendorCommisionCategoryModalContent">

                    </div>
                </div>
            </div>

            <div id="changeproductcommisionmodal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="vendorCommisionProductModalContent">

                    </div>
                </div>
            </div>


            <div id="changeordercommisionmodal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="vendorCommisionOrderModalContent">

                    </div>
                </div>
            </div>





            <div class="p-3 row shadow ms-3" style="background: #ffced785;">
                <div class="col-md-12">

                    <h3 style="font-family:serif">Category Wise Commision </h3>
                    <div style="overflow-x: auto; ">
                        <table class="discount-list-data-table table table-striped category-commision" style="width:100%;">
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


            </div>

            <div class="p-3 row shadow ms-3 mt-5" style="background: #ffced785;">
                <div class="col-md-12">

                    <h3 style="font-family:serif">Product Wise Commision </h3>
                    <div style="overflow-x: auto; ">
                        <table class="discount-list-data-table table table-striped product-commision" style="width:100%;">
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


            </div>

            <div class="p-3 row shadow ms-3 mt-5" style="background: #ffced785;">
                <div class="col-md-12">

                    <h3 style="font-family:serif">Order Wise Commision </h3>
                    <div style="overflow-x: auto; ">
                        <table class="discount-list-data-table table table-striped perorder-commision" style="width:100%;">
                            <thead>
                                <tr>

                                    <th>Sr No.</th>
                                    <th>Vendor Name </th>
                                    <th>Vendor Profile Image</th>
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

        vendorCommisionPerorderList();



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

                    vendorCommisionPerorderList();
                    hideAddForm();



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

                    vendorCategoryCommision();

                    hideAddForm();

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

                    vendorCommisionProductList();

                    hideAddForm();


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

        function vendorCommisionPerorderList() {
            var table = $('.perorder-commision').DataTable({

                dom: '<"top"lfB>rt<"bottom"ip><"clear">', // Add this line to enable buttons
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7] // Exclude the action and product image columns
                        },

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 6, 7] // Exclude the action and product image columns
                        }
                    }
                ],

                stateSave: true,
                "bDestroy": true,
                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('vendors.vendorcommisionperorderlist') }}",
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
                        data: 'amount',
                        name: 'vendor_commision_orders.amount ',
                        orderable: true,
                        searchable: true

                    },
                    {
                        data: 'type',
                        name: 'vendor_commision_orders.type',
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



        function editCategoryCommision(id, vendor_id) {



            var formData = new FormData();

            formData.append('vendor_id', vendor_id);

            formData.append('id', id);



            $.ajax({
                url: "{{ route('vendors.editcommisioncategory') }}",
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


                    console.log(data);

                    let vendorCommisionEditModalHtml = `<div class="modal-header">
                                                            <div class="container mt-5">
                                                                        <div class="card">
                                                                         <div class="row no-gutters">
                                                                           <div class="col-md-4">
                                                                            <img src="${data.url}" class="card-img" alt="Profile Image">
                                                                             </div>
                                                                          <div class="col-md-8">
                                                                          <div class="card-body">
                        <h5 class="card-title text-muted"  style="font-weight: 700;">Vendor Name</h5>
                        <p class="card-text">${data.vendor_name}</p>
                        <h6 class="card-subtitle mb-2 text-muted" style="font-weight: 700;">Category</h6>
                        <p class="card-text">${data.category_name}</p>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" value="${data.vendorcategorycommision.amount}" id="vendor_commision_category_amount_edit" placeholder="Enter amount">
                       <span id="category_commision_amount_error_edit" style="color:red"></span>
                       
                            </div>
                        <div class="form-group">
                            <label for="options">Select Option</label>
                            <select class="form-control" id="vendor_commision_category_type_edit">
                                <option disabled>Please Select Option</option>
                                
                                <option  ${data.vendorcategorycommision.type == 'percentage' ? 'selected' : ''} style="font-weight: 700;"  value="percentage">Percentage</option>
                                <option ${data.vendorcategorycommision.type == 'flat' ? 'selected' : ''} style="font-weight: 700;" value="flat">Flat</option>
                            </select>
                            <span id="category_commision_type_error_edit" style="color:red"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                                       

                                                      
                                                                 </div>
                                                                 
                                                                 <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="vendorCategoryCammisonupdate(${data.id})">Update</button>
                        </div>`;

                    $("#vendorCommisionCategoryModalContent").html(vendorCommisionEditModalHtml);



                    $("#changecategorycommisionmodal").modal('show');






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



        function vendorCategoryCammisonupdate(id) {

            let commision_category_id = id;
            let vendorCommisonUpdatedAmount = $("#vendor_commision_category_amount_edit").val();

            let vendorCommisonUpdatedtype = $("#vendor_commision_category_type_edit").val();

            let formData = new FormData();
            formData.append('id', commision_category_id);
            formData.append('category_commision_amount', vendorCommisonUpdatedAmount);
            formData.append('category_commision_type', vendorCommisonUpdatedtype);

            $.ajax({
                url: "{{ route('vendors.updatecommisioncategory') }}",
                type: "POST",
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
                    toastr.success(
                        "Category Commision Updated Sucessfully");

                    $("#changecategorycommisionmodal").modal('hide');

                    var parentTr = $('#editcategorycommision' + id).closest('tr');

                    // Change the inner HTML of the 5th and 6th td elements
                    parentTr.find('td').eq(4).html(data.amount); // 5th td element (index 4)
                    parentTr.find('td').eq(5).html(data.html);

                    // var currentPage = $('.category-commision').DataTable().page();


                    // // Reinitialize the table and restore the page
                    // vendorCategoryCommision();
                    // var table = $('.category-commision').DataTable();
                    // table.page(currentPage).draw(false);






                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });




        }


        function deleteCategoryCommision(id, vendor_id) {

            let commision_category_id = id;


            let formData = new FormData();
            formData.append('id', commision_category_id);


            $.ajax({
                url: "{{ route('vendors.deleteCategoryCommision') }}",
                type: "POST",
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
                    toastr.success(
                        "Category Commision detleted Sucessfully");
                    vendorCategoryCommision();

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });



        }


        function editVendorCommisionProduct(id) {


            let formData = new FormData();
            formData.append('id', id);


            $.ajax({
                url: "{{ route('vendors.editvendorproductcommision') }}",
                type: "POST",
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

                    let vendorCommisionEditModalHtml = `
    <div class="modal-header">
        <div class="container mt-5">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="${data.vendorimage}" class="card-img" alt="Vendor Image">
                    </div>
                    <div class="col-md-4">
                        <img src="${data.productimageurl}" class="card-img" alt="Product Image">
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title text-muted" style="font-weight: 700;">Vendor Name</h5>
                            <p class="card-text">${data.vendor_name}</p>
                            <h6 class="card-subtitle mb-2 text-muted" style="font-weight: 700;">Product Title</h6>
                            <p class="card-text">${data.product_name}</p>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" value="${data.amount}" id="vendor_commision_product_amount_edit" placeholder="Enter amount">
                                <span id="product_commision_amount_error_edit" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="options">Select Option</label>
                                <select class="form-control" id="vendor_commision_product_type_edit">
                                    <option disabled>Please Select Option</option>
                                    <option ${data.type == 'percentage' ? 'selected' : ''} style="font-weight: 700;" value="percentage">Percentage</option>
                                    <option ${data.type == 'flat' ? 'selected' : ''} style="font-weight: 700;" value="flat">Flat</option>
                                </select>
                                <span id="product_commision_type_error_edit" style="color:red"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="vendorProductCammisonupdate(${data.id})">Update</button>
    </div>`;



                    $('#vendorCommisionProductModalContent').html(vendorCommisionEditModalHtml);

                    $("#changeproductcommisionmodal").modal('show');







                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });

        }


        function vendorProductCammisonupdate(id) {


            let vendorCommisonProductUpdatedAmount = $("#vendor_commision_product_amount_edit").val();

            let vendorCommisonProductUpdatedtype = $("#vendor_commision_product_type_edit").val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('product_commision_amount', vendorCommisonProductUpdatedAmount);
            formData.append('product_commision_type', vendorCommisonProductUpdatedtype);

            $.ajax({
                url: "{{ route('vendors.updatecommisionproduct') }}",
                type: "POST",
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
                    toastr.success(
                        "Product Commision Updated Sucessfully");

                    $("#changeproductcommisionmodal").modal('hide');

                    var currentPage = $('.product-commision').DataTable().page();

                    let parentTr = $('#editVendorCommisionProduct' + id).closest('tr');

                    // Change the inner HTML of the 5th and 6th td elements
                    parentTr.find('td').eq(5).html(data.amount); // 5th td element (index 4)
                    parentTr.find('td').eq(6).html(data.html);
                    // Reinitialize the table and restore the page
                    // vendorCommisionProductList();
                    // var table = $('.product-commision').DataTable();
                    // table.page(currentPage).draw(false);






                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });


        }


        function deleteVendorCommisionProduct(id) {




            let formData = new FormData();
            formData.append('id', id);


            $.ajax({
                url: "{{ route('vendors.deletevendorcommisionproduct') }}",
                type: "POST",
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
                    toastr.success(
                        "Product Commision detleted Sucessfully");
                    var currentPage = $('.product-commision').DataTable().page();

                    // Reinitialize the table and restore the page
                    vendorCommisionProductList();
                    var table = $('.product-commision').DataTable();
                    table.page(currentPage).draw(false);

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });




        }


        function editordercommision(id) {

            console.log(id);

            let formData = new FormData();

            formData.append('id', id);



            $.ajax({
                url: "{{ route('vendors.editordercommision') }}",
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


                    console.log(data);

                    let vendorCommisionEditModalHtml = `<div class="modal-header">
                                                            <div class="container mt-5">
                                                                        <div class="card">
                                                                         <div class="row no-gutters">
                                                                           <div class="col-md-4">
                                                                            <img src="${data.vendorimage}" class="card-img" alt="Profile Image">
                                                                             </div>
                                                                          <div class="col-md-8">
                                                                          <div class="card-body">
                        <h5 class="card-title text-muted"  style="font-weight: 700;">Vendor Name</h5>
                        <p class="card-text">${data.vendor_name}</p>
                      
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" value="${data.amount}" id="vendor_commision_order_amount_edit" placeholder="Enter amount">
                       <span id="perorder_commision_amount_error_edit" style="color:red"></span>
                       
                            </div>
                        <div class="form-group">
                            <label for="options">Select Option</label>
                            <select class="form-control" id="vendor_order_category_type_edit">
                                <option disabled>Please Select Option</option>
                                
                                <option  ${data.type == 'percentage' ? 'selected' : ''} style="font-weight: 700;"  value="percentage">Percentage</option>
                                <option ${data.type == 'flat' ? 'selected' : ''} style="font-weight: 700;" value="flat">Flat</option>
                            </select>
                            <span id="perorder_commision_type_error_edit" style="color:red"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                                       

                                                      
                                                                 </div>
                                                                 
                                                                 <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="vendorOrderCammisonupdate(${data.id})">Update</button>
                        </div>`;

                    $("#vendorCommisionOrderModalContent").html(vendorCommisionEditModalHtml);



                    $("#changeordercommisionmodal").modal('show');






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


        function vendorOrderCammisonupdate(id) {

            let vendorCommisonOrderUpdatedAmount = $("#vendor_commision_order_amount_edit").val();

            let vendorCommisonOrderUpdatedtype = $("#vendor_order_category_type_edit").val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('perorder_commision_amount', vendorCommisonOrderUpdatedAmount);
            formData.append('perorder_commision_type', vendorCommisonOrderUpdatedtype);

            $.ajax({
                url: "{{ route('vendors.updatordercommision') }}",
                type: "POST",
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
                    toastr.success(
                        "Perorder Commision Updated Sucessfully");

                    $("#changeordercommisionmodal").modal('hide');

                    var parentTr = $('#editordercommision' + id).closest('tr');

                    // Change the inner HTML of the 5th and 6th td elements
                    parentTr.find('td').eq(3).html(data.amount); // 5th td element (index 4)
                    parentTr.find('td').eq(4).html(data.html);

                    // var currentPage = $('.perorder-commision').DataTable().page();

                    // Reinitialize the table and restore the page
                    // vendorCommisionPerorderList();
                    // var table = $('.perorder-commision').DataTable();
                    // table.page(currentPage).draw(false);






                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });






        }


        function deleteordercommision(id) {




            let formData = new FormData();
            formData.append('id', id);


            $.ajax({
                url: "{{ route('vendors.deletevendorcommisionperorder') }}",
                type: "POST",
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
                    toastr.success(
                        "Per Order Commision detleted Sucessfully");
                    $("#changeordercommisionmodal").modal('hide');

                    var currentPage = $('.perorder-commision').DataTable().page();

                    // Reinitialize the table and restore the page
                    vendorCommisionPerorderList();
                    var table = $('.perorder-commision').DataTable();
                    table.page(currentPage).draw(false);;

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        errorMessage = xhr.responseJSON.errormessage;

                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                    0
                                ]);


                            }

                        }



                        toastr.error(
                            "Somthing get wroung"
                        );





                    }





                }
            });




        }
    </script>


@endsection
