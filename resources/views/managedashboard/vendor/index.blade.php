@extends('managedashboard.layout.main')
@section('title', 'Vendor Profile')
@section('content')

    <div id="productvendortable" class="container mt-5 table-responsive">
        @include('managedashboard.vendor.status')
        <table class="vendors-data-table table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Vendor Name</th>
                    <th>Vendor Email</th>
                    <th>Vendor Image</th>
                    <th>Status</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@endsection

@section('page-script')
    <script>
        $(document).ready(function() {

            vendorDetailsDataTable();
        });




        function vendorDetailsDataTable() {
            if ($.fn.DataTable.isDataTable('.vendors-data-table')) {
                $('.vendors-data-table').DataTable().clear().destroy();
            }

            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var table = $('.vendors-data-table').DataTable({
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
                    url: "{{ route('vendor.detail') }}",
                    type: "post",
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
                        searchable: false
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
                    }
                ],
                language: {
                    lengthMenu: "Show _MENU_ Entries per Page"
                }
            });
        };

        function changeStatus(id) {
            let vendor_id = id;

            $("#changeStatusId").modal('show');
            $('#savestauschanges').off('click').on('click', function(e) {
                e.preventDefault();
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
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: (data) => {
                        $("#changeStatusId").modal('hide');
                        let status = data.status == 1 ? "Active" : "Inactive";
                        let status_btn = data.status == 1 ? 'btn btn-success' : 'btn btn-danger';
                        toastr.success("Status Updated Successfully");
                        $(`#statuschange${data.id}`).html(status).attr("class", status_btn);
                    },
                    error: function(xhr) {
                        if (xhr.status == 422) {
                            var errorMessageBrand = xhr.responseJSON.errormessage;
                            toastr.error("Something went wrong");
                            for (fieldName in errorMessageBrand) {
                                if (errorMessageBrand.hasOwnProperty(fieldName)) {
                                    $(`[id="mesaurement_parameter_error_id"`).html(errorMessageBrand[
                                        fieldName][0]);
                                }
                            }
                        }
                    }
                });
            });
        }
    </script>
@endsection
