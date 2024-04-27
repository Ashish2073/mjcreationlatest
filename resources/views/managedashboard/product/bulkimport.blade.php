@extends('managedashboard.layout.main')
@section('title', 'vendor')
@section('content')
    <style>
        .error {
            color: #ff0000;
            display: block !important;
        }
    </style>


    @include('managedashboard.layout.loader')



    {{-- <section id="basic-datatable"> --}}
    <div class="container">
        <div class="row wrap">
            <div class="col-lg-6 p-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            Product Data Import
                        </h2>
                    </div>
                    {{-- {{ route('import.product.data') }} --}}
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form method="POST" id="import-product-add" action="#" name="import-data-form">
                                @csrf
                                <div class="form-group">
                                    <label for="import_product_file">Excel File</label>
                                    <input type="file" name="import_product_file" id="import_product_file" />
                                    {{-- @error('import_product_file')
                                            {!! errMsg($message) !!}
                                        @enderror --}}
                                </div>
                                <button id="import-product-btn" class="btn btn-primary" type="submit">Import</button>
                            </form>
                        </div>
                        <div class="card-footer">

                            <a download href="{{ asset('import_sample/product_basic_data.xlsx') }}">Click Here</a> to
                            download
                            sample.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            Product Specification Data Import
                        </h2>
                    </div>
                    {{-- {{ route('import.product.data') }} --}}
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form method="POST" id="import-product-specification-add" action="#"
                                name="import-data-specification-form">
                                @csrf
                                <div class="form-group">
                                    <label for="import_product_specification_file">Excel File</label>
                                    <input type="file" name="import_product_specification_file"
                                        id="import_product_specification_file" />
                                    {{-- @error('import_product_file')
                                            {!! errMsg($message) !!} import.product.specification.data
                                        @enderror --}}
                                </div>
                                <button id="import-product-specification-btn" class="btn btn-primary"
                                    type="submit">Import</button>
                            </form>
                        </div>
                        <div class="card-footer">

                            <a download href="{{ asset('import_sample/product_specification.xlsx') }}">Click Here</a> to
                            download
                            sample.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            Product Primary Cost Data Import
                        </h2>
                    </div>
                    {{-- {{ route('import.product.data') }} --}}
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form method="POST" id="import-product-primarry-cost-add" action="#"
                                name="import-product-primary-cost-data-form">
                                @csrf
                                <div class="form-group">
                                    <label for="import_product_primary_cost_data_file">Excel File</label>
                                    <input type="file" name="import_product_primary_cost_data_file"
                                        id="import_product_primary_cost_data_file" />
                                    {{-- @error('import_product_file')
                                            {!! errMsg($message) !!}
                                        @enderror --}}
                                </div>
                                <button id="import-product-primary-cost-btn" class="btn btn-primary"
                                    type="submit">Import</button>
                            </form>
                        </div>
                        <div class="card-footer">

                            <a download href="{{ asset('import_sample/product_primary_cost.xlsx') }}">Click Here</a> to
                            download
                            sample.
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>




    <div class="row sheet--error d-none">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Row Number</th>
                            <th>Error Message</th>
                        </tr>
                    </thead>
                    <tbody class='sheet--error-body'>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- </section> --}}



@endsection

