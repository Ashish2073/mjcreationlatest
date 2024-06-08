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
    </style>


    <!-- DataTables CSS -->

    <div class="container mt-5">
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
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Measurment</th>
                                <th>Product Quantity</th>
                                <th>Product SQU Number</th>
                                <th>User Name </th>
                                <th>User Email</th>
                                <th>User Phone </th>
                                <th>Order Amount</th>
                                <th>Payment Amount </th>
                                <th>Payment Method </th>
                                <th>Payment Status </th>
                                <th>Order Status </th>
                                <th>Order Date </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Shipped Orders Tab -->
            <div class="tab-pane fade" id="shipped-orders" role="tabpanel" aria-labelledby="shipped-orders-tab">
                <div class="table-responsive table-container">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12345</td>
                                <td>2024-06-08</td>
                                <td>John Doe</td>
                                <td>$150.00</td>
                                <td><span class="badge badge-success">Shipped</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">View</button>
                                    <button class="btn btn-success btn-sm">Track</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                </td>
                            </tr>
                            <!-- Repeat rows as necessary -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pending Orders Tab -->
            <div class="tab-pane fade" id="pending-orders" role="tabpanel" aria-labelledby="pending-orders-tab">
                <div class="table-responsive table-container">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>67890</td>
                                <td>2024-06-09</td>
                                <td>Jane Smith</td>
                                <td>$200.00</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">View</button>
                                    <button class="btn btn-success btn-sm">Track</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                </td>
                            </tr>
                            <!-- Repeat rows as necessary -->
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
                    {
                        data: 'product_title',
                        name: 'vendor_products.product_title',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'product_image',
                        name: 'product_image',
                        searchable: false
                    },
                    {
                        data: 'product_measurment',
                        name: 'product_measurment',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'quantity',
                        name: 'order_items.quantity',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'productsku',
                        name: 'vendor_products.sku',
                        orderable: true,
                        searchable: true
                    },
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
                    {
                        data: 'payment_method',
                        name: 'payments.payment_method ',
                        orderable: true,
                        searchable: true
                    },
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
                    }

                ],
                language: {
                    lengthMenu: "Show _MENU_ Entries per Page"
                }
            });
        };

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
    </script>
@endsection
