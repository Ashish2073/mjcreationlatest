<style>
    .form {
        margin: 80px 0px 20px;
        padding: 0px 50px;
    }

    .form h2 {
        text-align: center;
        color: #acacac;
        font-size: 40px;
        font-weight: 400;
    }

    .form .grid {
        margin-top: 50px;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form .grid .form-element {
        width: 200px;
        height: 200px;
        box-shadow: 0px 0px 20px 5px rgba(100, 100, 100, 0.1);
    }

    .form .grid .form-element input {
        display: none;
    }

    .form .grid .form-element img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .form .grid .form-element div {
        position: relative;
        height: 40px;
        margin-top: -40px;
        background: rgba(0, 0, 0, 0.5);
        text-align: center;
        line-height: 40px;
        font-size: 13px;
        color: #f5f5f5;
        font-weight: 600;
    }

    .form .grid .form-element div span {
        font-size: 40px;
    }

    /* accordian css */
</style>


@include('managedashboard.layout.loader')



<section id="main_content">


    <div class="content-header-left text-md-left position-absolute right-5 mt-4">
        <div class="form-group">
            <button onclick="hideEditForm()" style="width: 55px;height:50px"
                class="btn-icon btn btn-danger btn-round btn-sm">
                <i class="ti-close"></i>
            </button>
        </div>
    </div>




    <div class="container py-3">


        <div class="row py-4">
            <div class="col-md-12 d-flex justify-content-between">
                <strong>Product</strong>
                {{-- <button class="btn btn-success btn-sm ">Add More Product</button> --}}
            </div>
        </div>
        <form class="row g-3" id="vendorform" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row" id="productcategoryelementedit">
                    <div class="col-md-4" id="main_product_category_edit">
                        <label for="product_category" class="form-label">Category</label>
                        <select name="product_category[]" id="product_category_main"
                            onchange="selectSubproductcategory(this)" class="form-select product_category_main"
                            aria-label="Default select example">

                            <option selected disabled>Open this select menu</option>
                            @foreach ($product_category as $data)
                                <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                            @endforeach
                        </select>
                        <span id="product_category" style="color: red;"></span>



                    </div>



                    <div class="col-md-4" id="{{ $product_sub_category_by_id->name }}">
                        <label for="product_category"
                            class="form-label">{{ ucwords($product_sub_category_by_id->name) }}</label>
                        <select name="product_category[]" id="" onchange="selectSubproductcategory(this)"
                            class="form-select product_category_main" aria-label="Default select example">

                            <option selected disabled>Open this select menu</option>
                            @foreach ($product_sub_category as $data)
                                <option @if ($product_sub_category_by_id->id == $data->id) selected @endif value="{{ $data->id }}">
                                    {{ ucwords($data->name) }}</option>
                            @endforeach
                        </select>
                        <span id="product_category" style="color:red"></span>



                    </div>




                </div>







            </div>


            @foreach ($vendorProducts as $productdata)
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="product_title" class="form-control" id="inputEmail4"
                                value="{{ $productdata->product_title }}" autocomplete="off">

                            <span id="product_title" style="color: red;"></span>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">




                        @include('managedashboard.product.brand', [
                            'modal_id' => 'myModalEdit',
                            'modal_label' => 'exampleModalLabelEdit',
                            'select_id' => 'product_brand_main_edit_id',
                            'productbranddataid' => $productdata->brandsid,
                            'submitbrandformid' => 'submitBrandEditForm',
                            'brandname' => 'brandNameEdit',
                            'brandnameerror' => 'brandNameEditError',
                            'brandimage' => 'brandImageEdit',
                            'brandImagepreviewupload' => 'brandImageEditpreviewupload',
                            'brandImageediterror' => 'brandImageEditError',
                            'selectbranderrorid' => 'product_brand_edit_id',
                        ]);





                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Product Quantity</label>
                            <input type="number" name="product_quantity" class="form-control" id="inputEmail4"
                                value="{{ $productdata->product_total_stock_quantity }}" autocomplete="off">

                            <span id="product_quantity" style="color: red;"></span>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <label for="product_desc_edit" class="form-label">Discription</label>
                    <div class="form-floating">
                        <textarea class="form-control" id="product_desc_edit" name="product_desc" placeholder="Leave a comment here"
                            style="height: 100px">{{ $productdata->discription }}</textarea>
                        <span id="product_discription" style="color: red;"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="product_warrenty_edit" class="form-label">Poduct Warranty Deatails(optional)</label>
                    <div class="form-floating">
                        <textarea class="form-control" id="product_warrenty_edit" name="product_warrenty" placeholder="Leave a comment here"
                            style="height: 100px">{{ $productdata->product_warrenty }}</textarea>
                    </div>
                </div>






                <h4> Product measurment and price detail</h4>

                <div class="col-md-12 card py-4">
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Product Measurment Parameter</label>
                            <select id="product_measurment_parameter_main_edit_id" name="product_measurment_parameter"
                                class="form-select">
                                <option selected disabled> Please Select Parameter</option>
                                <option value="length">Length</option>
                                <option value="weight">Weight</option>
                                <option value="display">Display</option>
                            </select>

                            <span id="product_measurment_parameter" style="color: red;"></span>
                        </div> --}}


                        @include('managedashboard.product.measurmentparameter', [
                            'modal_id' => 'myModalMeasurmentParameterNameEdit',
                            'modal_label' => 'exampleModalLabelMeasurmentParameterNameEdit',
                            'select_id' => 'product_measurment_parameter_main_edit_id',
                            'selectdata' => $productmeasurmentname,
                            'selectedid' => $productdata->measurment_parameter_name,
                            'submitbtnid' => 'submitMeasurementParameterFormEdit',
                            'input_name' => 'measurment_parameter_name',
                            'input__id' => 'product_measurment_name_edit_id',
                            'type' => 'text',
                            'span_error_id' => 'mesaurement_parameter_error_edit_id',
                            'openModalButton' => 'openMeasurmentModalButtonEdit',
                            'select_name' => 'product_measurment_parameter',
                            'select_label' => 'Product Measurment Parameter',
                            'seletspanerror' => 'product_measurment_parameter_edit',
                        ])








                        {{-- <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Product Measurment Parameter Unit</label>
                            <select id="product_measurment_unit_main_edit" name="product_measurment_unit"
                                class="form-select">
                                <option selected disabled> Unit</option>
                                <option value="m">Meter</option>
                                <option value="gm">Gm</option>
                                <option value="inc">Inch</option>
                            </select>
                            <span id="product_measurment_unit" style="color: red;"></span>
                        </div> --}}


                        @include('managedashboard.product.measurmentparameter', [
                            'modal_id' => 'myModalMeasurmentParameterUnitEdit',
                            'modal_label' => 'exampleModalLabelMeasurmentParameterUnitEdit',
                            'select_id' => 'product_measurment_unit_main_edit',
                            'selectdata' => $productmeasurmentunitname,
                            'selectedid' => $productdata->measurment_unit_name,
                            'submitbtnid' => 'submitMeasurementParameterUnitFormEdit',
                            'input_name' => 'measurment_parameter_unit_name',
                            'input__id' => 'product_measurment_unit_name_edit_id',
                            'type' => 'text',
                            'span_error_id' => 'mesaurement_parameter_unit_error_edit_id',
                            'openModalButton' => 'openMeasurmentUnitModalButtonEdit',
                            'select_name' => 'product_measurment_unit',
                            'select_label' => 'Product Measurment Unit',
                            'seletspanerror' => 'product_measurment_unit_edit',
                        ])



                        <div class="row g-3 form-group">
                            <div class="col-md-12 card " id="productpricecontaineredit">
                                <div class="col-md-12 py-4 d-flex justify-content-end">
                                    <span class="btn btn-success btn-sm px-3" onclick="productpricedetail()">+</span>
                                </div>
                                @foreach ($productpricedetails as $k => $productpricedata)
                                    <div class="row">
                                        <div class="col-md-3 py-3">
                                            <label for="inputAddress"
                                                id="product_measurment_quantity{{ $k }}"
                                                class="form-label">Product
                                                Measurment Quantity</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[{{ $k }}][measurment_quantity]"
                                                value="{{ $productpricedata->measurment_quantity }}"
                                                class="form-control" id="product_measurment_quantity"
                                                autocomplete="off">
                                            <span
                                                id="product_measurment_price_detail.{{ $k }}.measurment_quantity"
                                                style="color: red;"></span>
                                        </div>
                                        <div class="col-md-3 py-3">
                                            <label for="inputAddress" id="product_measurment_quantity_price"
                                                class="form-label">Price(MRP)</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[{{ $k }}][price]"
                                                value="{{ $productpricedata->price }}" class="form-control"
                                                id="" autocomplete="off">
                                            <span id="product_measurment_price_detail.{{ $k }}.price"
                                                style="color: red;"></span>
                                        </div>




                                        <div class="col-md-3 py-3">
                                            <label for="inputcurrency" class="form-label ">Currency Type</label>
                                            <select id="product_currency_type_edit{{ $k }}"
                                                name="product_measurment_price_detail[{{ $k }}][currency]"
                                                class="form-select ">
                                                <option selected disabled> Please Select Currency type</option>
                                                <option @if ($productpricedata->currency == 'inr') selected @endif
                                                    value="inr">INR</option>
                                                <option @if ($productpricedata->currency == 'usd') selected @endif
                                                    value="usd">USD</option>

                                            </select>
                                            <span id="product_measurment_price_detail.{{ $k }}.currency"
                                                style="color: red;"></span>
                                        </div>



                                        <div class="col-md-3 py-3">
                                            <label for="product_stock_quantity" class="form-label">Product Stock
                                                Quantity</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[{{ $k }}][stock]"
                                                value="{{ $productpricedata->stock }}" class="form-control"
                                                id="product_stock_quantity" autocompvare="off">
                                            <span id="product_measurment_price_detail.{{ $k }}.stock"
                                                style="color: red;"></span>
                                        </div>

                                        @php $productColor=json_decode($productpricedata->color, true); @endphp

                                        <div id="colorstock">
                                            @for ($c = 0; $c < count($productColor); $c++)
                                                <div class="row" id="colorstockcontainer{{ $k }}">
                                                    <div class="col-md-5 py-3">
                                                        <label for="inputcurrency" class="form-label">Select color
                                                            (optional)
                                                        </label>
                                                        <select id="product_color_type_edit{{ $k }}"
                                                            name="product_measurment_price_detail[{{ $k }}][color][]"
                                                            class="form-select">
                                                            <option selected> Please select option</option>
                                                            <option value="red">Red</option>
                                                            <option value="green">Green</option>

                                                        </select>
                                                    </div>



                                                    <div class="col-md-5 py-2">
                                                        <label for="product_stock_quantity" class="form-label">Product
                                                            Stock
                                                            Color wise (optional)</label>
                                                        <input type="number"
                                                            name="product_measurment_price_detail[{{ $k }}][stock_color_wise][]"
                                                            class="form-control"
                                                            id="product_stock_quantity{{ $k }}"
                                                            autocompvare="off">
                                                    </div>

                                                    <div class="col-md-2 py-3">

                                                        <span class="btn btn-success btn-sm "
                                                            onclick="addMoreColorStockMeasurmentFiled()">+</span>


                                                    </div>

                                                </div>
                                            @endfor
                                        </div>





                                    </div>
                                @endforeach

                            </div>

                        </div>



                    </div>


                </div>




                <h4 class="mt-5">Specification</h4>
                <div class="col-md-12 card py-4" id="productspecfictaioncontaineredit">
                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreProductspecification()">+</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 px-5" id="specification_heading_edit">
                            <label for="product_specification_heading_edit" class="form-label">Specification
                                Heading</label>
                            <select id="product_specification_heading_edit" name="product_specification[0][heading]"
                                class="form-select ">
                                <option selected disabled>Please Select heading</option>
                                @foreach ($product_specification_heading_edit as $data)
                                    <option value="{{ $data->name }}">{{ ucwords($data->name) }}</option>
                                @endforeach


                            </select>
                            <span id="product_specification.0.heading" style="color: red;"></span>
                        </div>


                        <div class="col-md-6 px-5">
                            <label for="product_specification" class="form-label">Name</label>
                            <input type="text" name="product_specification[0][name]" class="form-control"
                                id="product_specification" autocomplete="off">

                            <span id="product_specification.0.name" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 px-5">
                        <label for="product_specification_details_edit" class="form-label">Detail</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="product_specification[0][detail]" placeholder="Leave a comment here"
                                id="product_specification_details_edit" style="height: 100px"></textarea>
                            <span id="product_specification.0.detail" style="color: red;"></span>
                        </div>


                    </div>





                </div>



                <h4 class="mt-5">Product Image</h4>


                <div class="col-md-12 card py-4">

                    <div class="col-md-12 pl-2">
                        <label for="inputAddress" class="form-label">Please select banner image of products</label>
                        <div class="form">

                            <div class="grid">
                                <div class="form-element" onclick=" previewBeforeUpload('file-banner-edit')">
                                    <input type="file" name="product_banner_image" id="file-banner-edit"
                                        accept="image/*">
                                    <label for="file-banner-edit" id="file-banner-edit-preview">
                                        <img src="{{ asset('img/imagepreviewupload.jpg') }}" alt="">
                                        <div>
                                            <span>+</span>
                                        </div>
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>





                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreImage()">+</span>
                    </div>
                    <input type="hidden" value="1" id="imageintial" />

                    <div class="row">
                        <div class="col-md-12 pl-2">
                            <label for="inputAddress" class="form-label">Please select Image</label>
                            <div class="form">

                                <div class="grid" id="product_gallery_edit">
                                    <div class="form-element" onclick="previewBeforeUpload('file-edit-1')">
                                        <input type="file" name="product_image_gallery[]" id="file-edit-1"
                                            accept="image/*">
                                        <label for="file-edit-1" id="file-edit-1-preview">
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





                </div>


                <h4 class="mt-5">Product Different Color Image(optional)</h4>

                <div class="col-md-12 px-5 d-flex justify-content-end">
                    <span class="btn btn-success btn-sm px-3"
                        onclick="addMoreImagefordiffentcolorContainer()">+</span>
                </div>


                <div class="col-md-12 card py-4" id="addMoreImagefordiffentcolorContainer">

                    <div class="col-md-12 pl-2">
                        <label for="inputAddress" class="form-label">Please select banner image of products</label>
                        <div class="form">

                            <div class="grid">
                                <div class="form-element" onclick=" previewBeforeUpload('file-color-edit-banner')">
                                    <input type="file" name="product_color_banner_image[]"
                                        id="file-color-edit-banner" accept="image/*">
                                    <label for="file-color-edit-banner" id="file-color-edit-banner-preview">
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
                                <label for="product_color" class="form-label">Product color</label>
                                <input type="text" name="product_color[]" class="form-control" id="product_color"
                                    autocompvare="off">
                            </div>
                            <div class="col-md-3 py-3">
                                <label for="product_color_stock" class="form-label">Product color Stock</label>
                                <input type="number" name="product_color_stock[]" class="form-control"
                                    id="product_color_stock" autocompvare="off">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreColorImage(0)">+</span>
                    </div>


                    <div class="row">
                        <div class="col-md-12 pl-2">
                            <label for="inputAddress" class="form-label">Please select Image</label>
                            <div class="form">

                                <div class="grid" id="product_color_gallery_0">
                                    <div class="form-element" onclick="previewBeforeUpload('file-color-edit-0-0')">
                                        <input type="file" name="product_color_image_gallery[0][]"
                                            id="file-color-edit-0-0" accept="image/*">
                                        <label for="file-color-edit-0-0" id="file-color-edit-0-0-preview">
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





                </div>
            @endforeach


            <div class="col-md-12 d-flex justify-content-around py-3">
                <button class="btn btn-primary btn-sm px-3" id="updatevendorproduct">Save</button>
            </div>


        </form>


    </div>

