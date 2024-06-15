@extends('managedashboard.layout.main')
@section('title', 'Vendor Order Managment')

@section('content')
    <style>
        .tab-content {
            margin-top: 20px;
        }

        .table-container {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.9em;
        }

        .table th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table th:first-child {
            border-top-left-radius: 10px;
        }

        .table th:last-child {
            border-top-right-radius: 10px;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }

        #orderactionid .modal-dialog {
            width: 80%;
            /* Adjust the width as needed */
            max-width: none;
            /* Override max-width */
        }

        #orderactionid .modal-content {
            max-height: 90vh;
            /* Adjust the height as needed */
            overflow-y: auto;
        }

        .product-details-table-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .container .steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .container .steps .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            /* Ensure step elements are above progress bar */
        }

        .container .steps .circle {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            background-color: #fff;
            border-radius: 50%;
            color: #999;
            font-size: 22px;
            font-weight: 500;
            border: 4px solid #e0e0e0;
            transition: all 0.3s ease;
            z-index: 1;
            /* Ensure circles are above progress bar */
        }

        .container .steps .circle.active {
            border-color: #12a53e;
            color: #12a53e;
        }

        .labelproductactive {
            color: #12a53e !important;
            /* font-size: 15px; */
            font-weight: 700;
        }


        .container .steps label {
            margin-top: 10px;
            font-size: 14px;
            color: #999;
            text-align: center;
            max-width: 100px;
            /* Adjust width as needed */
            word-wrap: break-word;
            /* Wrap long labels */
        }

        .container .progress-bar {
            position: absolute;
            top: 23%;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #e0e0e0;
            z-index: 0;
            /* Ensure progress bar is behind circles */
            transform: translateY(-50%);
            /* Center the progress bar vertically */
        }

        .container .progress-bar .indicator {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #12a53e;
            transition: width 0.3s ease;
        }

        .container .buttons {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .container .buttons button {
            padding: 8px 16px;
            border: none;
            outline: none;
            color: #fff;
            background-color: #4070f4;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .container .buttons button:active {
            transform: scale(0.97);
        }

        .container .buttons button:disabled {
            background-color: #87a5f8;
            cursor: not-allowed;
        }
    </style>


    <!-- DataTables CSS -->

    <div class="container mt-5">

        {{-- <div class="container">
            <div class="steps">
                <span class="circle active">1</span>
                <span class="circle">2</span>
                <span class="circle">3</span>
                <span class="circle">4</span>
                <div class="progress-bar">
                    <span class="indicator"></span>
                </div>
            </div>
            <div class="buttons">
                <button id="prev" disabled>Previous</button>
                <button id="next">Next</button>
            </div>
        </div> --}}
        <!--Modal--->
        <div id="orderactionid" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" id="orderdetailsmodalcontent">

                </div>
            </div>
        </div>











        <!--------->












        <h2 class="text-center"> Order List</h2>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="orderTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-orders-tab" data-toggle="tab" href="#all-orders" role="tab"
                    aria-controls="all-orders" aria-selected="true">All Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shipped-orders-tab" data-toggle="tab" href="#shipped-orders" role="tab"
                    aria-controls="shipped-orders" aria-selected="false">Shipped Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pending-orders-tab" data-toggle="tab" href="#pending-orders" role="tab"
                    aria-controls="pending-orders" aria-selected="false">Pending Orders</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="orderTabContent">
            <!-- All Orders Tab -->
            <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
                <div class="table-responsive table-container" style="overflow-x: auto; ">
                    <table class="table table-striped orders-all-data-table">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Order Id</th>
                                {{-- <th>Product Name</th> --}}
                                {{-- <th>Product Image</th> --}}
                                {{-- <th>Product Measurment</th>
                                <th>Product Quantity</th> --}}
                                {{-- <th>Product SQU Number</th> --}}
                                <th>User Name </th>
                                <th>User Email</th>
                                <th>User Phone </th>
                                <th>Order Amount</th>
                                <th>Payment Amount </th>
                                {{-- <th>Payment Method </th> --}}
                                <th>Payment Status </th>
                                <th>Order Status </th>
                                <th>Order Date </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Shipped Orders Tab -->
            <div class="tab-pane fade" id="shipped-orders" role="tabpanel" aria-labelledby="shipped-orders-tab">
                <div class="table-responsive table-container" style="overflow-x: auto; ">
                    <table class="table table-striped orders-shipped-data-table">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Order Id</th>
                                {{-- <th>Product Name</th> --}}
                                {{-- <th>Product Image</th> --}}
                                {{-- <th>Product Measurment</th>
                                <th>Product Quantity</th> --}}
                                {{-- <th>Product SQU Number</th> --}}
                                <th>User Name </th>
                                <th>User Email</th>
                                <th>User Phone </th>
                                <th>Order Amount</th>
                                <th>Payment Amount </th>
                                {{-- <th>Payment Method </th> --}}
                                <th>Payment Status </th>
                                <th>Order Status </th>
                                <th>Order Date </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pending Orders Tab -->
            <div class="tab-pane fade" id="pending-orders" role="tabpanel" aria-labelledby="pending-orders-tab">
                <div class="table-responsive table-container" style="overflow-x: auto; ">
                    <table class="table table-striped orders-no-action-data-table">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Order Id</th>
                                {{-- <th>Product Name</th> --}}
                                {{-- <th>Product Image</th> --}}
                                {{-- <th>Product Measurment</th>
                                <th>Product Quantity</th> --}}
                                {{-- <th>Product SQU Number</th> --}}
                                <th>User Name </th>
                                <th>User Email</th>
                                <th>User Phone </th>
                                <th>Order Amount</th>
                                <th>Payment Amount </th>
                                {{-- <th>Payment Method </th> --}}
                                <th>Payment Status </th>
                                <th>Order Status </th>
                                <th>Order Date </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            orderDetailsDataTable();
            orderDetailsNoActionDataTable();
            orderDetailsShippedDataTable();

        });

        function orderDetailsDataTable() {
            if ($.fn.DataTable.isDataTable('.orders-all-data-table')) {
                $('.orders-all-data-table').DataTable().clear().destroy();
            }

            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var table = $('.orders-all-data-table').DataTable({
                dom: '<"top"lfB>rt<"bottom"ip><"clear">',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
                stateSave: true,
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: "{{ route('vendors.orderlist') }}",
                    type: "get",
                    data: {
                        _token: csrfToken
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'serial_number',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_unique_id',
                        name: 'orders.order_unique_id ',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'product_title',
                    //     name: 'vendor_products.product_title',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    // {
                    //     data: 'product_image',
                    //     name: 'product_image',
                    //     searchable: false
                    // },
                    // {
                    //     data: 'product_measurment',
                    //     name: 'product_measurment',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    // {
                    //     data: 'quantity',
                    //     name: 'order_items.quantity',
                    //     orderable: true,
                    //     searchable: true
                    // },

                    {
                        data: 'user_name',
                        name: 'users.name ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_email',
                        name: 'users.email ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_phone',
                        name: 'users.phone_no ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'orders_with_currency',
                        name: 'orders_with_currency ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'payment_with_currency',
                        name: 'payment_with_currency ',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'payment_method',
                    //     name: 'payments.payment_method ',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_status',
                        name: 'order_status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_date',
                        name: 'orders.created_at',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],
                language: {
                    lengthMenu: "Show _MENU_ Entries per Page"
                }
            });
        };


        function orderDetailsShippedDataTable() {
            if ($.fn.DataTable.isDataTable('.orders-shipped-data-table')) {
                $('.orders-shipped-data-table').DataTable().clear().destroy();
            }

            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var table = $('.orders-shipped-data-table').DataTable({
                dom: '<"top"lfB>rt<"bottom"ip><"clear">',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
                stateSave: true,
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: "{{ route('vendors.orderlist') }}",
                    type: "get",
                    data: {
                        order_status: "3",
                        _token: csrfToken
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'serial_number',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_unique_id',
                        name: 'orders.order_unique_id ',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'product_title',
                    //     name: 'vendor_products.product_title',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    // {
                    //     data: 'product_image',
                    //     name: 'product_image',
                    //     searchable: false
                    // },
                    // {
                    //     data: 'product_measurment',
                    //     name: 'product_measurment',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    // {
                    //     data: 'quantity',
                    //     name: 'order_items.quantity',
                    //     orderable: true,
                    //     searchable: true
                    // },

                    {
                        data: 'user_name',
                        name: 'users.name ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_email',
                        name: 'users.email ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_phone',
                        name: 'users.phone_no ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'orders_with_currency',
                        name: 'orders_with_currency ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'payment_with_currency',
                        name: 'payment_with_currency ',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'payment_method',
                    //     name: 'payments.payment_method ',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_status',
                        name: 'order_status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_date',
                        name: 'orders.created_at',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],
                language: {
                    lengthMenu: "Show _MENU_ Entries per Page"
                }
            });
        };


        function orderDetailsNoActionDataTable() {

            if ($.fn.DataTable.isDataTable('.orders-no-action-data-table')) {
                $('.orders-no-action-data-table').DataTable().clear().destroy();
            }


            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var tablenoaction = $('.orders-no-action-data-table').DataTable({
                dom: '<"top"lfB>rt<"bottom"ip><"clear">',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
                stateSave: true,
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: "{{ route('vendors.orderlist') }}",
                    type: "get",
                    data: {
                        order_status: "1",
                        _token: csrfToken
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'serial_number',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_unique_id',
                        name: 'orders.order_unique_id ',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'product_title',
                    //     name: 'vendor_products.product_title',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    // {
                    //     data: 'product_image',
                    //     name: 'product_image',
                    //     searchable: false
                    // },
                    // {
                    //     data: 'product_measurment',
                    //     name: 'product_measurment',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    // {
                    //     data: 'quantity',
                    //     name: 'order_items.quantity',
                    //     orderable: true,
                    //     searchable: true
                    // },

                    {
                        data: 'user_name',
                        name: 'users.name ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_email',
                        name: 'users.email ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_phone',
                        name: 'users.phone_no ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'orders_with_currency',
                        name: 'orders_with_currency ',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'payment_with_currency',
                        name: 'payment_with_currency ',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'payment_method',
                    //     name: 'payments.payment_method ',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_status',
                        name: 'order_status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_date',
                        name: 'orders.created_at',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],
                language: {
                    lengthMenu: "Show _MENU_ Entries per Page"
                }
            });
        };


        function orderaction(id) {

            $("#orderactionid").modal('show');

            var formData = new FormData();
            formData.append('id', id);


            $.ajax({
                url: "{{ route('vendors.userorderdetails') }}",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: (data) => {

                    $("#orderdetailsmodalcontent").html(data.responsehtml);
                    progressBar(data.order_status);
                    acceptOrder(data.orderid);
                    sendForShipment(data.orderid);

                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        var errorMessageBrand = xhr.responseJSON.errormessage;
                        toastr.error("Something went wrong");
                        for (fieldName in errorMessageBrand) {
                            if (errorMessageBrand.hasOwnProperty(fieldName)) {
                                // $(`[id="mesaurement_parameter_error_id"`).html(errorMessageBrand[
                                //     fieldName][0]);
                            }
                        }
                    }
                }
            });





        }









        // function changeStatus(id) {
        //     let vendor_id = id;

        //     $("#changeStatusId").modal('show');
        //     $('#savestauschanges').off('click').on('click', function(e) {
        //         e.preventDefault();
        //         var formData = new FormData();
        //         formData.append('vendor_id', vendor_id);
        //         formData.append('status', $("#status-select").val());

        //         $.ajax({
        //             url: "{{ route('vendors.statusupdate') }}",
        //             type: 'POST',
        //             data: formData,
        //             async: false,
        //             cache: false,
        //             contentType: false,
        //             processData: false,
        //             headers: {
        //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        //             },
        //             success: (data) => {
        //                 $("#changeStatusId").modal('hide');
        //                 let status = data.status == 1 ? "Active" : "Inactive";
        //                 let status_btn = data.status == 1 ? 'btn btn-success' : 'btn btn-danger';
        //                 toastr.success("Status Updated Successfully");
        //                 $(`#statuschange${data.id}`).html(status).attr("class", status_btn);
        //             },
        //             error: function(xhr) {
        //                 if (xhr.status == 422) {
        //                     var errorMessageBrand = xhr.responseJSON.errormessage;
        //                     toastr.error("Something went wrong");
        //                     for (fieldName in errorMessageBrand) {
        //                         if (errorMessageBrand.hasOwnProperty(fieldName)) {
        //                             $(`[id="mesaurement_parameter_error_id"`).html(errorMessageBrand[
        //                                 fieldName][0]);
        //                         }
        //                     }
        //                 }
        //             }
        //         });
        //     });
        // }


        function acceptOrder(id) {
            $('input[name="orderAccepted"]').change(function() {
                var orderAccepted = $('input[name="orderAccepted"]:checked').val();
                var orderId = id; // Replace with your actual order ID
                console.log(id);

                Swal.fire({
                    title: (orderAccepted == 2) ? "Do you want to accept this order?" :
                        "Do you want to reject this order",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request to save the changes
                        $.ajax({
                            url: "{{ route('vendors.orderstatuschange') }}", // Replace with your API endpoint
                            type: 'POST',
                            data: {
                                orderId: orderId,
                                orderAccepted: orderAccepted,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                if (data.status == "2") {
                                    Swal.fire("Saved!", "Order Accepted By Vendor", "success");
                                    progressBar(data.status);

                                } else {
                                    progressBar("1");
                                    Swal.fire("Error", "Order not accepted.",
                                        "error");
                                }


                            },
                            error: function(xhr, status, error) {
                                Swal.fire("Error",
                                    "You cannot change the order status because this order has been dispatched to the shipment company",
                                    "error");
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
        };


        function sendForShipment(id) {
            $('input[name="sendToShipment"]').change(function() {
                var orderAccepted = $('input[name="sendToShipment"]:checked').val();
                var orderId = id; // Replace with your actual order ID
                console.log(id);

                Swal.fire({
                    title: (orderAccepted == 3) ? "Do you want to Send Order for shipment?" :
                        "Do you want not take any action for shipemnt",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request to save the changes
                        $.ajax({
                            url: "{{ route('vendors.sendordershipment') }}", // Replace with your API endpoint
                            type: 'POST',
                            data: {
                                orderId: orderId,
                                orderAccepted: orderAccepted,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                console.log(data);

                                Swal.fire("Saved!", "Order sent to shipment Company",
                                    "success");
                                progressBar("3");





                            },
                            error: function(xhr, status, error) {
                                Swal.fire("Error", "There was an error saving the changes.",
                                    "error");
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
        };








        function progressBar(status) {
            const buttons = document.querySelectorAll("button");
            const progressbar = document.querySelector(".indicator");
            const circles = document.querySelectorAll(".circle");
            const steplebels = document.querySelectorAll(".steplebel");

            let currentStep = status;

            // const updateStep = (e) => {
            //     //update current step based on button click
            //     currentStep = e.target.id === "next" ? ++currentStep : --currentStep;

            //loop circles and add or remove class active based on current step value
            for (let i = 0; i < currentStep; i++) {

                circles.forEach((circle, index) => {
                    circle.classList[`${index < currentStep ? "add" : "remove"}`]("active");
                });

                steplebels.forEach((steplebeltext, index) => {
                    steplebeltext.classList[`${index < currentStep ? "add" : "remove"}`]("labelproductactive");
                });


                //update progress bar based on current step value

                progressbar.style.width = `${
                 ((currentStep - 1) / (circles.length - 1)) * 100
                  }%`;

                //checking if current step is last or first and enable or disable buttons

                if (currentStep === circles.length) {
                    buttons[1].disabled = true;
                } else if (currentStep === 1) {
                    buttons[0].disabled = true;
                } else {
                    buttons.forEach((button) => (button.disabled = false));
                }
                // };

            };

            // buttons.forEach((button) => {
            //     button.addEventListener("click", updateStep);
            // });

        }
    </script>
@endsection
