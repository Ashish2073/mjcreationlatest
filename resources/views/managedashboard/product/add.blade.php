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

    .select2-selection__rendered {
        width: 287px;
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


    <div class="">
        <div class="form-group d-flex justify-content-end mt-3">
            <button onclick="hideAddForm()" style="width: 55px;height:50px"
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
                <div class="row" id="productcategoryelement">
                    <div class="col-md-4" id="main_product_category">
                        <label for="product_category" class="form-label">Category</label>
                        <select name="product_category[]" id="product_category_main_id"
                            onchange="selectSubproductcategory(this)" class="form-select"
                            aria-label="Default select example">

                            <option selected disabled>Open this select menu</option>
                            @foreach ($product_category as $data)
                                <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                            @endforeach
                        </select>
                        <span id="product_category" style="color: red;"></span>
                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="product_title" class="form-control" id="inputEmail4"
                            autocomplete="off">

                        <span id="product_title" style="color: red;"></span>
                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="row">
                    @include('managedashboard.product.brand')

                </div>

            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="form-label">Product Quantity</label>
                        <input type="number" name="product_quantity" class="form-control" id="inputEmail4"
                            autocomplete="off">

                        <span id="product_quantity" style="color: red;"></span>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <label for="product_desc" class="form-label">Discription</label>
                <div class="form-floating">
                    <textarea class="form-control" id="product_desc" name="product_desc" placeholder="Leave a comment here"
                        style="height: 100px"></textarea>
                    <span id="product_discription" style="color: red;"></span>
                </div>
            </div>

            <div class="col-md-12">
                <label for="product_warrenty" class="form-label">Poduct Warranty Deatails(optional)</label>
                <div class="form-floating">
                    <textarea class="form-control" id="product_warrenty" name="product_warrenty" placeholder="Leave a comment here"
                        style="height: 100px"></textarea>
                </div>
            </div>






            <h4> Product measurment and price detail</h4>

            <div class="col-md-12 card py-4">
                <div class="row">






                    {{-- <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Product Measurment Parameter</label>
                        <select id="product_measurment_parameter_main_id" name="product_measurment_parameter"
                            class="form-select">
                            <option selected disabled> Please Select Parameter</option>
                            <option value="length">Length</option>
                            <option value="weight">Weight</option>
                            <option value="display">Display</option>
                        </select>
                        <span id="product_measurment_parameter" style="color: red;"></span>
                    </div> --}}


                    @include('managedashboard.product.measurmentparameter', [
                        'modal_id' => 'myModalMeasurmentParameterName',
                        'modal_label' => 'exampleModalLabelMeasurmentParameterName',
                        'select_id' => 'product_measurment_parameter_main_id',
                        'selectdata' => $productmeasurmentname,
                        'productbranddataid' => '',
                        'submitbtnid' => 'submitMeasurementParameterForm',
                        'input_name' => 'measurment_parameter_name',
                        'input__id' => 'product_measurment_name_id',
                        'type' => 'text',
                        'span_error_id' => 'mesaurement_parameter_error_id',
                        'openModalButton' => 'openMeasurmentModalButton',
                        'select_name' => 'product_measurment_parameter',
                        'select_label' => 'Product Measurment Parameter',
                        'seletspanerror' => 'product_measurment_parameter',
                    ])











                    {{-- <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Product Measurment Parameter Unit</label>
                        <select id="product_measurment_unit_main" name="product_measurment_unit" class="form-select">
                            <option selected disabled> Unit</option>
                            <option value="m">Meter</option>
                            <option value="gm">Gm</option>
                            <option value="inc">Inch</option>
                        </select>
                        <span id="product_measurment_unit" style="color: red;"></span>
                    </div> --}}


                    @include('managedashboard.product.measurmentparameter', [
                        'modal_id' => 'myModalMeasurmentParameterUnitName',
                        'modal_label' => 'exampleModalLabelMeasurmentParameterUnitName',
                        'select_id' => 'product_measurment_unit_main',
                        'selectdata' => $productmeasurmentunitname,
                        'submitbtnid' => 'submitMeasurementParameterUnitForm',
                        'input_name' => 'measurment_parameter_unit_name',
                        'input__id' => 'product_measurment_unit_name_id',
                        'type' => 'text',
                        'span_error_id' => 'mesaurement_parameter_unit_error_id',
                        'openModalButton' => 'openMeasurmentUnitModalButton',
                        'select_name' => 'product_measurment_unit',
                        'select_label' => 'Product Measurment Unit Name',
                        'seletspanerror' => 'product_measurment_unit',
                    ])



                    <div class="row g-3 form-group">
                        <div class="col-md-12 card " id="productpricecontainer">
                            <div class="col-md-12 py-4 d-flex justify-content-end">
                                <span class="btn btn-success btn-sm px-3" onclick="productpricedetail()">+</span>
                            </div>

                            <div class="row">
                                <div class="col-md-3 py-3">
                                    <label for="inputAddress" id="product_measurment_quantity"
                                        class="form-label">Product
                                        Measurment Amount</label>
                                    <input type="text" name="product_measurment_price_detail[0][measurment_quantity]"
                                        class="form-control" id="product_measurment_quantity" autocomplete="off">
                                    <span id="product_measurment_price_detail.0.measurment_quantity"
                                        style="color: red;"></span>
                                </div>
                                <div class="col-md-3 py-3">
                                    <label for="inputAddress" id="product_measurment_quantity"
                                        class="form-label">Price(MRP)</label>
                                    <input type="number" name="product_measurment_price_detail[0][price]"
                                        class="form-control" id="" autocomplete="off">
                                    <span id="product_measurment_price_detail.0.price" style="color: red;"></span>
                                </div>




                                <div class="col-md-3 py-3">
                                    <label for="inputcurrency" class="form-label">Currency Type</label>
                                    <select id="product_currency_type"
                                        name="product_measurment_price_detail[0][currency]" class="form-select">
                                        <option selected disabled> Please Select Currency type</option>

                                        <option value="inr">INR</option>
                                        <option value="usd">USD</option>

                                    </select>
                                    <span id="product_measurment_price_detail.0.currency" style="color: red;"></span>
                                </div>



                                <div class="col-md-3 py-3">
                                    <label for="product_stock_quantity" class="form-label">Product Stock
                                        Quantity</label>
                                    <input type="number" name="product_measurment_price_detail[0][stock]"
                                        class="form-control" id="product_stock_quantity" autocompvare="off">
                                    <span id="product_measurment_price_detail.0.stock" style="color: red;"></span>
                                </div>

                                <div id="colorstock">
                                    <div class="row" id="colorstockcontainer">
                                        <div class="col-md-5 py-3">
                                            <label for="inputcurrency" class="form-label">color
                                                (optional)</label>
                                            <input type="text" id="product_color_type"
                                                name="product_measurment_price_detail[0][color][]"
                                                class="form-control" />
                                        </div>

                                        <div class="col-md-5 py-2">
                                            <label for="product_stock_quantity" class="form-label">Product Stock
                                                Color wise (optional)</label>
                                            <input type="number"
                                                name="product_measurment_price_detail[0][stock_color_wise][]"
                                                class="form-control" id="product_stock_quantity" autocompvare="off">
                                        </div>

                                        <div class="col-md-2 py-3">

                                            <span class="btn btn-success btn-sm "
                                                onclick="addMoreColorStockMeasurmentFiled()">+</span>


                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>




                </div>


            </div>

            {{-- <h4 class="mt-5">Others Expenditure Product Cost</h4>
                <div class="col-md-12 card py-4" id="otherexpendure">
                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addOtherExpendureCost()">+</span>
                    </div>
                    <div class="row">
                        <div class="col-md-3 px-5">
                            <label for="inputAddress" name="product_other_expenditure[]" class="form-label">Name</label>
                            <input type="text" class="form-control" id="" autocomplete="off">
                        </div>
                        <div class="col-md-3 px-5">
                            <label for="inputAddress" class="form-label">Price</label>
                            <input type="text" class="form-control" name="product_other_price[]" id=""
                                autocomplete="off">
                        </div>

                        <div class="col-md-3 px-5">
                            <label for="inputAddress" class="form-label">Currency Type</label>
                            <select id="inputcurrency" name="product_other_expenditure_currency_type[]"
                                class="form-select">
                                <option selected disabled> Unit</option>
                                <option value="inr">INR</option>
                                <option value="usd">USD</option>

                            </select>
                        </div>

                        <div class="col-md-9 px-5">
                            <label for="product_other_expenditure_resaon" class="form-label">Reason</label>
                            <div class="form-floating">
                                <textarea class="form-control " name="product_other_expenditure_resaon[]" placeholder="Leave a comment here"
                                    id="product_other_expenditure_resaon" style="height: 100px"></textarea>
                            </div>
                        </div>


                    </div>
id="specification_heading"

                </div> --}}




            <h4 class="mt-5">Specification</h4>
            <div class="col-md-12 card py-4" id="productspecfictaioncontainer">
                <div class="col-md-12 px-5 d-flex justify-content-end">
                    <span class="btn btn-success btn-sm px-3" onclick="addMoreProductspecification()">+</span>
                </div>
                <div class="row">

                    @include('managedashboard.product.measurmentparameter', [
                        'modal_id' => 'myModalSpecificationHeading',
                        'modal_label' => 'exampleModalSpecificHeading',
                        'select_id' => 'product_specification_heading',
                        'selectdata' => $product_specification_headings,
                        'submitbtnid' => 'submitSpecificationForm',
                        'input_name' => 'product_specification_heading_name',
                        'input__id' => 'product_specification_heading_name_id',
                        'type' => 'text',
                        'span_error_id' => 'product_specification_heading_error_id',
                        'openModalButton' => 'openSpecificationHeadingModalButton',
                        'select_name' => 'product_specification[0][heading]',
                        'select_label' => 'Specification Heading',
                        'seletspanerror' => 'product_specification.0.heading',
                    ])




                    {{-- <div class="col-md-6 px-5" >
                        <label for="product_specification_heading" class="form-label">Specification Heading</label>
                        <select id="product_specification_heading" name="product_specification[0][heading]"
                            class="form-select ">
                            <option selected disabled>Please Select heading</option>
                            @foreach ($product_specification_headings as $data)
                                <option value="{{ $data->name }}">{{ ucwords($data->name) }}</option>
                            @endforeach


                        </select>
                        <span id="product_specification.0.heading" style="color: red;"></span>
                    </div> --}}


                    <div class="col-md-6 px-5">
                        <label for="product_specification" class="form-label">Name</label>
                        <input type="text" name="product_specification[0][name]" class="form-control"
                            id="product_specification" autocomplete="off">

                        <span id="product_specification.0.name" style="color: red;"></span>
                    </div>
                </div>
                <div class="col-md-12 px-5">
                    <label for="product_specification_details" class="form-label">Detail</label>
                    <div class="form-floating">
                        <textarea class="form-control" name="product_specification[0][detail]" placeholder="Leave a comment here"
                            id="product_specification_details" style="height: 100px"></textarea>
                        <span id="product_specification.0.detail" style="color: red;"></span>
                    </div>


                </div>





            </div>

            {{-- <h4 class="mt-5">Discount Detail</h4>
                <div class="col-md-12 card py-4" id="product_dicount_container">
                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreDiscount()">+</span>
                    </div>

                    <div class="row">
                        <div class="col-md-3 px-5">
                            <label for="discountname" class="form-label">Name</label>
                            <input type="text" id="discountname" class="form-control" name="product_discount_name[]"
                                autocomplete="off">
                        </div>

                        <div class="col-md-3 px-5">
                            <label for="discountpercentage" class="form-label">Amount(in percentage)</label>
                            <input type="text" id="discountpercentage" class="form-control"
                                name="product_discount_percentage[]" autocomplete="off">
                        </div>


                        <div class="col-md-3 px-5">
                            <label for="product_discount_start_date" class="form-label">start Date</label>
                            <input type="date" class="form-control" name="product_discount_start_date[]"
                                id="product_discount_start_date" autocomplete="off">
                        </div>
                        <div class="col-md-3 px-5">
                            <label for="product_discount_end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="product_discount_end_date[]"
                                id="product_discount_end_date" autocomplete="off">
                        </div>

                        <div class="col-md-9 px-5">
                            <label for="product_discount_detail" class="form-label">Deatls</label>
                            <div class="form-floating">
                                <textarea class="form-control" name="product_discount_detail[]" placeholder="Leave a comment here"
                                    id="product_discount_detail" style="height: 100px"></textarea>
                            </div>
                        </div>

                    </div>


                </div> --}}

            <h4 class="mt-5">Product Image</h4>


            <div class="col-md-12 card py-4">

                <div class="col-md-12 pl-2">
                    <label for="inputAddress" class="form-label">Please select banner image of products</label>
                    <div class="form">

                        <div class="grid">
                            <div class="form-element" onclick=" previewBeforeUpload('file-banner')">
                                <input type="file" name="product_banner_image" id="file-banner" accept="image/*">
                                <label for="file-banner" id="file-banner-preview">
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

                            <div class="grid" id="product_gallery">
                                <div class="form-element" onclick="previewBeforeUpload('file-1')">
                                    <input type="file" name="product_image_gallery[]" id="file-1"
                                        accept="image/*">
                                    <label for="file-1" id="file-1-preview">
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
                <span class="btn btn-success btn-sm px-3" onclick="addMoreImagefordiffentcolorContainer()">+</span>
            </div>


            <div class="col-md-12 card py-4" id="addMoreImagefordiffentcolorContainer">

                <div class="col-md-12 pl-2">
                    <label for="inputAddress" class="form-label">Please select banner image of products</label>
                    <div class="form">

                        <div class="grid">
                            <div class="form-element" onclick=" previewBeforeUpload('file-color-banner')">
                                <input type="file" name="product_color_banner_image[]" id="file-color-banner"
                                    accept="image/*">
                                <label for="file-color-banner" id="file-color-banner-preview">
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
                            <span id="product_color.0" style="color: red;"></span>
                        </div>
                        {{-- <div class="col-md-3 py-3">
                            <label for="product_color_stock" class="form-label">Product color Stock</label>
                            <input type="number" name="product_color_stock[]" class="form-control"
                                id="product_color_stock" autocompvare="off">
                        </div> --}}
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
                                <div class="form-element" onclick="previewBeforeUpload('file-color-0-0')">
                                    <input type="file" name="product_color_image_gallery[0][]" id="file-color-0-0"
                                        accept="image/*">
                                    <label for="file-color-0-0" id="file-color-0-0-preview">
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





            <div class="col-md-12 d-flex justify-content-around py-3">
                <button class="btn btn-primary btn-sm px-3" id="savevendorproduct">Save</button>
            </div>


        </form>


    </div>

</section>