</section>

<script>
    $('.product_category_main').select2();
    $('#product_brand_main_edit_id').select2();
    $('#product_measurment_parameter_main_edit_id').select2();
    $('#product_measurment_unit_main_edit').select2();


    for (let i = 0; i <= {{ $k }}; i++) {

        $(`#product_currency_type_edit${i}`).select2();
        $(`#product_color_type_edit${i}`).select2();
    }




    $('#product_specification_heading_edit').select2();






    function openModal() {

        $('#myModalEdit').modal('show');
        $('#exampleModalLabelEdit').html('Add New Brand');


        $('#submitBrandEditForm').on('click', function() {



            // const imageUploader = document.querySelector("input");
            // const imagePreview = document.querySelector("img");


            var formData = new FormData();

            formData.append('brandName', $('#brandNameEdit').val());

            formData.append('brandImage', $('input[name="brandImageEdit"]')[0].files[0]);
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
                    $("#product_brand_main_edit_id").append(brandOptionHtml);
                    $("#product_brand_main_id").append(brandOptionHtml);

                    $('#loader').html('');
                    $('#main_content').removeAttr('class', 'demo');

                    $('#myModalEdit').modal("hide");
                    toastr.success(
                        "brand add Sucessfully"
                    )

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                $(`[id="${fieldName}EditError"]`).html(errorMessageBrand[fieldName][
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


    }





    var specification_heading = $("#product_specification_heading_edit").html();

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



    var product_desc_edit;
    ClassicEditor.create(document.querySelector("#product_desc_edit"), {
            ckfinder: {
                uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
            },
        })
        .then((newEditor) => {
            product_desc_edit = newEditor;
        })
        .catch((error) => {
            console.error(error);
        });



    var product_warrenty_edit;
    ClassicEditor.create(document.querySelector("#product_warrenty_edit"), {
            ckfinder: {
                uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
            },
        })
        .then((newEditor) => {
            product_warrenty_edit = newEditor;
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

    // var product_specification_details_edit;



    ClassicEditor.create(document.querySelector("#product_specification_details_edit"), {
            ckfinder: {
                uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
            },
        })
        .then((newEditor) => {
            product_specification_details_edit = newEditor;
        })
        .catch((error) => {
            console.error(error);
        });

    function previewBeforeUpload(id) {
        console.log(id);
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

        var imageHTML = `<div class="form-element" id="imagecontainer${multipelimageId}" onclick="previewBeforeUpload('file-edit-${multipelimageId}')">
                            <input type="file" name="product_image_gallery[]" id="file-edit-${multipelimageId}"
                                accept="image/*">
                            <label for="file-edit-${multipelimageId}" id="file-edit-${multipelimageId}-preview">
                                <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                                <div>
                                    <span>+</span>
                                   
                                </div>
                                <div>
                                <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElement('imagecontainer${multipelimageId}',${multipelimageId})">-</span>
                           </div>
                                </label>

                            
                                  
                                
                          
                        </div>`;

        $(`#product_gallery_edit`).append(imageHTML);
    }













    var multiplcolorimageId = 1;



    function addMoreColorImage(d) {

        console.log(d);

        var containerColorId = d;

        multiplcolorimageId++;

        var imagecolorHTML = `<div class="form-element" id="imagecontainer${containerColorId}${multiplcolorimageId}" onclick="previewBeforeUpload('file-edit-${containerColorId}-${multiplcolorimageId}')">
                                    <input type="file" name="product_color_image_gallery[${containerColorId}][]" id="file-edit-${containerColorId}-${multiplcolorimageId}"
                                        accept="image/*">
                                    <label for="file-edit-${containerColorId}-${multiplcolorimageId}" id="file-edit-${containerColorId}-${multiplcolorimageId}-preview">
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
                                                        <div class="form-element" onclick=" previewBeforeUpload('file-color-edit-banner${addMoreImagefordiffentcolorContainerId}')">
                                                              <input type="file" name="product_color_banner_image[]" id="file-color-edit-banner${addMoreImagefordiffentcolorContainerId}"   accept="image/*">
                                                            <label for="file-color-edit-banner${addMoreImagefordiffentcolorContainerId}" id="file-color-edit-banner${addMoreImagefordiffentcolorContainerId}-preview">
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
                                       </div>

                                       <div class="col-md-3 py-3">
                                             <label for="product_color_stock${addMoreImagefordiffentcolorContainerId}" class="form-label">Product color</label>
                                          <input type="number" name="product_color_stock[]" class="form-control"
                                        id="product_color_stock${addMoreImagefordiffentcolorContainerId}" autocompvare="off">
                                       </div>
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
            <div class="form-element" onclick="previewBeforeUpload('file-color-edit-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}')">
                <input type="file" name="product_color_image_gallery[${addMoreImagefordiffentcolorContainerId}][]" id="file-color-edit-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}"
                    accept="image/*">
                <label for="file-color-edit-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}" id="file-color-edit-${addMoreImagefordiffentcolorContainerId}-${addMoreImagefordiffentcolorContainerId}-preview">
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

    //     var imageColorContainerHTML = `<div class="form-element" id="imagecontainer-color-${imagecolorintialId}" onclick="previewBeforeUpload('file-color-edit-${imagecolorintialId}')">
    //                                 <input type="file" name="product_image_gallery[]" id="file-color-edit-${imagecolorintialId}"
    //                                     accept="image/*">
    //                                 <label for="file-color-edit-${imagecolorintialId}" id="file-color-edit-${imagecolorintialId}-preview">
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
                       <div class="col-md-6 px-5 mt-5" id="specification_heading_edit${productspecification}">
                        <label for="product_specification_heading_edit${productspecification}" class="form-label">Specification Heading</label>
                        <select id="product_specification_heading_edit${productspecification}" name="product_specification[${productspecification}][heading]"
                            class="form-select ">
                        ${specification_heading}
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
                       
                        <label for="product_specification_details_edit${productspecification}" class="form-label">Detail</label>
                        <div class="form-floating">
                        <textarea class="form-control" name="product_specification[${productspecification}][detail]" placeholder="Leave a comment here"
                            id="product_specification_details_edit${productspecification}" style="height: 100px"></textarea>
                            <span id="product_specification.${productspecification}.detail" style="color: red;"></span>
                            </div>
                    
                    <div class="col-md-12 px-5 d-flex justify-content-end">
                    <span class="btn btn-danger btn-sm px-3" onclick="removeElementSpecfication('productspecification${productspecification}')">-</span>
                </div>
                    

                </div>`;

        $("#productspecfictaioncontaineredit").append(specificationHTML);
        $(`#product_specification_heading_edit${productspecification}`).select2();


        ClassicEditor.create(
                document.querySelector(
                    `#product_specification_details_edit${productspecification}`
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
                                        <label for="product_color_type_edit" class="form-label">Select color
                                            (optional)</label>
                                        <select id="product_color_type_edit${colorStockContainerIndex}" name="product_measurment_price_detail[0][color][]"
                                            class="form-select">
                                            <option selected> Please select option</option>
                                            <option value="red">Red</option>
                                            <option value="green">Green</option>

                                        </select>
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
        $(`#product_color_type_edit${colorStockContainerIndex}`).select2();


    }

    var newColorStockIndex = 0;

    function addNewMoreColorStockMeasurmentFiled(colorStockIndex) {

        newColorStockIndex++;
        var colorNewStockHtml = `  
        <div class="row" id="colorstockcontainer${colorStockIndex}${newColorStockIndex}">
        <div class="col-md-5 py-3">
                                        <label for="product_color_type_edit${colorStockIndex}${newColorStockIndex}" class="form-label">Select color
                                            (optional)</label>
                                        <select id="product_color_type_edit${colorStockIndex}${newColorStockIndex}" name="product_measurment_price_detail[${colorStockIndex}][color][]"
                                            class="form-select">
                                            <option selected> Please select option</option>
                                            <option value="red">Red</option>
                                            <option value="green">Green</option>

                                        </select>
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
        $(`#product_color_type_edit${colorStockIndex}${newColorStockIndex}`).select2();

    }





    var productpricedetailId = 0;

    function productpricedetail() {
        productpricedetailId++;

        var productpricedetailHTML = `<div class="row" id="productpricecontaineredit${productpricedetailId}">
<div class="col-md-3 py-3">
    <label for="product_measurment_quantity${productpricedetailId}" class="form-label">Product
        Measurment Quantity</label>
    <input type="number" name="product_measurment_price_detail[${productpricedetailId}][measurment_quantity]"
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
    <label for="product_currency_type_edit${productpricedetailId}" class="form-label">Currency Type</label>
    <select id="product_currency_type_edit${productpricedetailId}"
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
            <select id="product_new_color_type${productpricedetailId}"
                name="product_measurment_price_detail[${productpricedetailId}][color][]" class="form-select">
                <option selected> Please select option</option>
                <option value="red">Red</option>
                <option value="green">Green</option>

            </select>
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
        onclick="removeElementProductPriceDetail('productpricecontaineredit${productpricedetailId}')">-</span>
</div>

</div>`;



        $("#productpricecontaineredit").append(productpricedetailHTML);


        $(`#product_currency_type_edit${productpricedetailId}`).select2();

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

                console.log(selectedParentElementId);

                console.log($(`#${selectedParentElementId}`));

                var divsToRemove = $(`#${selectedParentElementId}`).nextAll("div");

                console.log(divsToRemove);

                if (divsToRemove.length > 0) {
                    // Remove all subsequent div elements
                    divsToRemove.remove();
                }
            },
            success: (data) => {
                $("#loader").html("");
                $("#main_content").removeAttr("class", "demo");

                $("#productcategoryelementedit").append(data.responsehtml);
                $(`#${data.id}`).select2();
            },
            error: (error) => {},
        });
    }

    $("#savevendorproduct").on("click", function(e) {
        e.preventDefault();

        var formData = new FormData($("#vendorform")[0]);



        formData.append("product_discription", product_desc_edit.getData());
        formData.append("product_warrenty_edit", product_warrenty_edit.getData());

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
            product_specification_details_edit.getData()
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


                let product_color_image_gallery_data = $(
                        `input[name="product_color_image_gallery[${i}][]"]`)[0]
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

    function showImage() {


        let reader = new FileReader();
        reader.readAsDataURL($('input[name="brandImageEdit"]')[0].files[0]);
        reader.onload = function(e) {
            $("#brandImageEditpreviewupload").addClass("show");
            $("#brandImageEditpreviewupload").attr("src", e.target.result);


        };
    }



    $('#openMeasurmentModalButtonEdit').on('click', function() {

        $('#myModalMeasurmentParameterNameEdit').modal('show');
        $('#exampleModalLabelMeasurmentParameterNameEdit').html('Add New MeasurMent Parameter');



        $('#submitMeasurementParameterFormEdit').on('click', function() {

            var formData = new FormData();

            formData.append('measurment_parameter_name', $('#product_measurment_name_edit_id')
                .val());


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

                    $("#product_measurment_parameter_main_edit_id").append(OptionHtml);

                    $('#loader').html('');
                    $('#main_content').removeAttr('class', 'demo');

                    $('#myModalMeasurmentParameterNameEdit').modal("hide");
                    toastr.success(
                        "Measurment Parameter Added Successfully"
                    );

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {
                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                $(`[id="mesaurement_parameter_error_edit_id"`).html(
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

    $('#openMeasurmentUnitModalButtonEdit').on('click', function() {

        $('#myModalMeasurmentParameterUnitEdit').modal('show');
        $('#exampleModalLabelMeasurmentParameterUnitEdit').html('Add New MeasurMent Parameter Unit');



        $('#submitMeasurementParameterUnitFormEdit').on('click', function() {

            var formData = new FormData();

            formData.append('measurment_parameter_unit_name', $('#product_measurment_unit_name_edit_id')
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

                    $("#product_measurment_unit_main_edit").append(OptionHtml);

                    $('#loader').html('');
                    $('#main_content').removeAttr('class', 'demo');

                    $('#myModalMeasurmentParameterUnitEdit').modal("hide");
                    toastr.success(
                        "Product Unit add Sucessfully"
                    );

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {
                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {

                                $(`[id="mesaurement_parameter_unit_error_edit_id"`).html(
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
