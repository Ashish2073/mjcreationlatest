@extends('managedashboard.layout.main')
@section('title', 'Product List')
@section('content')




    <style>
        .error {
            color: #ff0000;
            display: block !important;
        }

        .fade-out {
            animation: fadeOut 2s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }
    </style>


    {{-- @include('managedashboard.layout.loader') --}}




    <div hidden id="productaddform">

        @include('managedashboard.product.add')
    </div>

    <div hidden id="producteditform">
    </div>



    <div id="productmaintable" class="container mt-5 table-responsive">



        <div class="content-header-right text-md-left  col-12">
            <div class="form-group">

                <button onclick="showAddForm()" class="btn-icon btn btn-primary btn-round btn-sm">
                    <i class="ti-plus"></i>
                </button>




            </div>
        </div>






        <div class="modal fade" id="productImagegallerymodel" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                    <th>SKU(Shope Kipping Unit)</th>
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
        dataTable();


        // 2 seconds



        function showAddForm() {
            $("#productaddform").removeAttr('hidden');
            $("#productmaintable").attr('hidden', 'true');
        }

        function hideAddForm() {

            for (let i = 0; i <= productpricedetailId; i++) {

                $(`[id="product_measurment_price_detail.${i}.measurment_quantity"]`).html(" ");
                $(`[id="product_measurment_price_detail.${i}.stock"]`).html(" ");
                $(`[id="product_measurment_price_detail.${i}.price"]`).html(" ");
                $(`[id="product_measurment_price_detail.${i}.currency"]`).html(" ");

            }

            for (let k = 0; k <= productspecification; k++) {

                console.log($(`[id="product_specification.${k}.heading"]`).html());
                $(`[id="product_specification.${k}.heading"]`).html(" ");
                $(`[id="product_specification.${k}.detail"]`).html(" ");
                $(`[id="product_specification.${k}.name"]`).html(" ");


            }


            $("#product_category").html(" ");
            $("#product_title").html(" ");
            $("#product_brand_id").html(" ");
            $("#product_quantity").html(" ");
            $("#product_discription").html(" ");
            $("#product_measurment_parameter").html(" ");
            $("#product_measurment_unit").html(" ")


            $("#productaddform").attr('hidden', 'true');
            $("#productmaintable").removeAttr('hidden');

        }

        function productForm() {

            $("#productformdiv").modal('show');

        }

        function showProductImage(id) {
            $('#productImagegallerymodel').modal('show');

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


        function hideEditForm() {

            $("#producteditform").attr('hidden', 'true');
            $("#productmaintable").removeAttr('hidden');

        }



        function editProduct(id, product_category_id) {

            let ProductId = id;

            let ProductCategoryId = product_category_id;

            $("#productaddform").attr('hidden', 'true');
            $("#producteditform").removeAttr('hidden');
            $("#productmaintable").attr('hidden', 'true');

            $.ajax({
                url: "{{ route('vendor.editproduct') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ProductId: ProductId,
                    ProductCategoryId: ProductCategoryId
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

                    $('#producteditform').html(data.responsehtml);








                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {




                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                    }













                }
            });





        }


        function deleteProduct(id) {
            let ProductId = id;


            $.ajax({
                url: "{{ route('vendor.deleteproduct') }}",
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


                    dataTable();

                    toastr.success(
                        "Product deleted Sucessfully"
                    )








                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {




                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                    }













                }
            });

        }



        function generatePDF(data) {
            var doc = new jsPDF();

            var yPosition = 10;

            data.forEach((item, index) => {
                // Add image if available
                if (item.product_image) {
                    var img = new Image();
                    img.src = item.product_image;

                    // Ensure the image is loaded before adding it to the PDF
                    img.onload = function() {
                        doc.addImage(this, 'JPEG', 10, yPosition, 50, 50);
                        addDataToPDF(doc, item, yPosition);
                        yPosition += 60; // Adjust vertical position
                        if (yPosition > 270) {
                            doc.addPage();
                            yPosition = 10;
                        }
                    };
                } else {
                    addDataToPDF(doc, item, yPosition);
                    yPosition += 20; // Adjust vertical position
                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 10;
                    }
                }
            });

            doc.save('table.pdf');
        }

        function addDataToPDF(doc, item, yPosition) {
            doc.text(item.product_title, 70, yPosition + 10);
            doc.text(item.product_total_stock_quantity, 120, yPosition + 10);
            doc.text(item.product_categories_name, 170, yPosition + 10);
            doc.text(item.brandname, 220, yPosition + 10);
            doc.text(item.created_date, 270, yPosition + 10);
        }






        function dataTable() {



            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            if ($.fn.DataTable.isDataTable('.data-table')) {
                $('.data-table').DataTable().destroy();
                $('.data-table').find('*').not('tbody').remove();
            }


            var table = $('.data-table').DataTable({



                dom: '<"top"lfB>rt<"bottom"ip><"clear">', // Add this line to enable buttons
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child):not(:nth-child(4))' // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child):not(:nth-child(4))' // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child):not(:nth-child(4))' // Exclude the action and product image columns
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 4, 5, 6] // Exclude the action and product image columns
                        },

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child):not(:nth-child(4))' // Exclude the action and product image columns
                        }
                    }
                ],

                stateSave: true,
                "bDestroy": true,
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
                        data: 'sku',
                        name: 'sku',
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
                        name: 'product_brands.name',
                        searchable: true

                    },


                    {
                        data: 'created_date',
                        name: 'created_date',
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
    </script>







    <script>
        $('#product_category_main_id').select2();
        $('#product_brand_main_id').select2();
        $('#product_measurment_parameter_main_id').select2();
        $('#product_measurment_unit_main').select2();
        $('#product_currency_type').select2();
        $('#product_specification_heading').select2();





        var specification_heading_html = $("#product_specification_heading").html();

        function isset(variable) {
            return typeof variable !== 'undefined' && variable !== null;
        }







        function removeElement(id) {



            $(`#${id}`).remove();
        }


        function removeElementProductPriceDetail(id) {
            productpricedetailId--;
            $(`#${id}`).remove();
        }

        function removeElementSpecfication(id) {
            productspecification--;
            $(`#${id}`).remove();

        }



        var product_desc;
        ClassicEditor.create(document.querySelector("#product_desc"), {
                ckfinder: {
                    uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                },
            })
            .then((newEditor) => {
                product_desc = newEditor;
            })
            .catch((error) => {
                console.error(error);
            });



        var product_warrenty;
        ClassicEditor.create(document.querySelector("#product_warrenty"), {
                ckfinder: {
                    uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                },
            })
            .then((newEditor) => {
                product_warrenty = newEditor;
            })
            .catch((error) => {
                console.error(error);
            });

        // var product_other_expenditure_resaon;
        // ClassicEditor.create(
        //         document.querySelector("#product_other_expenditure_resaon"), {
        //             ckfinder: {
        //                 uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
        //             },
        //         }
        //     )
        //     .then((newEditor) => {
        //         product_other_expenditure_resaon = newEditor;
        //     })
        //     .catch((error) => {
        //         console.error(error);
        //     });

        // var product_discount_detail;

        // ClassicEditor.create(document.querySelector("#product_discount_detail"), {
        //         ckfinder: {
        //             uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
        //         },
        //     })
        //     .then((newEditor) => {
        //         product_discount_detail = newEditor;
        //     })
        //     .catch((error) => {
        //         console.error(error);
        //     });

        // var product_specification_details;



        ClassicEditor.create(document.querySelector("#product_specification_details"), {
                ckfinder: {
                    uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                },
            })
            .then((newEditor) => {
                product_specification_details = newEditor;
            })
            .catch((error) => {
                console.error(error);
            });

        function previewBeforeUpload(id) {
            document.querySelector("#" + id).addEventListener("change", function(e) {
                if (e.target.files.length == 0) {
                    return;
                }
                var file = e.target.files[0];
                var url = URL.createObjectURL(file);
                document.querySelector("#" + id + "-preview div").innerText = file.name;
                document.querySelector("#" + id + "-preview img").src = url;
            });
        }


        var multipelimageId = 1;



        function addMoreImage() {
            multipelimageId++;


            var imageHTML = `<div class="form-element" id="imagecontainer${multipelimageId}" onclick="previewBeforeUpload('file-${multipelimageId}')">
                                <input type="file" name="product_image_gallery[]" id="file-${multipelimageId}"
                                    accept="image/*">
                                <label for="file-${multipelimageId}" id="file-${multipelimageId}-preview">
                                    <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                                    <div>
                                        <span>+</span>
                                       
                                    </div>
                                    <div>
                                    <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElement('imagecontainer${multipelimageId}',${multipelimageId})">-</span>
                               </div>
                                    </label>

                                
                                      
                                    
                              
                            </div>`;

            $(`#product_gallery`).append(imageHTML);
        }













        var multiplcolorimageId = 1;



        function addMoreColorImage(d) {

            console.log(d);

            var containerColorId = d;

            multiplcolorimageId++;

            var imagecolorHTML = `<div class="form-element" id="imagecontainer${containerColorId}${multiplcolorimageId}" onclick="previewBeforeUpload('file-${containerColorId}-${multiplcolorimageId}')">
                                        <input type="file" name="product_color_image_gallery[${containerColorId}][]" id="file-${containerColorId}-${multiplcolorimageId}"
                                            accept="image/*">
                                        <label for="file-${containerColorId}-${multiplcolorimageId}" id="file-${containerColorId}-${multiplcolorimageId}-preview">
                                            <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                                            <div>
                                                <span>+</span>
                                               
                                            </div>
                                            <div>
                                            <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElement('imagecontainer${containerColorId}${multiplcolorimageId}')">-</span>
                                       </div>
                                            </label>

                                        
                                              
                                            
                                      
                                    </div>`;


            $(`#product_color_gallery_${containerColorId}`).append(imagecolorHTML);
        }







        var addMoreImagefordiffentcolorContainerId = 0;

        function addMoreImagefordiffentcolorContainer() {

            addMoreImagefordiffentcolorContainerId++;

            var addMoreImagefordiffentcolorContainerHTML = `<div class="col-md-12 card py-4 mt-2" id="addMoreImagefordiffentcolorContainer${addMoreImagefordiffentcolorContainerId}">

                                                          <div class="col-md-12 pl-2">
                                                          <label for="inputAddress" class="form-label">Please select banner image of products</label>
                                                           <div class="form">
                                                           <div class="grid">
                                                            <div class="form-element" onclick=" previewBeforeUpload('file-color-banner${addMoreImagefordiffentcolorContainerId}')">
                                                                  <input type="file" name="product_color_banner_image[]" id="file-color-banner${addMoreImagefordiffentcolorContainerId}"   accept="image/*">
                                                                <label for="file-color-banner${addMoreImagefordiffentcolorContainerId}" id="file-color-banner${addMoreImagefordiffentcolorContainerId}-preview">
                                                                 <img src="{{ asset('img/imagepreviewupload.jpg') }}" alt="">
                                                                  <div>
                                                                  <span>+</span>
                                                              </div>
                                                             </label>
                                                 </div>
                                                 </div>
                                             </div>
                                             <div class="row">
                                             <div class="col-md-3 py-3">
                                                 <label for="product_color${addMoreImagefordiffentcolorContainerId}" class="form-label">Product color</label>
                                              <input type="text" name="product_color[]" class="form-control"
                                            id="product_color${addMoreImagefordiffentcolorContainerId}" autocompvare="off">
                                            <span id="product_color.${addMoreImagefordiffentcolorContainerId}" style="color: red;"></span>
                                           </div>

                                       



                                        </div>
                                     <div class="col-md-12 px-5 d-flex justify-content-end">
                                      <span class="btn btn-success btn-sm px-3" id="" onclick="addMoreColorImage(${addMoreImagefordiffentcolorContainerId})">+</span>
                            </div>
                           

                           <div class="row">
                         <div class="col-md-12 pl-2">
                               <label for="inputAddress" class="form-label">Please select Image</label>
                    <div class="form">

            <div class="grid" id="product_color_gallery_${addMoreImagefordiffentcolorContainerId}">
                <div class="form-element" onclick="previewBeforeUpload('file-color-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}')">
                    <input type="file" name="product_color_image_gallery[${addMoreImagefordiffentcolorContainerId}][]" id="file-color-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}"
                        accept="image/*">
                    <label for="file-color-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}" id="file-color-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}-preview">
                        <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                        <div>
                            <span>+</span>
                        </div>
                    </label>
                </div>


            </div>
        </div>
    </div>


</div>
<div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-danger btn-sm px-3" onclick="removeElement('addMoreImagefordiffentcolorContainer${addMoreImagefordiffentcolorContainerId}')">-</span>
                    </div>




</div>`;

            $("#addMoreImagefordiffentcolorContainer").append(addMoreImagefordiffentcolorContainerHTML);


        }











        // var imagecolorintialId = 1;

        // function addMoreImagefordiffentcolor() {
        //     imagecolorintialId++;

        //     var imageColorContainerHTML = `<div class="form-element" id="imagecontainer-color-${imagecolorintialId}" onclick="previewBeforeUpload('file-color-${imagecolorintialId}')">
    //                                 <input type="file" name="product_image_gallery[]" id="file-color-${imagecolorintialId}"
    //                                     accept="image/*">
    //                                 <label for="file-color-${imagecolorintialId}" id="file-color-${imagecolorintialId}-preview">
    //                                     <img src="{{ asset('img/imagepreviewupload.jpg') }}">
    //                                     <div>
    //                                         <span>+</span>

    //                                     </div>
    //                                     <div>
    //                                     <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElement('imagecontainer-color-${imagecolorintialId}')">-</span>
    //                                </div>
    //                                     </label>





    //                             </div>`;

        //     $("#product_color_gallery").append(imageColorContainerHTML);

        // }






        var discountcontainer = 1;
        var discounttextareacontainer = [];

        function addMoreDiscount() {
            discountcontainer++;

            var discontHTML = `  <div class="row" id="morediscountcontainer${discountcontainer}">   <div class="col-md-3 px-5">
                            <label for="discountname${discountcontainer}" class="form-label">Name</label>
                            <input type="text" id="discountname${discountcontainer}" class="form-control"
                                name="product_discount_name[]" autocompvare="off">
                        </div>

                        <div class="col-md-3 px-5">
                            <label for="discountpercentage${discountcontainer}" class="form-label">Amount(in percentage)</label>
                            <input type="text" id="discountpercentage${discountcontainer}" class="form-control"
                                name="product_discount_percentage[]" autocompvare="off">
                        </div>


                        <div class="col-md-3 px-5">
                            <label for="product_discount_start_date${discountcontainer}" class="form-label">start Date</label>
                            <input type="date" class="form-control" name="product_discount_start_date[]"
                                id="product_discount_start_date${discountcontainer}" autocompvare="off">
                        </div>
                        <div class="col-md-3 px-5">
                            <label for="product_discount_end_date${discountcontainer}" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="product_discount_end_date[]"
                                id="product_discount_end_date${discountcontainer}" autocompvare="off">
                        </div>

                        <div class="col-md-9 px-5">
                            <label for="inputAddress" class="form-label">Deatls</label>
                            <div class="form-floating">
                                <textarea class="form-control editor" name="product_discount_detail[]" placeholder="Leave a comment here"
                                    id="product_discount_details_editor${discountcontainer}" style="height: 100px"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-danger btn-sm px-3" onclick="removeElement('morediscountcontainer${discountcontainer}')">-</span>
                    </div>
                        
                        
                        </div>
                     
                        
                        `;

            $("#product_dicount_container").append(discontHTML);

            ClassicEditor.create(
                    document.querySelector(
                        `#product_discount_details_editor${discountcontainer}`
                    ), {
                        ckfinder: {
                            uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                        },
                    }
                )
                .then((newEditor) => {
                    discounttextareacontainer.push(newEditor);
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        var productspecification = 0;

        var productSpecficationTextarea = [];

        function addMoreProductspecification() {
            productspecification++;

            var specificationHTML = `  <div class="row" id="productspecification${productspecification}">
                           <div class="col-md-6 px-5 mt-5" id="specification_heading${productspecification}">
                            <label for="product_specification_heading${productspecification}" class="form-label">Specification Heading</label>
                            <select id="product_specification_heading${productspecification}" name="product_specification[${productspecification}][heading]"
                                class="form-select ">
                            ${ specification_heading_html}
                            </select>
                            <span id="product_specification.${productspecification}.heading" style="color: red;"></span>
                            </div>
                          <div class="col-md-6 px-5 mt-5" >
                          
                            <label for="product_specfication${productspecification}" class="form-label">Name</label>
                            <input type="text" name="product_specification[${productspecification}][name]" class="form-control"
                                id="product_specfication${productspecification}" autocompvare="off">
                                <span id="product_specification.${productspecification}.name" style="color: red;"></span>
                        </div>
                        
                        <div class="col-md-12 px-5">
                           
                            <label for="product_specification_details${productspecification}" class="form-label">Detail</label>
                            <div class="form-floating">
                            <textarea class="form-control" name="product_specification[${productspecification}][detail]" placeholder="Leave a comment here"
                                id="product_specification_details${productspecification}" style="height: 100px"></textarea>
                                <span id="product_specification.${productspecification}.detail" style="color: red;"></span>
                                </div>
                        
                        <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-danger btn-sm px-3" onclick="removeElementSpecfication('productspecification${productspecification}')">-</span>
                    </div>
                        

                    </div>`;

            $("#productspecfictaioncontainer").append(specificationHTML);
            $(`#product_specification_heading${productspecification}`).select2();


            ClassicEditor.create(
                    document.querySelector(
                        `#product_specification_details${productspecification}`
                    ), {
                        ckfinder: {
                            uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                        },
                    }
                )
                .then((newEditor) => {
                    productSpecficationTextarea.push(newEditor);
                })
                .catch((error) => {
                    console.error(error);
                });


        }

        var colorStockContainerIndex = 0;

        function addMoreColorStockMeasurmentFiled() {
            colorStockContainerIndex++;
            var colorStcokHtml = `
            <div class="row" id="colorstockcontainer${colorStockContainerIndex}">
            <div class="col-md-5 py-3">
                                            <label for="product_color_type" class="form-label">Color
                                                (optional)</label>
                                            <input id="product_color_type${colorStockContainerIndex}" name="product_measurment_price_detail[0][color][]"
                                                class="form-control"/>
                                        </div>

                                        <div class="col-md-5 py-3">
                                            <label for="product_stock_quantity" class="form-label">Product Stock
                                                Color wise (optional)</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[0][stock_color_wise][]"
                                                class="form-control" id="product_stock_quantity" autocompvare="off">
                                        </div>

                                        <div class="col-md-2 py-3">
                                            
                                               
                                                    <span class="btn btn-danger btn-sm px-3" onclick="removeElement('colorstockcontainer${colorStockContainerIndex}')">-</span>
                                                    
                                         
                                        </div></div>`;
            $('#colorstock').append(colorStcokHtml);



        }

        var newColorStockIndex = 0;

        function addNewMoreColorStockMeasurmentFiled(colorStockIndex) {

            newColorStockIndex++;
            var colorNewStockHtml = `  
            <div class="row" id="colorstockcontainer${colorStockIndex}${newColorStockIndex}">
            <div class="col-md-5 py-3">
                                            <label for="product_color_type${colorStockIndex}${newColorStockIndex}" class="form-label">Select color
                                                (optional)</label>
                                            <input id="product_color_type${colorStockIndex}${newColorStockIndex}" name="product_measurment_price_detail[${colorStockIndex}][color][]"
                                                class="form-control"/>
                                        </div>

                                        <div class="col-md-5 py-3">
                                            <label for="product_stock_quantity${colorStockIndex}${newColorStockIndex}" class="form-label">Product Stock
                                                Color wise (optional)</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[${colorStockIndex}][stock_color_wise][]"
                                                class="form-control" id="product_stock_quantity${colorStockIndex}${newColorStockIndex}" autocompvare="off">
                                        </div>

                                        
                                            <div class="col-md-2 py-3">
                                               
                                                    <span class="btn btn-danger btn-sm px-3" onclick="removeElement('colorstockcontainer${colorStockIndex}${newColorStockIndex}')">-</span>
                                        
                                        </div>`;
            $(`#newcolorstockcontainer${colorStockIndex}`).append(colorNewStockHtml);


        }





        var productpricedetailId = 0;

        function productpricedetail() {
            productpricedetailId++;

            var productpricedetailHTML = `<div class="row" id="productpricecontainer${productpricedetailId}">
    <div class="col-md-3 py-3">
        <label for="product_measurment_quantity${productpricedetailId}" class="form-label">Product
            Measurment Quantity</label>
        <input type="text" name="product_measurment_price_detail[${productpricedetailId}][measurment_quantity]"
            class="form-control" id="product_measurment_quantity${productpricedetailId}" autocomplete="off">
        <span id="product_measurment_price_detail.${productpricedetailId}.measurment_quantity"
            style="color: red;"></span>


    </div>
    <div class="col-md-3 py-3">
        <label for="product_measurment_quantity_price${productpricedetailId}" class="form-label">Price(MRP)</label>
        <input type="number" name="product_measurment_price_detail[${productpricedetailId}][price]"
            class="form-control" id="product_measurment_quantity_price${productpricedetailId}" autocomplete="off">
        <span id="product_measurment_price_detail.${productpricedetailId}.price" style="color: red;"></span>

    </div>



    <div class="col-md-3 py-3">
        <label for="product_currency_type${productpricedetailId}" class="form-label">Currency Type</label>
        <select id="product_currency_type${productpricedetailId}"
            name="product_measurment_price_detail[${productpricedetailId}][currency]" class="form-select">
            <option selected disabled> Please Select Currency type</option>
            <option value="inr">INR</option>
            <option value="usd">USD</option>

        </select>
        <span id="product_measurment_price_detail.${productpricedetailId}.currency" style="color: red;"></span>
    </div>



    <div class="col-md-3 py-3">
        <label for="product_stock_quantity${productpricedetailId}" class="form-label">Product Stock
            Quantity</label>
        <input type="number" name="product_measurment_price_detail[${productpricedetailId}][stock]"
            class="form-control" id="product_stock_quantity${productpricedetailId}" autocompvare="off">
        <span id="product_measurment_price_detail.${productpricedetailId}.stock" style="color: red;"></span>
    </div>

    <div id="newcolorstockcontainer${productpricedetailId}">
        <div class="row" id="colorstock${productpricedetailId}">
            <div class="col-md-5 py-3">
                <label for="product_new_color_type${productpricedetailId}" class="form-label">Select color
                    (optional)</label>
                <input type="text" id="product_new_color_type${productpricedetailId}"
                    name="product_measurment_price_detail[${productpricedetailId}][color][]" class="form-control" />
            </div>

            <div class="col-md-5 py-3">
                <label for="product_stock_quantity${productpricedetailId}" class="form-label">Product Stock
                    Color wise (optional)</label>
                <input type="number"
                    name="product_measurment_price_detail[${productpricedetailId}][stock_color_wise][]"
                    class="form-control" id="product_stock_quantity${productpricedetailId}" autocompvare="off">
            </div>


            <div class="col-md-2 py-3">
                <span class="btn btn-success btn-sm px-3"
                    onclick="addNewMoreColorStockMeasurmentFiled(${productpricedetailId})">+</span>

            </div>

        </div>
    </div>








    <div class="col-md-12 px-5 d-flex justify-content-end">
        <span class="btn btn-danger btn-sm px-3"
            onclick="removeElementProductPriceDetail('productpricecontainer${productpricedetailId}')">-</span>
    </div>

</div>`;



            $("#productpricecontainer").append(productpricedetailHTML);


            $(`#product_currency_type${productpricedetailId}`).select2();

            $(`#product_new_color_type${productpricedetailId}`).select2();

        }



        var otherExpendureId = 1;

        var otherExpendureCostTextarea = [];

        function addOtherExpendureCost() {
            otherExpendureId++;
            var otherExpendureHTML = ` <div class="row" id="otherexpendurecost${otherExpendureId}">
                        <div class="col-md-3 px-5 mt-5">
                            <label for="inputAddress" name="product_other_expenditure[]"
                                class="form-label">Name</label>
                            <input type="text" class="form-control" id="" autocompvare="off">
                        </div>
                        <div class="col-md-3 px-5 mt-5">
                            <label for="inputAddress" class="form-label">Price</label>
                            <input type="text" class="form-control" name="product_other_price[]" id=""
                                autocompvare="off">
                        </div>

                        <div class="col-md-3 px-5 mt-5">
                            <label for="inputAddress" class="form-label">Currency Type</label>
                            <select id="product_other_expenditure_currency_type${otherExpendureId}" name="product_other_expenditure_currency_type[]" class="form-select">
                                <option selected disabled> Unit</option>
                                <option value="inr">INR</option>
                                <option value="usd">USD</option>

                            </select>
                        </div>

                        <div class="col-md-9 px-5 mt-5">
                            <label for="inputAddress" class="form-label">Reason</label>
                            <div class="form-floating">
                                <textarea class="form-control" id="product_other_expenditure_resaon${otherExpendureId}" name="product_other_expenditure_resaon[]" placeholder="Leave a comment here"
                                    id="floatingTextarea2" style="height: 100px"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-danger btn-sm px-3" onclick="removeElement('otherexpendurecost${otherExpendureId}')">-</span>
                    </div>

                    </div>`;

            $("#otherexpendure").append(otherExpendureHTML);

            $(`#product_other_expenditure_currency_type${otherExpendureId}`).select2();

            ClassicEditor.create(
                    document.querySelector(
                        `#product_other_expenditure_resaon${otherExpendureId}`,

                        {
                            ckfinder: {
                                uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                            },
                        }
                    )
                )
                .then((newEditor) => {
                    otherExpendureCostTextarea.push(newEditor);
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        function selectSubproductcategory(selectElement) {





            var selectedvalue = selectElement.value;
            var selectedtext = selectElement.options[selectElement.selectedIndex].text;

            // var containers = document.querySelectorAll('.select-container');

            $.ajax({
                url: "{{ route('vendors-subproduct-categories') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    selectedvalue: selectedvalue,
                    selectedtext: selectedtext,
                },
                beforeSend: function() {
                    $("#loader").html("<div></div>");

                    $("#main_content").attr("class", "demo");

                    var selectedParentElementId = selectElement.parentElement.id;
                    var divsToRemove = $(`#${selectedParentElementId}`).nextAll("div");

                    if (divsToRemove.length > 0) {
                        // Remove all subsequent div elements
                        divsToRemove.remove();
                    }
                },
                success: (data) => {
                    $("#loader").html("");
                    $("#main_content").removeAttr("class", "demo");

                    $("#productcategoryelement").append(data.responsehtml);
                    $(`#${data.id}`).select2();
                },
                error: (error) => {},
            });
        }




        $("#savevendorproduct").on("click", function(e) {
            e.preventDefault();

            var formData = new FormData($("#vendorform")[0]);



            formData.append("product_discription", product_desc.getData());
            formData.append("product_warrenty", product_warrenty.getData());

            // formData.append(
            //     "product_other_expenditure_resaon[0]",
            //     product_other_expenditure_resaon.getData()
            // );
            // var otherExpendureCostTextareaLength = otherExpendureCostTextarea.length;
            // for (var i = 1; i <= otherExpendureCostTextareaLength; i++) {
            //     formData.append(
            //         `product_other_expenditure_resaon[${i}]`,
            //         otherExpendureCostTextarea[i - 1].getData()
            //     );
            // }

            // formData.append(
            //     "product_discount_detail[0]",
            //     product_discount_detail.getData()
            // );
            // var discounttextareacontainerLength = discounttextareacontainer.length;
            // for (var i = 1; i <= discounttextareacontainerLength; i++) {
            //     formData.append(
            //         `product_discount_detail[${i}]`,
            //         discounttextareacontainer[i - 1].getData()
            //     );
            // }



            formData.append(
                "product_specification[0][detail]",
                product_specification_details.getData()
            );
            var productSpecficationTextareaLength = productSpecficationTextarea.length;
            for (var i = 1; i <= productSpecficationTextareaLength; i++) {
                formData.append(
                    `product_specification[${i}][detail]`,
                    productSpecficationTextarea[i - 1].getData()
                );
            }


            var product_baneer_image = $('input[name="product_banner_image"]')[0].files;

            for (var i = 0; i < product_baneer_image.length; i++) {
                var file = product_baneer_image[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    formData.append("product_banner_image", e.target.result);
                };

                reader.readAsDataURL(file);
            }

            var product_image_gallery = $('input[name="product_image_gallery[]"]')[0]
                .files;

            for (var i = 0; i < product_image_gallery.length; i++) {
                var file = product_image_gallery[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    formData.append("product_image_gallery[]", e.target.result);
                };

                reader.readAsDataURL(file);
            }

            var product_color_image_banner = $('input[name="product_color_banner_image[]"]')[0]
                .files;


            for (let i = 0; i < product_color_image_banner.length; i++) {

                var file = product_color_image_banner[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    formData.append("product_color_image_banner[]", e.target.result);
                };

                reader.readAsDataURL(file);
            }







            let product_color_gallery_image_new = [];
            let product_color_new_index = 0;
            for (let i = 0; i < addMoreImagefordiffentcolorContainerId; i++) {

                if (isset($(`input[name="product_color_image_gallery[${i}][]"]`))) {


                    let product_color_image_gallery_data = $(`input[name="product_color_image_gallery[${i}][]"]`)[0]
                        .files;
                    let product_color_image_gallery_data_length = product_color_image_gallery_data.length;

                    for (let j = 0; j < product_color_image_gallery_data_length; j++) {

                        var file = product_color_image_gallery_data[j];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            formData.append(`product_color_image_banner[${product_color_new_index}][]`, e.target
                                .result);
                        };

                        reader.readAsDataURL(file);


                    }

                    product_color_new_index++;


                }




            }









            formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

            $.ajax({
                url: "{{ route('vendor-saveproduct') }}",
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
                    $("#loader").html("<div></div>");

                    $("#main_content").attr("class", "demo");

                    for (let i = 0; i <= productpricedetailId; i++) {

                        $(`[id="product_measurment_price_detail.${i}.measurment_quantity"]`).html(" ");
                        $(`[id="product_measurment_price_detail.${i}.stock"]`).html(" ");
                        $(`[id="product_measurment_price_detail.${i}.price"]`).html(" ");
                        $(`[id="product_measurment_price_detail.${i}.currency"]`).html(" ");

                    }

                    for (let k = 0; k <= productspecification; k++) {

                        console.log($(`[id="product_specification.${k}.heading"]`).html());
                        $(`[id="product_specification.${k}.heading"]`).html(" ");
                        $(`[id="product_specification.${k}.detail"]`).html(" ");
                        $(`[id="product_specification.${k}.name"]`).html(" ");


                    }


                    $("#product_category").html(" ");
                    $("#product_title").html(" ");
                    $("#product_brand_id").html(" ");
                    $("#product_quantity").html(" ");
                    $("#product_discription").html(" ");
                    $("#product_measurment_parameter").html(" ");
                    $("#product_measurment_unit").html(" ");










                },
                success: (data) => {
                    toastr.success(
                        "Product Added Sucessfully"
                    );


                    $("#loader").html("");
                    $("#main_content").removeAttr("class", "demo");
                    hideAddForm();
                    dataTable();

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {







                        errorMessage = xhr.responseJSON.errormessage;

                        console.log(errorMessage);


                        for (var fieldName in errorMessage) {

                            if (errorMessage.hasOwnProperty(fieldName)) {
                                $(`[id="${fieldName}"]`).html(errorMessage[fieldName][0]);
                            }

                        }

                        toastr.error(
                            "Somthing get wroung"
                        );


                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');


                    }













                }
            });
        });
    </script>

    <script>
        function showImage() {


            let reader = new FileReader();
            reader.readAsDataURL($('input[name="brandImage"]')[0].files[0]);
            reader.onload = function(e) {
                $("#brandimagepreviewupload").addClass("show");
                $("#brandimagepreviewupload").attr("src", e.target.result);


            };
        }

        $('#openModalButton').on('click', function() {

            $('#myModal').modal('show');
            $('#exampleModalLabel').html('Add New Brand');


            $('#submitBrandAddForm').on('click', function() {



                // const imageUploader = document.querySelector("input");
                // const imagePreview = document.querySelector("img");


                var formData = new FormData();

                formData.append('brandName', $('#brandName').val());

                formData.append('brandImage', $('input[name="brandImage"]')[0].files[0]);







                $.ajax({
                    url: "{{ route('vendors.addbrandname') }}",
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
                        $("#loader").html("<div></div>");

                        $("#main_content").attr("class", "demo");
                    },

                    success: (data) => {



                        let brandOptionHtml =
                            `<option value="${data.brand.id}">${data.brand.name}</option>`;
                        $("#product_brand_main_id").append(brandOptionHtml);

                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                        $('#myModal').modal("hide");
                        toastr.success(
                            "brand add Sucessfully"
                        );







                    },
                    error: function(xhr, status, error) {

                        if (xhr.status == 422) {

                            console.log(xhr.responseJSON.errormessage.brandName[0]);

                            if (isset(xhr.responseJSON.errormessage.brandName[0])) {
                                $("#brandNameError").html(xhr.responseJSON.errormessage
                                    .brandName[0])
                            }

                            if (isset(xhr.responseJSON.errormessage.brandImage[0])) {
                                $("#brandImageError").html(xhr.responseJSON.errormessage
                                    .brandImage[0])

                            }

                            // toastr.error(
                            //     xhr.responseJSON.errormessage
                            // );
                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');
                            // $("#timer").val(2);
                            // otpFieldScript();
                            // otpLifeTime();
                            // otpvarification();

                        }













                    }
                });





            });






        });


        $('#openMeasurmentModalButton').on('click', function() {

            $('#myModalMeasurmentParameterName').modal('show');
            $('#exampleModalLabelMeasurmentParameterName').html('Add New MeasurMent Parameter');



            $('#submitMeasurementParameterForm').on('click', function() {

                var formData = new FormData();

                formData.append('measurment_parameter_name', $('#product_measurment_name_id').val());


                $.ajax({
                    url: "{{ route('product.addmeasurmentname') }}",
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
                        $("#loader").html("<div></div>");

                        $("#main_content").attr("class", "demo");
                    },

                    success: (data) => {



                        let OptionHtml =
                            `<option value="${data.parameter.id}">${data.parameter.name}</option>`;
                        $("#product_measurment_parameter_main_id").append(OptionHtml);

                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                        $('#myModalMeasurmentParameterName').modal("hide");
                        toastr.success(
                            "brand add Sucessfully"
                        );

                    },
                    error: function(xhr, status, error) {

                        if (xhr.status == 422) {
                            var errorMessageBrand = xhr.responseJSON.errormessage;

                            for (fieldName in errorMessageBrand) {

                                if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                    $(`[id="mesaurement_parameter_error_id"`).html(
                                        errorMessageBrand[
                                            fieldName][
                                            0
                                        ]);

                                }

                            }

                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');

                        }



                    }
                });





            });






        });


        $('#openMeasurmentUnitModalButton').on('click', function() {

            $('#myModalMeasurmentParameterUnitName').modal('show');
            $('#exampleModalLabelMeasurmentParameterUnitName').html('Add New MeasurMent Parameter Unit');



            $('#submitMeasurementParameterUnitForm').on('click', function() {

                var formData = new FormData();

                formData.append('measurment_parameter_unit_name', $('#product_measurment_unit_name_id')
                    .val());


                $.ajax({
                    url: "{{ route('product.addmeasurmentunitname') }}",
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
                        $("#loader").html("<div></div>");

                        $("#main_content").attr("class", "demo");
                    },

                    success: (data) => {



                        let OptionHtml =
                            `<option value="${data.parameter.id}">${data.parameter.name}</option>`;
                        $("#product_measurment_unit_main").append(OptionHtml);

                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                        $('#myModalMeasurmentParameterUnitName').modal("hide");
                        toastr.success(
                            "Product Unit add Sucessfully"
                        );

                    },
                    error: function(xhr, status, error) {

                        if (xhr.status == 422) {
                            var errorMessageBrand = xhr.responseJSON.errormessage;

                            for (fieldName in errorMessageBrand) {

                                if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                    $(`[id="mesaurement_parameter_unit_error_id"`).html(
                                        errorMessageBrand[
                                            fieldName][
                                            0
                                        ]);

                                }

                            }

                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');

                        }



                    }
                });





            });






        });



        $('#openSpecificationHeadingModalButton').on('click', function() {

            $('#myModalSpecificationHeading').modal('show');
            $('#exampleModalSpecificHeading').html('Add New  Specification Heading');



            $('#submitSpecificationForm').on('click', function() {

                var formData = new FormData();

                formData.append('product_specification_heading_name', $(
                        '#product_specification_heading_name_id')
                    .val());


                $.ajax({
                    url: "{{ route('product.addspecificationheading') }}",
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
                        $("#loader").html("<div></div>");

                        $("#main_content").attr("class", "demo");
                    },

                    success: (data) => {



                        let OptionHtml =
                            `<option value="${data.parameter.id}">${data.parameter.name}</option>`;
                        $("#product_specification_heading").append(OptionHtml);

                        console.log(specification_heading_html);

                        specification_heading_html = specification_heading_html + OptionHtml;

                        console.log(specification_heading_html);

                        if (isset(productspecification)) {
                            for (let i = 0; i <= productspecification; i++) {
                                $(`#product_specification_heading${i}`).append(OptionHtml);



                            }
                        }




                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                        $('#myModalSpecificationHeading').modal("hide");
                        toastr.success(
                            "Heading  add Sucessfully"
                        );

                    },
                    error: function(xhr, status, error) {

                        if (xhr.status == 422) {
                            var errorMessageBrand = xhr.responseJSON.errormessage;

                            for (fieldName in errorMessageBrand) {

                                if (errorMessageBrand.hasOwnProperty(fieldName)) {



                                    $(`[id="product_specification_heading_error_id"`).html(
                                        errorMessageBrand[
                                            fieldName][
                                            0
                                        ]);

                                }

                            }

                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');

                        }



                    }
                });





            });






        });
    </script>


@endsection
