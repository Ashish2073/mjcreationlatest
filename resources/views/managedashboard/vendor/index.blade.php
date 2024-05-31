@extends('managedashboard.layout.main')
@section('title', 'Vendor Profile')
@section('content')









    <div id="productvendortable" class="container mt-5 table-responsive">

        @include('managedashboard.vendor.status')
        <table class="data-table table table-striped" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>No</th> --}}
                    <th>Sr No.</th>
                    <th>Vendor Name</th>
                    <th>Vendor Email</th>
                    <th>Vendor Image </th>
                    <th>status</th>
                    <th>Created Date </th>


                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


    </div>



@endsection


@section('page-script')

    <script>
        dataTable();


        function dataTable() {



            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var table = $('.data-table').DataTable({

                dom: '<"top"lfB>rt<"bottom"ip><"clear">', // Add this line to enable buttons
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Exclude the action and product image columns
                        },

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Exclude the action and product image columns
                        }
                    }
                ],

                stateSave: true,
                "bDestroy": true,
                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('vendor.detail') }}",
                    type: "post",
                    data: {
                        _token: csrfToken,

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
                    {
                        data: 'status',
                        name: 'status',
                        searchable: true

                    },

                    {
                        data: 'created_date',
                        name: 'created_date',
                        orderable: true,
                        searchable: false
                    },
                ],
                language: {
                    // Customization for the "Entries per page" text
                    lengthMenu: "Show _MENU_ Entries per Page"
                }


            });



        };


        function changeStatus(id) {

            let vendor_id = id;

            console.log(id);


            $("#changeStatusId").modal('show');
            $('#savestauschanges').off('click');

            $('#savestauschanges').on('click', function(e) {
                e.preventDefault();

                console.log('vendor', vendor_id);

                console.log('statusvalue', $("#status-select").val())



                var formData = new FormData();

                formData.append('vendor_id', vendor_id);

                formData.append('status', $("#status-select").val());


                $.ajax({
                    url: "{{ route('vendors.statusupdate') }}",
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
                        $("#changeStatusId").modal('hide');

                        let status = data.status == 1 ? "Active" : "Inactive"

                        let status_btn = data.status == 1 ? 'btn btn-success' : 'btn btn-danger';


                        toastr.success(
                            "Status Updated Sucessfully"
                        );

                        $(`#statuschange${data.id}`).html(status);

                        $(`#statuschange${data.id}`).attr("class", status_btn);

                    },
                    error: function(xhr, status, error) {

                        if (xhr.status == 422) {
                            var errorMessageBrand = xhr.responseJSON.errormessage;

                            toastr.success(
                                "Somthing gets Wroung"
                            );

                            for (fieldName in errorMessageBrand) {

                                if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                    $(`[id="mesaurement_parameter_error_id"`).html(
                                        errorMessageBrand[
                                            fieldName][
                                            0
                                        ]);

                                }

                            }



                        }



                    }
                });





            });






        }
    </script>


@endsection