@section('page-script')

    <script>
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': false,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'showDuration': '1000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut',
        }

        $("form[name='import-data-form']").validate({
            rules: {
                import_product_file: {
                    required: true,
                    extension: "xls|xlsx",
                }
            },
            messages: {
                import_product_file: {
                    required: 'Please select a file',
                    extension: 'Please select a valid Excel file (XLS or XLSX)'
                }
            },
            submitHandler: function(form) {
                let formData = new FormData(form);
                let excelFile = $('input[name="import_product_file"]')[0].files[0];
                formData.append("import_product_file", excelFile);

                // You can add additional form data here if needed
                formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

                $.ajax({
                    url: "{{ route('import.product.data') }}",
                    type: "POST",
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    beforeSend: function() {
                        $("#loader").html("<div></div>");
                        $("#main_content").addClass("demo");
                    },
                    success: function(data) {
                        console.log(data);
                        $("#loader").html("");
                        $("#main_content").removeClass("demo");

                        if (data.success) {
                            toastr.success(
                                "Data import Sucessfully"
                            );


                        } else {
                            let sheetError = data.sheetError;

                            let sheetErrorCount = sheetError.length;
                            let errrorMessage = "";
                            for (let i = 0; i < sheetErrorCount; i++) {
                                errrorMessage = errrorMessage + " " + (i + 1) + "-" + sheetError[i]
                                    .message + "\n";

                            }

                            toastr.error(
                                "Somethings get wroung please check on sheet"
                            );

                            displaySheetError(data.sheetError);

                        }


                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
            },
            invalidHandler: function(form, validator) {
                var errors = validator.errorList.map(function(error) {
                    return error.message;
                });
                console.error("Validation errors:", errors);
            }
        });

        $("form[name='import-data-specification-form']").validate({
            rules: {
                import_product_specification_file: {
                    required: true,
                    extension: "xls|xlsx",
                }
            },
            messages: {
                import_product_specification_file: {
                    required: 'Please select a file',
                    extension: 'Please select a valid Excel file (XLS or XLSX)'
                }
            },
            submitHandler: function(form) {
                let formData = new FormData(form);
                let excelFile = $('input[name="import_product_specification_file"]')[0].files[0];
                formData.append("import_product_specification_file", excelFile);

                // You can add additional form data here if needed
                formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

                $.ajax({
                    url: "{{ route('import.product.specification.data') }}",
                    type: "POST",
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    beforeSend: function() {
                        $("#loader").html("<div></div>");
                        $("#main_content").addClass("demo");
                    },
                    success: function(data) {
                        console.log(data);
                        $("#loader").html("");
                        $("#main_content").removeClass("demo");

                        if (data.success) {
                            toastr.success(
                                "Data import Sucessfully"
                            );


                        } else {
                            let sheetError = data.sheetError;

                            let sheetErrorCount = sheetError.length;
                            let errrorMessage = "";
                            for (let i = 0; i < sheetErrorCount; i++) {
                                errrorMessage = errrorMessage + " " + (i + 1) + "-" + sheetError[i]
                                    .message + "\n";

                            }

                            toastr.error(
                                "Somethings get wroung please check on sheet"
                            );

                            displaySheetError(data.sheetError);

                        }


                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
            },
            invalidHandler: function(form, validator) {
                var errors = validator.errorList.map(function(error) {
                    return error.message;
                });
                console.error("Validation errors:", errors);
            }
        });


        $("form[name='import-product-primary-cost-data-form']").validate({
            rules: {
                import_product_primary_cost_data_file: {
                    required: true,
                    extension: "xls|xlsx",
                }
            },
            messages: {
                import_product_primary_cost_data_file: {
                    required: 'Please select a file',
                    extension: 'Please select a valid Excel file (XLS or XLSX)'
                }
            },
            submitHandler: function(form) {
                let formData = new FormData(form);
                let excelFile = $('input[name="import_product_primary_cost_data_file"]')[0].files[0];
                formData.append("import_product_primary_cost_data_file", excelFile);

                // You can add additional form data here if needed
                formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

                $.ajax({
                    url: "{{ route('import.product.primary.cost.data') }}",
                    type: "POST",
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    beforeSend: function() {
                        $("#loader").html("<div></div>");
                        $("#main_content").addClass("demo");
                    },
                    success: function(data) {
                        console.log(data);
                        $("#loader").html("");
                        $("#main_content").removeClass("demo");

                        if (data.success) {
                            toastr.success(
                                "Data import Sucessfully"
                            );


                        } else {
                            let sheetError = data.sheetError;

                            let sheetErrorCount = sheetError.length;
                            let errrorMessage = "";
                            for (let i = 0; i < sheetErrorCount; i++) {
                                errrorMessage = errrorMessage + " " + (i + 1) + "-" + sheetError[i]
                                    .message + "\n";

                            }

                            toastr.error(
                                "Somethings get wroung please check on sheet"
                            );

                            displaySheetError(data.sheetError);

                        }


                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
            },
            invalidHandler: function(form, validator) {
                var errors = validator.errorList.map(function(error) {
                    return error.message;
                });
                console.error("Validation errors:", errors);
            }
        });






        function displaySheetError(sheetErrors) {
            $('.sheet--error-body').html('');

            if (sheetErrors == undefined) {
                $(".sheet--error").addClass('d-none');
                return;
            }

            if (sheetErrors.length == 0) {
                $(".sheet--error").addClass('d-none');
                return;
            }

            $('.sheet--error').removeClass('d-none');

            sheetErrors.forEach(function(sheetError) {
                $(".sheet--error-body").append(`
                    <tr>
                        <td>${sheetError.rowNumber}</td>
                        <td>${sheetError.message}</td>
                    <tr>
                `);
            });

            $('html, body').animate({
                scrollTop: $(".sheet--error-body").offset().top
            }, 500);
        }
    </script>

@endsection
