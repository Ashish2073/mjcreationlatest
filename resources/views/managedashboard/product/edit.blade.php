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


    {{-- <div class="content-header-left text-md-left position-absolute right-5 mt-4">
        <div class="form-group">
            <a @if (!Route::is('vendors.productlist')) wire:navigate  href="{{ route('vendors.productlist') }}" @else href="javascript:void(0)" @endif
                style="width: 55px;height:50px" class="btn-icon btn btn-danger btn-round btn-sm">
                <i class="ti-close"></i>
            </a>
        </div>
    </div> --}}

    <div class="form-group d-flex justify-content-end mt-3">
        <div class="form-group">
            <button onclick="hideEditForm()" style="width: 55px;height:50px"
                class="btn-icon btn btn-danger btn-round btn-sm">
                <i class="ti-close"></i>
            </button>
        </div>
    </div>
    {{-- hideEditForm() --}}



    <div class="container py-3">


        <div class="row py-4">
            <div class="col-md-12 d-flex justify-content-between">
                <strong>Product</strong>
                {{-- <button class="btn btn-success btn-sm ">Add More Product</button> --}}
            </div>
        </div>
        <form class="row g-3" id="vendorformedit" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row" id="productcategoryelementedit">
                    <div class="col-md-4" id="main_product_category_edit">
                        <label for="product_category" class="form-label">Category</label>
                        <select name="product_category[]" id="product_category_main"
                            onchange="selectSubproductcategoryEdit(this)" class="form-select product_category_main"
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
                        <select name="product_category[]" id="" onchange="selectSubproductcategoryEdit(this)"
                            class="form-select product_category_main" aria-label="Default select example">

                            <option selected disabled>Open this select menu</option>
                            @foreach ($product_sub_category as $data)
                                <option @if ($product_sub_category_by_id->id == $data->id) selected @endif value="{{ $data->id }}">
                                    {{ ucwords($data->name) }}</option>
                            @endforeach
                        </select>
                        <span id="product_categoryedit" style="color:red"></span>



                    </div>




                </div>







            </div>


            @foreach ($vendorProducts as $productdata)



                <input type="hidden" value="{{ $productdata->id }}" name="product_id" />
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="product_title" class="form-control" id="inputEmail4"
                                value="{{ $productdata->product_title }}" autocomplete="off">

                            <span id="product_titleedit" style="color: red;"></span>
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
                            'openModalButton' => 'openModalButtonEdit',
                            'brandname' => 'brandNameEdit',
                            'brandnameerror' => 'brandNameEditError',
                            'brandimage' => 'brandImageEdit',
                            'brandImagepreviewupload' => 'brandImageEditpreviewupload',
                            'brandImageediterror' => 'brandImageEditError',
                            'selectbranderrorid' => 'product_brand_idedit',
                        ]);





                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Product Quantity</label>
                            <input type="number" name="product_quantity" class="form-control" id="inputEmail4"
                                value="{{ $productdata->product_total_stock_quantity }}" autocomplete="off">

                            <span id="product_quantityedit" style="color: red;"></span>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <label for="product_desc_edit" class="form-label">Discription</label>
                    <div class="form-floating">
                        <textarea class="form-control" id="product_desc_edit" name="product_desc" placeholder="Leave a comment here"
                            style="height: 100px">{{ $productdata->discription }}</textarea>
                        <span id="product_discriptionedit" style="color: red;"></span>
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
                            'seletspanerror' => 'product_measurment_parameteredit',
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
                            'seletspanerror' => 'product_measurment_unitedit',
                        ])



                        <div class=" mt-3">
                            <div class="col-md-12 card " id="productpricecontaineredit">
                                <div class="col-md-12 py-4 d-flex justify-content-end p-3">
                                    <span class="btn btn-success btn-sm px-3"
                                        onclick="productpricedetailEdit()">+</span>
                                </div>
                                @foreach ($productpricedetails as $k => $productpricedata)
                                    <div class="row p-3 mt-3" id="productpricecontaineredit{{ $k }}">
                                        <div class="col-md-3 py-3">
                                            <label for="product_measurment_quantity_edit{{ $k }}"
                                                class="form-label">Product
                                                Measurment Amount</label>
                                            <input type="text"
                                                name="product_measurment_price_detail[{{ $k }}][measurment_quantity]"
                                                value="{{ $productpricedata->measurment_quantity }}"
                                                class="form-control measurmentquantityindexchange"
                                                id="product_measurment_quantity_edit{{ $k }}"
                                                autocomplete="off">
                                            <span class="spanmeasurmentquantityindexchange"
                                                id="product_measurment_price_detail.{{ $k }}.measurment_quantityedit"
                                                style="color: red;"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="product_measurment_quantity_price_edit{{ $k }}"
                                                class="form-label">Price(MRP)</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[{{ $k }}][price]"
                                                value="{{ $productpricedata->price }}"
                                                class="form-control measurmentpriceindexchange"
                                                id="product_measurment_quantity_price_edit{{ $k }}"
                                                autocomplete="off">
                                            <span class="spanmeasurmentpriceindexchange"
                                                id="product_measurment_price_detail.{{ $k }}.priceedit"
                                                style="color: red;"></span>
                                        </div>




                                        <div class="col-md-3">
                                            <label for="product_currency_type_edit{{ $k }}"
                                                class="form-label ">Currency Type</label>
                                            <select id="product_currency_type_edit{{ $k }}"
                                                name="product_measurment_price_detail[{{ $k }}][currency]"
                                                class="form-select measurmentcurrencyindexchange">
                                                <option selected disabled> Please Select Currency type</option>
                                                <option @if ($productpricedata->currency == 'inr') selected @endif
                                                    value="inr">INR</option>
                                                <option @if ($productpricedata->currency == 'usd') selected @endif
                                                    value="usd">USD</option>

                                            </select>
                                            <span class="spanmeasurmentcurrencyindexchange"
                                                id="product_measurment_price_detail.{{ $k }}.currencyedit"
                                                style="color: red;"></span>
                                        </div>



                                        <div class="col-md-3 py-3">
                                            <label for="product_stock_quantity_edit{{ $k }}"
                                                class="form-label">Product Stock
                                                Quantity</label>
                                            <input type="text"
                                                name="product_measurment_price_detail[{{ $k }}][stock]"
                                                value="{{ $productpricedata->stock }}"
                                                class="form-control measurmentstockindexchange"
                                                id="product_stock_quantity_edit{{ $k }}"
                                                autocompvare="off">
                                            <span class="spanmeasurmentstockindexchange"
                                                id="product_measurment_price_detail.{{ $k }}.stockedit"
                                                style="color: red;"></span>
                                        </div>

                                        @php $productColor=json_decode($productpricedata->color, true); @endphp
                                        @php $productColorStock=json_decode($productpricedata->stock_color_wise,true); @endphp

                                        <div id="colorstockedit{{ $k }}" class="card mb-3">
                                            @for ($c = 0; $c < count($productColor); $c++)
                                                <div class="row "
                                                    id="colorstockcontainer{{ $k }}{{ $c }}">
                                                    <div class="col-md-5 py-3">
                                                        <label
                                                            for="product_color_type_edit{{ $k }}{{ $c }}"
                                                            class="form-label">Color
                                                            (optional)
                                                        </label>
                                                        <input
                                                            id="product_color_type_edit{{ $k }}{{ $c }}"
                                                            value="{{ $productColor[$c] }}"
                                                            name="product_measurment_price_detail[{{ $k }}][color][]"
                                                            class="form-control" />
                                                    </div>



                                                    <div class="col-md-5 py-3">
                                                        <label
                                                            for="product_stock_quantity_color_edit{{ $k }}{{ $c }}"
                                                            class="form-label">Product
                                                            Stock
                                                            Color wise (optional)</label>
                                                        <input type="number"
                                                            name="product_measurment_price_detail[{{ $k }}][stock_color_wise][]"
                                                            class="form-control" value="{{ $productColorStock[$c] }}"
                                                            id="product_stock_quantity_color_edit{{ $k }}{{ $c }}"
                                                            autocompvare="off">
                                                    </div>

                                                    <div class="col-md-2 py-3">

                                                        <span class="btn btn-success btn-sm "
                                                            onclick="addMoreColorStockMeasurmentFiledEdit({{ $k }})">+</span>


                                                    </div>
                                                    @if ($c > 0)
                                                        <div class="col-md-2 py-3">


                                                            <span class="btn btn-danger btn-sm px-3"
                                                                onclick="removeElementEdit('colorstockcontainer{{ $k }}{{ $c }}')">-</span>


                                                        </div>
                                                    @endif

                                                </div>
                                            @endfor
                                        </div>

                                        @if ($k > 0)
                                            <div class="col-md-12 px-5 d-flex justify-content-end">
                                                <span class="btn btn-danger btn-sm px-3"
                                                    onclick="removeElementProductPriceDetailEdit('productpricecontaineredit{{ $k }}')">-</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach

                            </div>

                        </div>



                    </div>


                </div>


                @php $productspecificationdata=json_decode($productdata->product_specification_heading, true); @endphp
                @php $productspecificationnamedata=json_decode($productdata->product_specification, true); @endphp

                @php $productspecificationdetaildata=json_decode($productdata->product_specification_details, true); @endphp

                {{-- {{ dd($productspecificationnamedata, $productspecificationdata) }} --}}


                <h4 class="mt-5">Specification</h4>
                <div class="col-md-12 card p-3" id="productspecfictaioncontaineredit">
                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreProductspecificationEdit()">+</span>
                    </div>
                    @for ($l = 0; $l < count($productspecificationdata); $l++)
                        <div class="row" id="productspecificationedit{{ $l }}">


                            @if ($l == 0)
                                @include('managedashboard.product.measurmentparameter', [
                                    'modal_id' => 'myModalSpecificationHeadingEdit',
                                    'modal_label' => 'exampleModalSpecificHeadingEdit',
                                    'select_id' => 'product_specification_heading_edit0',
                                    'selectindexchange' => 'selectspecficationindexchangeEdit',
                                    'selectedid' => $productspecificationdata[$l],
                                    'selectdata' => $product_specification_heading_edit,
                                    'submitbtnid' => 'submitSpecificationFormEdit',
                                    'input_name' => 'product_specification_heading_name',
                                    'input__id' => 'product_specification_heading_name_edit_id',
                                    'type' => 'text',
                                    'span_error_id' => 'product_specification_heading_error_edit_id',
                                    'openModalButton' => 'openSpecificationHeadingModalButtonEdit',
                                    'select_name' => 'product_specification[0][heading]',
                                    'select_label' => 'Specification Heading',
                                    'seletspanerror' => 'product_specificationedit.0.heading',
                                ])
                            @else
                                <div class="col-md-6 px-5" id="specification_heading_edit{{ $l }}">
                                    <label for="product_specification_heading_edit{{ $l }}"
                                        class="form-label ">Specification
                                        Heading</label>
                                    <select id="product_specification_heading_edit{{ $l }}"
                                        name="product_specification[{{ $l }}][heading]"
                                        class="form-select selectspecficationindexchangeEdit ">
                                        <option selected disabled>Please Select heading</option>
                                        @foreach ($product_specification_heading_edit as $data)
                                            <option @if ($productspecificationdata[$l] == $data->id) selected @endif
                                                value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                                        @endforeach


                                    </select>
                                    <span class="spanselectspecficationindexchangeEdit"
                                        id="product_specification.{{ $l }}.headingedit"
                                        style="color: red;"></span>
                                </div>
                            @endif


                            <div class="col-md-6 px-5">
                                <label for="product_specificationedit" class="form-label">Name</label>
                                <input type="text" name="product_specification[{{ $l }}][name]"
                                    class="form-control productspecificationchangename"
                                    id="product_specificationedit{{ $l }}"
                                    value="{{ $productspecificationnamedata[$l] }}" autocomplete="off">

                                <span id="product_specification.{{ $l }}.nameedit"
                                    class="spanproductspecificationchangename" style="color: red;"></span>
                            </div>

                            <div class="col-md-12 ">
                                <label for="product_specification_details_edit" class="form-label">Detail</label>
                                <div class="form-floating">
                                    <textarea class="form-control productspecificationchangetextarea"
                                        name="product_specification[{{ $l }}][detail]" placeholder="Leave a comment here"
                                        id="product_specification_details_edit{{ $l }}" style="height: 100px">{{ $productspecificationdetaildata[$l] }}</textarea>
                                    <span class="spanproductspecificationchangetextarea"
                                        id="product_specification.{{ $l }}.detailedit"
                                        style="color: red;"></span>
                                </div>

                                @if ($l > 0)
                                    <div class="col-md-12 px-5 d-flex justify-content-end">
                                        <span class="btn btn-danger btn-sm px-3"
                                            onclick="removeElementSpecficationEdit('productspecificationedit{{ $l }}')">-</span>
                                    </div>
                                @endif


                            </div>
                        </div>
                    @endfor

                    <div class="col-md-6 px-5" hidden id="specification_heading_edit_hidden">


                        <option selected disabled>Please Select heading</option>
                        @foreach ($product_specification_heading_edit as $data)
                            <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                        @endforeach




                    </div>




                </div>



                <h4 class="mt-5">Product Image</h4>


                <div class="col-md-12 card py-4">

                    <div class="col-md-12 pl-2">
                        <label for="inputAddress" class="form-label">Please select banner image of products</label>
                        <div class="form">

                            <div class="grid">
                                <div class="form-element" onclick=" previewBeforeUploadEdit(this,'file-banner-edit')">
                                    <input type="file" name="product_banner_image" id="file-banner-edit"
                                        accept="image/*">
                                    <label for="file-banner-edit" id="file-banner-edit-preview">
                                        @if (!isset($productdata->product_banner_image))
                                            <img src="{{ asset('img/imagepreviewupload.jpg') }}" alt="banner image">
                                        @else
                                            <img src="{{ asset('product/banner/' . $productdata->product_banner_image) }}"
                                                alt="banner image">
                                            <input type="hidden" value="{{ $productdata->product_banner_image }}"
                                                name="product_banner_image_existing[]" />
                                        @endif
                                        <div>
                                            <span>+</span>
                                        </div>
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>





                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreImageEdit()">+</span>
                    </div>
                    <input type="hidden" value="1" id="imageintial" />

                    <div class="row">
                        <div class="col-md-12 pl-2">
                            <label for="inputAddress" class="form-label">Please select Image</label>
                        </div>
                        <div class="form">

                            <div class="grid" id="product_gallery_edit">

                                @if (isset($productdata->product_image_gallery))
                                    @php $productdataimagegallery=json_decode($productdata->product_image_gallery,true); @endphp

                                    @php $imagegalllerylength=count($productdataimagegallery); @endphp
                                    @for ($g = 0; $g < $imagegalllerylength; $g++)
                                        <div class="form-element" id="imagecontainer{{ $g }}"
                                            onclick="previewBeforeUploadEdit(this,'file-edit-{{ $g }}')">

                                            <input type="hidden" value="{{ $productdataimagegallery[$g] }}"
                                                name="product_image_gallery_existing[]" />



                                            <input type="file" name="product_image_gallery[]"
                                                id="file-edit-{{ $g }}" accept="image/*">
                                            <label for="file-edit-{{ $g }}"
                                                id="file-edit-{{ $g }}-preview">
                                                <img src="{{ asset('product/gallery/' . $productdataimagegallery[$g]) }}"
                                                    class="image-fluid" />
                                                <div>
                                                    <span>+</span>
                                                </div>
                                                <div>
                                                    <span class="btn btn-danger justify-content-center"
                                                        style="font-size:unset !important ;margin-top: 45px;"
                                                        onclick="removeElementEdit('imagecontainer{{ $g }}',{{ $g }})">-</span>
                                                </div>
                                            </label>
                                        </div>
                                    @endfor
                                @else
                                    <div class="form-element" onclick="previewBeforeUploadEdit(this,'file-edit-1')">
                                        <input type="file" name="product_image_gallery[]" id="file-edit-1"
                                            accept="image/*">
                                        <label for="file-edit-1" id="file-edit-1-preview">
                                            <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                @endif




                            </div>
                        </div>
                    </div>


                </div>





    </div>


    <h4 class="mt-5">Product Different Color Image(optional)</h4>


    @if (isset($productdata->product_color_banner_image))
        @php $productdatacolorbannerimage=json_decode($productdata->product_color_banner_image,true); @endphp

        @php $productColor=json_decode($productdata->product_color,true); @endphp


        @php $productdatacolorbannerimagelength=count($productdatacolorbannerimage); @endphp
    @endif

    @if (isset($productdata->product_color_image_gallery))
        @php $productdatacolorimagegallery=json_decode($productdata->product_color_image_gallery,true); @endphp
        @php $productdatacolorimagegallerylength=count($productdatacolorimagegallery); @endphp
    @endif

    @if (isset($productdatacolorbannerimage))
        <div class="col-md-12 px-5 d-flex justify-content-end">
            <span class="btn btn-success btn-sm px-3" onclick="addMoreImagefordiffentcolorContaineredit()">+</span>
        </div>



        <div class="col-md-12" id="addMoreImagefordiffentcolorContaineredit">




            @for ($w = 0; $w < $productdatacolorbannerimagelength; $w++)
                <div class="col-md-12 card py-4 mt-2"
                    id="addMoreImagefordiffentcolorContaineredit{{ $w }}">
                    <div class="col-md-12">
                        <label for="inputAddress" class="form-label">Please select banner image of products</label>
                        <div class="form">

                            <div class="grid">
                                <div class="form-element" data-item="0"
                                    data-id="colorbannerimage{{ $w }}"
                                    onclick="previewBeforeUploadEdit(this,'file-color-edit-banner{{ $w }}')">

                                    <input type="hidden" class="product_color_banner_image_existing"
                                        value="{{ $productdatacolorbannerimage[$w] }}"
                                        id="colorbannerimage{{ $w }}"
                                        name="product_color_banner_image_existing[]" />



                                    <input type="file" class="productcolorbannerimageedit"
                                        name="product_color_banner_image[]"
                                        id="file-color-edit-banner{{ $w }}" accept="image/*">

                                    <label for="file-color-edit-banner{{ $w }}"
                                        id="file-color-edit-banner{{ $w }}-preview">
                                        <img src="{{ asset('product/gallery/' . $productdatacolorbannerimage[$w]) }}"
                                            alt="">
                                        <div>
                                            <span>+</span>
                                        </div>
                                        {{-- <div>
                                        <span class="btn btn-danger justify-content-center"
                                            style="font-size:unset !important ;margin-top: 45px;"
                                            onclick="removeElementEdit('imagecontainer{{ $w }}{{ $v }}')">-</span>
                                    </div> --}}
                                    </label>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 py-3">
                                <label for="product_color" class="form-label">Product color</label>
                                <input type="text" name="product_color[]" class="form-control product_color_edit"
                                    id="product_color{{ $w }}" value="{{ $productColor[$w] ?? '' }}"
                                    autocompvare="off">
                                <span id="product_color.{{ $w }}edit" style="color: red;"></span>
                            </div>
                            {{-- <div class="col-md-3 py-3">
                                <label for="product_color_stock" class="form-label">Product color Stock</label>
                                <input type="number" name="product_color_stock[]" class="form-control"
                                    id="product_color_stock" autocompvare="off">
                            </div> --}}
                        </div>
                    </div>


                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3"
                            onclick="addMoreColorImageEdit({{ $w }})">+</span>
                    </div>

                    @if (isset($productdatacolorimagegallery[$w]))
                        <div class="row">
                            <div class="col-md-12 pl-2">
                                <label for="inputAddress" class="form-label">Please select Image</label>
                                <div class="form">


                                    @php $subcolorImagecategory=$productdatacolorimagegallery[$w]; @endphp

                                    @php $subcolorImagecategorylength=count($subcolorImagecategory); @endphp



                                    <div class="grid product_color_image_gallery_edit"
                                        id="product_color_gallery_edit_{{ $w }}">
                                        @for ($v = 0; $v < $subcolorImagecategorylength; $v++)
                                            <div class="form-element"
                                                id="imagecontainer{{ $w }}{{ $v }}"
                                                data-item="0"
                                                data-id="colorimagegallery{{ $w }}{{ $v }}"
                                                onclick="previewBeforeUploadEdit(this,'file-color-edit-{{ $w }}-{{ $v }}')">

                                                <input type="hidden"
                                                    id="colorimagegallery{{ $w }}{{ $v }}"
                                                    value="{{ $subcolorImagecategory[$v] }}"
                                                    class="product_color_image_gallery_existing{{ $w }}"
                                                    name="product_color_image_gallery_existing[{{ $w }}][{{ $v }}]" />



                                                <input type="file"
                                                    name="product_color_image_gallery_edit[{{ $w }}][]"
                                                    id="file-color-edit-{{ $w }}-{{ $v }}"
                                                    accept="image/*">



                                                <label
                                                    for="file-color-edit-{{ $w }}-{{ $v }}"
                                                    id="file-color-edit-{{ $w }}-{{ $v }}-preview">
                                                    <img
                                                        src="{{ asset('product/gallery/' . $subcolorImagecategory[$v]) }}">
                                                    <div>
                                                        <span>+</span>
                                                    </div>
                                                    <div>
                                                        <span class="btn btn-danger justify-content-center"
                                                            style="font-size:unset !important ;margin-top: 45px;"
                                                            onclick="removeElementEdit('imagecontainer{{ $w }}{{ $v }}')">-</span>
                                                    </div>
                                                </label>

                                            </div>
                                        @endfor

                                    </div>


                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($w > 0)
                        <div class="col-md-12 mt-3 px-5 d-flex justify-content-end">
                            <span class="btn btn-danger btn-sm px-3"
                                onclick="removeColorImageGalleryEdit('addMoreImagefordiffentcolorContaineredit{{ $w }}')">-</span>
                        </div>
                    @endif




                </div>
            @endfor
        </div>
    @else
        <div class="col-md-12 px-5 d-flex justify-content-end">
            <span class="btn btn-success btn-sm px-3" onclick="addMoreImagefordiffentcolorContaineredit()">+</span>
        </div>



        <div class="col-md-12 card py-4" id="addMoreImagefordiffentcolorContaineredit">

            <div class="col-md-12 pl-2">
                <label for="inputAddress" class="form-label">Please select banner image of products</label>
                <div class="form">

                    <div class="grid">
                        <div class="form-element" onclick="previewBeforeUploadEdit(this,'file-color-edit-banner')">
                            <input type="file" class="productcolorbannerimageedit"
                                name="product_color_banner_image[]" id="file-color-edit-banner" accept="image/*">
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
                        <input type="text" name="product_color[]" class="form-control product_color_edit"
                            id="product_color" value="" autocompvare="off">
                        <span id="product_color.0edit" style="color: red;"></span>
                    </div>
                    {{-- <div class="col-md-3 py-3">
                        <label for="product_color_stock" class="form-label">Product color Stock</label>
                        <input type="number" name="product_color_stock[]" class="form-control"
                            id="product_color_stock" autocompvare="off">
                    </div> --}}
                </div>
            </div>


            <div class="col-md-12 px-5 d-flex justify-content-end">
                <span class="btn btn-success btn-sm px-3" onclick="addMoreColorImageEdit(0)">+</span>
            </div>


            <div class="row">
                <div class="col-md-12 pl-2">
                    <label for="inputAddress" class="form-label">Please select Image</label>
                    <div class="form">




                        <div class="grid product_color_image_gallery_edit" id="product_color_gallery_edit_0">

                            <div class="form-element" onclick="previewBeforeUploadEdit(this,'file-color-edit-0-0')">
                                <input type="file" name="product_color_image_gallery_edit[0][]"
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
    @endif

    @endforeach


    <div class="col-md-12 d-flex justify-content-around py-3">
        <button class="btn btn-primary btn-sm px-3" id="updatevendorproduct">UPDATE</button>
    </div>


    </form>


    </div>

