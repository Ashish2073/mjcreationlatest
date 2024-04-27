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

        <table class="data-table table table-striped" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>No</th> --}}
                    <th>Product Title </th>
                    <th>Total Product Quantity</th>

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


                ]


            });



        });
    </script>

@endsection
