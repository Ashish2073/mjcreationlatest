@extends('managedashboard.layout.main')
@section('title', 'Product List')
@section('content')




    <style>
        .error {
            color: #ff0000;
            display: block !important;
        }
    </style>


    @include('managedashboard.layout.loader')








    <div class="container mt-5 table-responsive">





        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="prodcutImageGalleryDiv">

                    </div>

                </div>

            </div>
        </div>




        <table class="data-table table table-striped" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>No</th> --}}
                    <th>Sr No.</th>
                    <th>Product Title </th>
                    <th>Total Product Quantity</th>
                    <th>Product Image </th>

                    <th>Product Category </th>
                    <th>Brandname</th>
                    <th>Created at</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


@endsection

@section('page-script')

    <script>
        function showProductImage(id) {
            $('#myModal').modal('show');

            $("#productaddmodal").modal('show');
            let ProductId = id;
            console.log(ProductId);
            $.ajax({
                url: "{{ route('product.image') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ProductId: ProductId,
                },

                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },

                beforeSend: function() {
                    $("#loader").html("<div></div>");

                    $("#main_content").attr("class", "demo");
                },

                success: (data) => {





                    $('#loader').html('');
                    $('#main_content').removeAttr('class', 'demo');

                    $('#prodcutImageGalleryDiv').html(data.responsehtml);








                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {




                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                    }













                }
            });



        }




        $(function() {

            console.log('hello');

            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var table = $('.data-table').DataTable({



                processing: true,
                serverSide: true,
                fixedHeader: true,

                ajax: {
                    url: "{{ route('vendors.productlistshow') }}",
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
                        data: 'product_title',
                        name: 'product_title',
                        searchable: true
                    },
                    {
                        data: 'product_total_stock_quantity',
                        name: 'product_total_stock_quantity',
                        searchable: true
                    },
                    {

                        data: 'product_image',
                        name: 'product_image',
                        orderable: false,
                        searchable: false,

                    },
                    {
                        data: 'product_categories_name',
                        name: 'product_categories.name',
                        searchable: true

                    },
                    {
                        data: 'brandname',
                        name: 'productbrands.name',
                        searchable: true

                    },


                    {
                        data: 'created_at',
                        name: 'created_at',
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
                    // Customization for the "Entries per page" text
                    lengthMenu: "Show _MENU_ Entries per Page"
                }


            });



        });
    </script>

@endsection