</section>

<script>
    var multipelimageId = {{ isset($g) ? $g : 1 }};
    var productspecificationedit = {{ isset($l) ? $l : 0 }};
    var productpricedetailIdindexedit = {{ isset($k) ? $k : 0 }};

    var colorStockContainerIndex = {{ isset($c) ? $c : 0 }};
    var addMoreImagefordiffentcolorContainerediteditId = {{ isset($w) ? $w : 0 }};

    console.log(addMoreImagefordiffentcolorContainerediteditId);

    console.log(productspecificationedit, productpricedetailIdindexedit)

    console.log(productspecificationedit);
    $('.product_category_main').select2();
    $('#product_brand_main_edit_id').select2();
    $('#product_measurment_parameter_main_edit_id').select2();
    $('#product_measurment_unit_main_edit').select2();

    $('.measurmentcurrencyindexchange').select2();

    $('.selectspecficationindexchangeEdit').select2();


    // for (let i = 0; i < {{ $k }}; i++) {

    //     for (let m = 0; m < {{ $c }}; m++) {
    //         // $(`#product_currency_type_edit${i}`).select2();
    //         $(`#product_color_type_edit${i}${m}`).select2();

    //     }


    // }

    var productspecificationTextareaEdit = [];

    for (let j = 0; j < productspecificationedit; j++) {

        // $(`#product_specification_heading_edit${j}`).select2();

        ClassicEditor.create(document.querySelector(`#product_specification_details_edit${j}`), {
                ckfinder: {
                    uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                },
            })
            .then((newEditor) => {
                productspecificationTextareaEdit.push(newEditor);
            })
            .catch((error) => {
                console.error(error);
            });

    }













    $('#openModalButtonEdit').on('click', function() {
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

                                $(`[id="${fieldName}EditError"]`).html(errorMessageBrand[
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





    var specification_heading_html_edit = $("#specification_heading_edit_hidden").html();

    function isset(variable) {
        return typeof variable !== 'undefined' && variable !== null;
    }

    function reIndexingcolorImagegalleryEdit() {
        const divs = document.querySelectorAll('.product_color_image_gallery_edit');

        // const allPairs = [];
        const pairs = [];

        divs.forEach((div, divIndex) => {

            const inputs = div.querySelectorAll('input[type="file"]');
            pairs[divIndex] = [];


            for (let i = 0; i < inputs.length; i++) {
                console.log(inputs[i]);
                // pairs[divIndex][i] = inputs[i];
                pairs[divIndex].push(inputs[i]);




            }


        });


        for (let w = 0; w < addMoreImagefordiffentcolorContainerediteditId; w++) {
            for (let k = 0; k < pairs[w].length; k++) {
                pairs[w][k].setAttribute('name', `product_color_image_gallery_edit[${w}][]`);
            }
        }




    }


    function removeColorImageGalleryEdit(id) {
        addMoreImagefordiffentcolorContainerediteditId--;
        $(`#${id}`).remove();

        reIndexingcolorImagegalleryEdit();


    }



    function removeElementEdit(id) {



        $(`#${id}`).remove();
    }


    function removeElementProductPriceDetailEdit(id) {
        productpricedetailIdindexedit--;
        $(`#${id}`).remove();

        console.log('productpricedetailIdindexedit', productpricedetailIdindexedit);


        let quantityInputFields = document.querySelectorAll('.measurmentquantityindexchange');
        let quantitySpanFields = document.querySelectorAll('.spanmeasurmentquantityindexchange');

        let priceInputFields = document.querySelectorAll('.measurmentpriceindexchange');
        let priceSpanFields = document.querySelectorAll('.spanmeasurmentpriceindexchange');

        let currencyInputFields = document.querySelectorAll('.measurmentcurrencyindexchange');
        let currencySpanFields = document.querySelectorAll('.spanmeasurmentcurrencyindexchange');

        let stockInputFields = document.querySelectorAll('.measurmentstockindexchange');
        let stockSpanFields = document.querySelectorAll('.spanmeasurmentstockindexchange');




        for (let k = 0; k < productpricedetailIdindexedit + 1; k++) {

            quantityInputFields[k].setAttribute('name', `product_measurment_price_detail[${k}][measurment_quantity]`);
            quantitySpanFields[k].setAttribute('id', `product_measurment_price_detail.${k}.measurment_quantityedit`)

            priceInputFields[k].setAttribute('name', `product_measurment_price_detail[${k}][price]`);
            priceSpanFields[k].setAttribute('id', `product_measurment_price_detail.${k}.priceedit`)

            currencyInputFields[k].setAttribute('name', `product_measurment_price_detail[${k}][currency]`);
            currencySpanFields[k].setAttribute('id', `product_measurment_price_detail.${k}.currencyedit`)


            stockInputFields[k].setAttribute('name', `product_measurment_price_detail[${k}][stock]`);
            stockSpanFields[k].setAttribute('id', `product_measurment_price_detail.${k}.stockedit`)



        }



    }

    function removeElementSpecficationEdit(id) {

        productspecificationedit--;

        $(`#${id}`).remove();

        console.log(id);

        console.log(productspecificationTextareaEdit);



        let inputFields = document.querySelectorAll('.productspecificationchangename');

        let spanFields = document.querySelectorAll('.spanproductspecificationchangename');
        let textAreaFields = document.querySelectorAll('.productspecificationchangetextarea');

        let spantextAreaFields = document.querySelectorAll('.spanproductspecificationchangetextarea');

        let selectAreaFields = document.querySelectorAll('.selectspecficationindexchangeEdit');

        let spanselectAreaFields = document.querySelectorAll('.spanselectspecficationindexchangeEdit');

        for (let i = 0; i < productspecificationedit; i++) {


            //product_specification[{{ $l }}][detail]  Change the name attribute value with incremental index productspecificationchangename productspecificationchangetextarea
            inputFields[i].setAttribute('name', `product_specification[${i}][name]`);
            spanFields[i].setAttribute('id', `product_specification.${i}.nameedit`)
            textAreaFields[i].setAttribute('id', `product_specification_details_edit${i}`);

            textAreaFields[i].setAttribute('name', `product_specification[${i}][detail]`);









            spantextAreaFields[i].setAttribute('id', `product_specification.${i}.detailedit`);







            selectAreaFields[i].setAttribute('name', `product_specification[${i}][heading]`);

            spanselectAreaFields[i].setAttribute('id', `product_specification.${i}.headingedit`);



            selectAreaFields[i].setAttribute('id', `product_specification_heading_edit${i}`);
            // $(`#product_specification_heading_edit${productspecificationedit-1}`).select2();

            //   $product_specification_heading_edit${i}.select2();
        }









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



    function previewBeforeUploadEdit(element, id) {
        const dataItemValue = element.dataset.item;
        const dataIdValue = element.dataset.id;





        $(`#${dataIdValue}`).val("");



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






    function addMoreImageEdit() {
        multipelimageId++;

        var imageHTML = `<div class="form-element" id="imagecontainer${multipelimageId}" onclick="previewBeforeUploadEdit(this,'file-edit-${multipelimageId}')">
                            <input type="file" name="product_image_gallery[]" id="file-edit-${multipelimageId}"
                                accept="image/*">
                            <label for="file-edit-${multipelimageId}" id="file-edit-${multipelimageId}-preview">
                                <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                                <div>
                                    <span>+</span>
                                   
                                </div>
                                <div>
                                <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElementEdit('imagecontainer${multipelimageId}',${multipelimageId})">-</span>
                           </div>
                                </label>

                            
                                  
                                
                          
                        </div>`;

        $(`#product_gallery_edit`).append(imageHTML);
    }













    var multiplcolorimageId = 1;



    function addMoreColorImageEdit(d) {



        var containerColorIdEdit = d;

        multiplcolorimageId++;

        var imagecolorHTMLEdit = `<div class="form-element" id="imagecontainer${containerColorIdEdit}${multiplcolorimageId}" onclick="previewBeforeUploadEdit(this,'file-edit-${containerColorIdEdit}-${multiplcolorimageId}')">
                                    <input type="file"  name="product_color_image_gallery_edit[${containerColorIdEdit}][]" id="file-edit-${containerColorIdEdit}-${multiplcolorimageId}"
                                        accept="image/*">
                                    <label for="file-edit-${containerColorIdEdit}-${multiplcolorimageId}" id="file-edit-${containerColorIdEdit}-${multiplcolorimageId}-preview">
                                        <img src="{{ asset('img/imagepreviewupload.jpg') }}">
                                        <div>
                                            <span>+</span>
                                           
                                        </div>
                                        <div>
                                        <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElementEdit('imagecontainer${containerColorIdEdit}${multiplcolorimageId}')">-</span>
                                   </div>
                                        </label>

                                    
                                          
                                        
                                  
                                </div>`;

        // console.log(imagecolorHTMLEdit);
        // product_color_gallery_edit_0

        console.log($(`#product_color_gallery_edit_${containerColorIdEdit}`));


        $(`#product_color_gallery_edit_${containerColorIdEdit}`).append(imagecolorHTMLEdit);

        reIndexingcolorImagegalleryEdit();





    }









    function addMoreImagefordiffentcolorContaineredit() {

        addMoreImagefordiffentcolorContainerediteditId++;

        var addMoreImagefordiffentcolorContainereditHTML = `<div class="col-md-12 card py-4 mt-2" id="addMoreImagefordiffentcolorContaineredit${addMoreImagefordiffentcolorContainerediteditId}">

                                                      <div class="col-md-12 pl-2">
                                                      <label for="inputAddress" class="form-label">Please select banner image of products</label>
                                                       <div class="form">
                                                       <div class="grid">
                                                        <div class="form-element" onclick=" previewBeforeUploadEdit(this,'file-color-edit-banner${addMoreImagefordiffentcolorContainerediteditId}')">
                                                              <input type="file" class="productcolorbannerimageedit" name="product_color_banner_image[]" id="file-color-edit-banner${addMoreImagefordiffentcolorContainerediteditId}"   accept="image/*">
                                                            <label for="file-color-edit-banner${addMoreImagefordiffentcolorContainerediteditId}" id="file-color-edit-banner${addMoreImagefordiffentcolorContainerediteditId}-preview">
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
                                             <label for="product_color${addMoreImagefordiffentcolorContainerediteditId}" class="form-label">Product color</label>
                                          <input type="text" name="product_color[]" class="form-control product_color_edit" value=""
                                        id="product_color${addMoreImagefordiffentcolorContainerediteditId}" autocompvare="off">
                                         <span id="product_color.${addMoreImagefordiffentcolorContainerediteditId-1}edit" style="color: red;"></span>
                                       </div>

                                      
                                       </div>



                                    </div>
                                 <div class="col-md-12 px-5 d-flex justify-content-end">
                                  <span class="btn btn-success btn-sm px-3" id="" onclick="addMoreColorImageEdit(${addMoreImagefordiffentcolorContainerediteditId})">+</span>
                        </div>
                       

                       <div class="row">
                     <div class="col-md-12 pl-2">
                           <label for="inputAddress" class="form-label">Please select Image</label>
                <div class="form">

        <div class="grid product_color_image_gallery_edit" id="product_color_gallery_edit_${addMoreImagefordiffentcolorContainerediteditId}">
            <div class="form-element" onclick="previewBeforeUploadEdit(this,'file-color-edit-${addMoreImagefordiffentcolorContainerediteditId}-${addMoreImagefordiffentcolorContainerediteditId}')">
                <input type="file"  name="product_color_image_gallery_edit[${addMoreImagefordiffentcolorContainerediteditId}][]" id="file-color-edit-${addMoreImagefordiffentcolorContainerediteditId}-${addMoreImagefordiffentcolorContainerediteditId}"
                    accept="image/*">
                <label for="file-color-edit-${addMoreImagefordiffentcolorContainerediteditId}-${addMoreImagefordiffentcolorContainerediteditId}" id="file-color-edit-${addMoreImagefordiffentcolorContainerediteditId}-${addMoreImagefordiffentcolorContainerediteditId}-preview">
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
                    <span class="btn btn-danger btn-sm px-3" onclick="removeColorImageGalleryEdit('addMoreImagefordiffentcolorContaineredit${addMoreImagefordiffentcolorContainerediteditId}')">-</span>
                </div>




</div>`;

        $("#addMoreImagefordiffentcolorContaineredit").append(addMoreImagefordiffentcolorContainereditHTML);
        reIndexingcolorImagegalleryEdit();

    }











    // var imagecolorintialId = 1;

    // function addMoreImagefordiffentcolor() {
    //     imagecolorintialId++;

    //     var imageColorContainerHTML = `<div class="form-element" id="imagecontainer-color-${imagecolorintialId}" onclick="previewBeforeUploadEdit('file-color-edit-${imagecolorintialId}')">
    //                                 <input type="file" name="product_image_gallery[]" id="file-color-edit-${imagecolorintialId}"
    //                                     accept="image/*">
    //                                 <label for="file-color-edit-${imagecolorintialId}" id="file-color-edit-${imagecolorintialId}-preview">
    //                                     <img src="{{ asset('img/imagepreviewupload.jpg') }}">
    //                                     <div>
    //                                         <span>+</span>

    //                                     </div>
    //                                     <div>
    //                                     <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElementEdit('imagecontainer-color-${imagecolorintialId}')">-</span>
    //                                </div>
    //                                     </label>





    //                             </div>`;

    //     $("#product_color_gallery_edit").append(imageColorContainerHTML);

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
                    <span class="btn btn-danger btn-sm px-3" onclick="removeElementEdit('morediscountcontainer${discountcontainer}')">-</span>
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





    function addMoreProductspecificationEdit() {


        productspecificationedit++;

        var specificationHTMLEdit = `  <div class="row" id="productspecificationedit${productspecificationedit}">
                                        <div class="col-md-6  mt-5" id="specification_heading_edit${productspecificationedit}">
                                                 <label for="product_specification_heading_edit${productspecificationedit-1}" class="form-label">Specification Heading</label>
                                                 <select  name="product_specification[${productspecificationedit-1}][heading]"
                                                  class="form-select selectspecficationindexchangeEdit">
                                                  ${specification_heading_html_edit}
                                                  </select>
                                                  <span class="spanselectspecficationindexchangeEdit" id="product_specification.${productspecificationedit-1}.headingedit" style="color: red;"></span>
                                         </div>
                                                    <div class="col-md-6  mt-5" >
                      
                                                        <label for="product_specfication${productspecificationedit-1}" class="form-label">Name</label>
                                                        <input type="text" name="product_specification[${productspecificationedit-1}][name]" class="form-control productspecificationchangename "
                                                        id="product_specfication${productspecificationedit-1}" autocompvare="off">
                                                        <span class="spanproductspecificationchangename" id="product_specification.${productspecificationedit-1}.nameedit" style="color: red;"></span>
                                                    </div>
                    
                                        <div class="col-md-12 ">
                       
                                                   <label for="product_specification_details_edit${productspecificationedit-1}" class="form-label">Detail</label>
                                            <div class="form-floating">
                                                <textarea class="form-control productspecificationchangetextarea" name="product_specification[${productspecificationedit-1}][detail]" placeholder="Leave a comment here"
                                                 id="product_specification_details_edit${productspecificationedit-1}" style="height: 100px"></textarea>
                                                 <span  class="spanproductspecificationchangetextarea"   id="product_specification.${productspecificationedit-1}.detailedit" style="color: red;"></span>
                                             </div>
                    
                                          <div class="col-md-12 px-5 d-flex justify-content-end">
                                           <span class="btn btn-danger btn-sm px-3" onclick="removeElementSpecficationEdit('productspecificationedit${productspecificationedit}')">-</span>
                                          </div>
                                     </div>
                                </div>`;

        $("#productspecfictaioncontaineredit").append(specificationHTMLEdit);
        // $(`#product_specification_heading_edit${productspecificationedit-1}`).select2();

        $('.selectspecficationindexchangeEdit').select2();


        ClassicEditor.create(
                document.querySelector(
                    `#product_specification_details_edit${productspecificationedit-1}`
                ), {
                    ckfinder: {
                        uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                    },
                }
            )
            .then((newEditor) => {
                productspecificationTextareaEdit.push(newEditor);
            })
            .catch((error) => {
                console.error(error);
            });


    }



    function addMoreColorStockMeasurmentFiledEdit(id) {
        console.log(id);
        let domid = id;
        colorStockContainerIndex++;
        var colorStcokHtml = `
        <div class="row " id="colorstockcontainer${domid}${colorStockContainerIndex}">
        <div class="col-md-5 py-3">
                                        <label for="product_color_type_edit" class="form-label">Color
                                            (optional)</label>
                                        <input type="text" id="product_color_type_edit${domid}${colorStockContainerIndex}" name="product_measurment_price_detail[${domid}][color][]"/>
                                                                           
                                    </div>

                                    <div class="col-md-5 py-3">
                                        <label for="product_stock_quantity_color_edit${domid}${colorStockContainerIndex}" class="form-label">Product Stock
                                            Color wise (optional)</label>
                                        <input type="number"
                                            name="product_measurment_price_detail[${domid}][stock_color_wise][]"
                                            class="form-control" id="product_stock_quantity_color_edit${domid}${colorStockContainerIndex}" autocompvare="off">
                                    </div>

                                    <div class="col-md-2 py-3">
                                        
                                           
                                                <span class="btn btn-danger btn-sm px-3" onclick="removeElementEdit('colorstockcontainer${domid}${colorStockContainerIndex}')">-</span>
                                                
                                     
                                    </div></div>`;
        $(`#colorstockedit${domid}`).append(colorStcokHtml);
        // $(`#product_color_type_edit${domid}${colorStockContainerIndex}`).select2();


    }

    // var newColorStockIndex = 0;

    // function addNewMoreColorStockMeasurmentFiled(colorStockIndex) {

    //     newColorStockIndex++;
    //     var colorNewStockHtml = `  
    //     <div class="row" id="colorstockcontainer${colorStockIndex}${newColorStockIndex}">
    //     <div class="col-md-5 py-3">
    //                                     <label for="product_color_type_edit${colorStockIndex}${newColorStockIndex}" class="form-label">Select color
    //                                         (optional)</label>
    //                                     <select id="product_color_type_edit${colorStockIndex}${newColorStockIndex}" name="product_measurment_price_detail[${colorStockIndex}][color][]"
    //                                         class="form-select">
    //                                         <option selected> Please select option</option>
    //                                         <option value="red">Red</option>
    //                                         <option value="green">Green</option>

    //                                     </select>
    //                                 </div>

    //                                 <div class="col-md-5 py-3">
    //                                     <label for="product_stock_quantity_edit${colorStockIndex}${newColorStockIndex}" class="form-label">Product Stock
    //                                         Color wise (optional)</label>
    //                                     <input type="number"
    //                                         name="product_measurment_price_detail[${colorStockIndex}][stock_color_wise][]"
    //                                         class="form-control" id="product_stock_quantity_edit${colorStockIndex}${newColorStockIndex}" autocompvare="off">
    //                                 </div>


    //                                     <div class="col-md-2 py-3">

    //                                             <span class="btn btn-danger btn-sm px-3" onclick="removeElementEdit('colorstockcontainer${colorStockIndex}${newColorStockIndex}')">-</span>

    //                                 </div>`;
    //     $(`#newcolorstockcontainer${colorStockIndex}`).append(colorNewStockHtml);
    //     $(`#product_color_type_edit${colorStockIndex}${newColorStockIndex}`).select2();

    // }







    function productpricedetailEdit() {
        productpricedetailIdindexedit++;

        console.log(productpricedetailIdindexedit);

        var productpricedetailHTML = `<div class="row p-3 shadow mt-3" id="productpricecontaineredit${productpricedetailIdindexedit}">
<div class="col-md-3 py-3">
    <label for="product_measurment_quantity_edit${productpricedetailIdindexedit}" class="form-label">Product
        Measurment Quantity</label>
    <input type="text" name="product_measurment_price_detail[${productpricedetailIdindexedit}][measurment_quantity]"
        class="form-control measurmentquantityindexchange" id="product_measurment_quantity_edit${productpricedetailIdindexedit}" autocomplete="off">
    <span  class="spanmeasurmentquantityindexchange"   id="product_measurment_price_detail.${productpricedetailIdindexedit}.measurment_quantityedit"
        style="color: red;"></span>


</div>
<div class="col-md-3 py-3">
    <label for="product_measurment_quantity_price_edit${productpricedetailIdindexedit}" class="form-label">Price(MRP)</label>
    <input type="number" name="product_measurment_price_detail[${productpricedetailIdindexedit}][price]"
        class="form-control measurmentpriceindexchange" id="product_measurment_quantity_price_edit${productpricedetailIdindexedit}" autocomplete="off">
    <span class="spanmeasurmentpriceindexchange" id="product_measurment_price_detail.${productpricedetailIdindexedit-1}.priceedit" style="color: red;"></span>

</div>



<div class="col-md-3 py-3">
    <label for="product_currency_type_edit${productpricedetailIdindexedit}" class="form-label">Currency Type</label>
    <select 
        name="product_measurment_price_detail[${productpricedetailIdindexedit}][currency]" class="form-select measurmentcurrencyindexchange">
        <option selected disabled> Please Select Currency type</option>
        <option value="inr">INR</option>
        <option value="usd">USD</option>

    </select>
    <span class="spanmeasurmentcurrencyindexchange" id="product_measurment_price_detail.${productpricedetailIdindexedit}.currencyedit" style="color: red;"></span>
</div>



<div class="col-md-3 py-3">
    <label for="product_stock_quantity_edit${productpricedetailIdindexedit}" class="form-label">Product Stock
        Quantity</label>
    <input type="number" name="product_measurment_price_detail[${productpricedetailIdindexedit}][stock]"
        class="form-control measurmentstockindexchange" id="product_stock_quantity_edit${productpricedetailIdindexedit}" autocompvare="off">
    <span class="spanmeasurmentstockindexchange" id="product_measurment_price_detail.${productpricedetailIdindexedit}.stockedit" style="color: red;"></span>
</div>

<div id="newcolorstockcontainer${productpricedetailIdindexedit}" class="card mb-2" >
    <div class="row" id="colorstockedit${productpricedetailIdindexedit}">
        <div class="col-md-5 py-3">
            <label for="product_new_color_type${productpricedetailIdindexedit}" class="form-label">Color
                (optional)</label>
            <input id="product_new_color_type${productpricedetailIdindexedit}"
                name="product_measurment_price_detail[${productpricedetailIdindexedit}][color][]" class="form-control"/>
            
        </div>

        <div class="col-md-5 py-3">
            <label for="product_stock_quantity_edit${productpricedetailIdindexedit}" class="form-label">Product Stock
                Color wise (optional)</label>
            <input type="number"
                name="product_measurment_price_detail[${productpricedetailIdindexedit}][stock_color_wise][]"
                class="form-control" id="product_stock_quantity_edit${productpricedetailIdindexedit}" autocompvare="off">
        </div>


        <div class="col-md-2 py-3">
            <span class="btn btn-success btn-sm px-3"
                onclick="addMoreColorStockMeasurmentFiledEdit(${productpricedetailIdindexedit})">+</span>

        </div>

    </div>
</div>








<div class="col-md-12 px-5 d-flex justify-content-end">
    <span class="btn btn-danger btn-sm px-3"
        onclick="removeElementProductPriceDetailEdit('productpricecontaineredit${productpricedetailIdindexedit}')">-</span>
</div>

</div>`;



        $("#productpricecontaineredit").append(productpricedetailHTML);


        // $(`#product_currency_type_edit${productpricedetailIdindexedit}`).select2();

        $('.measurmentcurrencyindexchange').select2();
        //   $(`#product_new_color_type${productpricedetailIdindexedit}`).select2();


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
                    <span class="btn btn-danger btn-sm px-3" onclick="removeElementEdit('otherexpendurecost${otherExpendureId}')">-</span>
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

    function selectSubproductcategoryEdit(selectElement) {
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

    $("#updatevendorproduct").on("click", function(e) {
        e.preventDefault();

        var formData = new FormData($("#vendorformedit")[0]);

        function hasFormDataKey(formData, key) {
            for (var pair of formData.entries()) {
                if (pair[0] === key) {
                    return true;
                }
            }
            return false;
        }



        formData.append("product_discription", product_desc_edit.getData());
        formData.append("product_warrenty", product_warrenty_edit.getData());

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



        // formData.append(
        //     "product_specification[0][detail]",
        //     product_specification_details_edit.getData()

        // );

        // console.log(productspecificationedit, productspecificationTextareaEdit);
        var productspecificationTextareaEditLength = productspecificationTextareaEdit.length;

        console.log(productspecificationTextareaEdit, productspecificationTextareaEditLength);

        for (var i = 0; i < productspecificationTextareaEditLength; i++) {
            if (hasFormDataKey(formData, `product_specification[${i}][heading]`) && hasFormDataKey(formData,
                    `product_specification[${i}][name]`)) {
                formData.append(
                    `product_specification[${i}][detail]`,
                    productspecificationTextareaEdit[i].getData()
                );
            }
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

        // var product_color_image_banner = $('input[name="product_color_banner_image[]"]')[0] productcolorbannerimageedit
        //     .files;


        // $('input[name="product_color_banner_image[]"]').each(function(index, element) {
        $('.productcolorbannerimageedit').each(function(index, element) {

            if ((element.files.length > 0)) {
                var files = element.files;


                for (var i = 0; i < files.length; i++) {
                    formData.append('product_color_banner_image[]',
                        files[i]);
                }



            }
        });










        // for (let i = 0; i < product_color_image_banner.length; i++) {

        //     var file = product_color_image_banner[i];
        //     var reader = new FileReader();
        //     reader.onload = function(e) {
        //         formData.append("product_color_image_banner[]", e.target.result);
        //     };

        //     reader.readAsDataURL(file);
        // }









        for (let i = 0; i <= addMoreImagefordiffentcolorContainerediteditId; i++) {
            console.log(addMoreImagefordiffentcolorContainerediteditId, i);

            if (isset($(`input[name="product_color_image_gallery_edit[${i}][]"]`))) {




                $(`input[name="product_color_image_gallery_edit[${i}][]"]`).each(function(index, element) {

                    if (element.files.length > 0) {
                        var files = element.files;

                        console.log(element.name);


                        for (let j = 0; j < files.length; j++) {
                            formData.append(
                                element.name,
                                files[j]);
                        }



                    }
                });








            }




        }


        $(".product_color_banner_image_existing").each(function(index, element) {


            var value = $(this).val();

            console.log(value);



            formData.append("product_color_banner_image_existing[]", value);

            $(`.product_color_image_gallery_existing${index}`).each(function() {


                var value = $(this).val();


                formData.append(`product_color_image_gallery_existing[${index}][]`, value);
            });





        });



        $('.product_color_edit').each(function(index, element) {
            console.log('Element ' + index + ':', element);
            formData.append('product_color[]', $(this).val());
        });









        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        $.ajax({
            url: "{{ route('vendors.updateproduct') }}",
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

                for (let i = 0; i <= productpricedetailIdindexedit; i++) {

                    $(`[id="product_measurment_price_detail.${i}.measurment_quantityedit"]`).html(
                        " ");
                    $(`[id="product_measurment_price_detail.${i}.stockedit"]`).html(" ");
                    $(`[id="product_measurment_price_detail.${i}.priceedit"]`).html(" ");
                    $(`[id="product_measurment_price_detail.${i}.currencyedit"]`).html(" ");

                }

                for (let k = 0; k <= productspecification; k++) {

                    console.log($(`[id="product_specificationedit.${k}.headingedit"]`).html());
                    $(`[id="product_specificationedit.${k}.headingeditedit"]`).html(" ");
                    $(`[id="product_specificationedit.${k}.detailedit"]`).html(" ");
                    $(`[id="product_specificationedit.${k}.nameedit"]`).html(" ");


                }


                $("#product_categoryedit").html(" ");
                $("#product_titleedit").html(" ");
                $("#product_brand_idedit").html(" ");
                $("#product_quantityedit").html(" ");
                $("#product_discriptionedit").html(" ");
                $("#product_measurment_parameteredit").html(" ");
                $("#product_measurment_unitedit").html(" ");










            },
            success: (data) => {
                toastr.success(
                    "Product Updated Sucessfully"
                );


                $("#loader").html("");
                $("#main_content").removeAttr("class", "demo");
                // hideAddForm();
                hideEditForm();
                dataTable();

            },
            error: function(xhr, status, error) {

                if (xhr.status == 422) {







                    errorMessage = xhr.responseJSON.errormessage;

                    console.log(errorMessage);


                    for (var fieldName in errorMessage) {

                        if (errorMessage.hasOwnProperty(fieldName)) {
                            $(`[id="${fieldName}edit"]`).html(errorMessage[fieldName][0]);
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


    $('#openSpecificationHeadingModalButtonEdit').on('click', function() {

        $('#myModalSpecificationHeadingEdit').modal('show');
        $('#exampleModalSpecificHeadingEdit').html('Add New  Specification Heading');



        $('#submitSpecificationFormEdit').on('click', function() {

            var formData = new FormData();

            formData.append('product_specification_heading_name', $(
                    '#product_specification_heading_name_edit_id')
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

                    $("#product_specification_heading_edit").append(OptionHtml);



                    specification_heading_html = specification_heading_html + OptionHtml;

                    specification_heading_html_edit = specification_heading_html_edit +
                        OptionHtml;

                    $('.selectspecficationindexchangeEdit').each(function() {
                        $(this).append(OptionHtml);
                    });



                    if (isset(productspecificationedit)) {
                        for (let i = 0; i <= productspecificationedit; i++) {
                            $(`#product_specification_heading${i}`).append(OptionHtml);
                            // $(`#product_specification_heading_edit${i}`).append(OptionHtml);



                        }
                    }




                    $('#loader').html('');
                    $('#main_content').removeAttr('class', 'demo');

                    $('#myModalSpecificationHeadingEdit').modal("hide");
                    toastr.success(
                        "Heading  add Sucessfully"
                    );

                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {
                        var errorMessageBrand = xhr.responseJSON.errormessage;

                        for (fieldName in errorMessageBrand) {

                            if (errorMessageBrand.hasOwnProperty(fieldName)) {



                                $(`[id="product_specification_heading_error_edit_id"`).html(
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
