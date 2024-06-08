{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
{{-- <style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .form-sec {
        background: #d3cbcb70;
        padding-bottom: 200px;
    }

    .discount-head {
        display: flex;
        justify-content: space-between;
    }

    .discount-heading {
        margin-top: 10px;
        display: flex;
        justify-content: left;
        gap: 10px;
    }

    .discount-heading i {
        line-height: 40px;
        font-size: 45px;
    }

    ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
    }

    ul.breadcrumb li {
        display: inline;
        font-size: 1rem;
    }

    ul.breadcrumb li+li:before {
        padding: 8px;
        color: black;
        content: ">\00a0";
    }

    ul.breadcrumb li a {
        color: #0275d8;
        text-decoration: none;
    }

    ul.breadcrumb li a:hover {
        color: #01447e;
        text-decoration: underline;
    }

    .datetime-div {
        border: 1px solid #d3cbcb;
    }

    .datetime-div .heading {
        display: flex;
        justify-content: space-between;
        padding: 10px 0 0 20px;
        font-weight: 600;
    }

    .datetime-div .heading h1 {
        cursor: pointer;
        line-height: 10px;
        padding: 5px 10px;
    }

    .datetime-div .form-div {
        padding: 20px 254px;
        background: #fff;
    }

    .product-info {
        border: 1px solid #d3cbcb;
    }

    .product-info .heading {
        padding: 10px 0 0 20px;
        font-weight: 600;
    }

    .product-info .form-div {
        padding: 20px 224px;
        background: #fff;
    }

    .form-div .form-group {
        display: flex;
        gap: 40px;
    }

    .form-div .form-group label {
        text-align: left;
        width: 200px;
        font-weight: 600;
    }

    .form-div .form-group span {
        color: #080808;
        font-weight: 500;
    }

    .form-check {
        width: 282px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-left: -25px !important;
        color: #000 !important;
        font-weight: 600;
    }

    .form-check-label {
        font-size: 16px;
        color: #0a0909;
        margin-right: 10px;
        /* Adjust margin as needed */
    }

    .product-info .form-check .form-check-input {
        float: right !important;
        margin-left: -1.5em;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
    }

    .plus-icn {
        margin-left: 171px;
    }

    .datetime-div .form-div .form-check {
        margin-left: -236px !important;
        width: 500px !important;
    }

    /* ===============================Image======================================== */
    .upload-area {
        width: 100%;
        max-width: 17rem;
        background-color: var(--clr-white);
        box-shadow: 0 10px 60px rgb(218, 229, 255);
        border: 2px solid var(--clr-light-blue);
        border-radius: 24px;
        padding: 2rem 1.875rem 5rem 1.875rem;
        margin: 0.625rem;
        text-align: center;
    }

    .upload-area--open {
        /* Slid Down Animation */
        animation: slidDown 500ms ease-in-out;
    }

    @keyframes slidDown {
        from {
            height: 28.125rem;
            /* 450px */
        }

        to {
            height: 35rem;
            /* 560px */
        }
    }

    .upload-area__paragraph {
        font-size: 0.9375rem;
        color: gray;
        margin-top: 0;
    }

    .upload-area__tooltip {
        position: relative;
        color: lightskyblue;
        cursor: pointer;
        transition: color 300ms ease-in-out;
    }

    .upload-area__tooltip:hover {
        color: var(--clr-blue);
    }

    .upload-area__tooltip-data {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -125%);
        min-width: max-content;
        background-color: white;
        color: blue;
        border: 1px solid lightblue;
        padding: 0.625rem 1.25rem;
        font-weight: 500;
        opacity: 0;
        visibility: hidden;
        transition: none 300ms ease-in-out;
        transition-property: opacity, visibility;
    }

    .upload-area__tooltip:hover .upload-area__tooltip-data {
        opacity: 1;
        visibility: visible;
    }

    /* Drop Zoon */
    .upload-area__drop-zoon {
        position: relative;
        height: 4.25rem;
        /* 180px */
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        border: 2px dashed lightblue;
        border-radius: 15px;
        margin-top: 2.1875rem;
        cursor: pointer;
        transition: border-color 300ms ease-in-out;
    }

    .upload-area__drop-zoon:hover {
        border-color: blue;
    }

    .drop-zoon__icon {
        display: flex;
        font-size: 3.75rem;
        color: blue;
        transition: opacity 300ms ease-in-out;
    }

    .drop-zoon__paragraph {
        font-size: 0.9375rem;
        color: rgb(15, 15, 15);
        margin: 0;
        margin-top: 0.625rem;
        transition: opacity 300ms ease-in-out;
    }

    .drop-zoon:hover .drop-zoon__icon,
    .drop-zoon:hover .drop-zoon__paragraph {
        opacity: 0.7;
    }

    .drop-zoon__loading-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        color: lightblue;
        z-index: 10;
    }

    .drop-zoon__preview-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 0.3125rem;
        border-radius: 10px;
        display: none;
        z-index: 1000;
        transition: opacity 300ms ease-in-out;
    }

    .drop-zoon:hover .drop-zoon__preview-image {
        opacity: 0.8;
    }

    .drop-zoon__file-input {
        display: none;
    }

    /* (drop-zoon--over) Modifier Class */
    .drop-zoon--over {
        border-color: blue;
    }

    .drop-zoon--over .drop-zoon__icon,
    .drop-zoon--over .drop-zoon__paragraph {
        opacity: 0.7;
    }

    .drop-zoon--Uploaded .drop-zoon__icon,
    .drop-zoon--Uploaded .drop-zoon__paragraph {
        display: none;
    }

    /* File Details Area */
    .upload-area__file-details {
        height: 0;
        visibility: hidden;
        opacity: 0;
        text-align: left;
        transition: none 500ms ease-in-out;
        transition-property: opacity, visibility;
        transition-delay: 500ms;
    }

    /* (duploaded-file--open) Modifier Class */
    .file-details--open {
        height: auto;
        visibility: visible;
        opacity: 1;
    }

    .file-details__title {
        font-size: 1.125rem;
        font-weight: 500;
        color: gray;
    }

    /* Uploaded File */
    .uploaded-file {
        display: flex;
        align-items: center;
        padding: 0.625rem 0;
        visibility: hidden;
        opacity: 0;
        transition: none 500ms ease-in-out;
        transition-property: visibility, opacity;
    }

    /* (duploaded-file--open) Modifier Class */
    .uploaded-file--open {
        visibility: visible;
        opacity: 1;
    }

    .uploaded-file__icon-container {
        position: relative;
        margin-right: 0.3125rem;
    }

    .uploaded-file__icon {
        font-size: 3.4375rem;
        color: blue;
    }

    .uploaded-file__icon-text {
        position: absolute;
        top: 1.5625rem;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.9375rem;
        font-weight: 500;
        color: white;
    }

    .uploaded-file__info {
        position: relative;
        top: -0.3125rem;
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .uploaded-file__info::before,
    .uploaded-file__info::after {
        content: "";
        position: absolute;
        bottom: -0.9375rem;
        width: 0;
        height: 0.5rem;
        background-color: #ebf2ff;
        border-radius: 0.625rem;
    }

    .uploaded-file__info::before {
        width: 100%;
    }

    .uploaded-file__info::after {
        width: 100%;
        background-color: blue;
    }

    /* Progress Animation */
    .uploaded-file__info--active::after {
        animation: progressMove 800ms ease-in-out;
        animation-delay: 300ms;
    }

    @keyframes progressMove {
        from {
            width: 0%;
            background-color: transparent;
        }

        to {
            width: 100%;
            background-color: blue;
        }
    }

    .uploaded-file__name {
        width: 100%;
        max-width: 6.25rem;
        /* 100px */
        display: inline-block;
        font-size: 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .uploaded-file__counter {
        font-size: 1rem;
        color: gray;
    }

    .discount-page .buttons {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .discount-page .buttons .save-btn {
        text-transform: uppercase;
        padding: 5px 20px;
        background: #06569b;
        color: #fff;
        font-weight: 700;
        border: none;
    }

    .discount-page .buttons .back-btn {
        text-transform: uppercase;
        padding: 5px 20px;
        background: #b5b0b0;
        color: #000;
        font-weight: 700;
        border: none;
    }

    /* ==========================================Media Query============================= */
    @media (max-width: 767px) {
        .discount-head {
            display: flex;
            justify-content: left;
            flex-direction: column;
        }

        .datetime-div .form-div {
            padding: 20px;
            background: #fff;
        }

        .product-info .form-div {
            padding: 20px;
            background: #fff;
        }

        .form-div .form-group {
            flex-direction: column;
            display: flex;
            gap: 0;
        }

        .form-div .form-group .mb-4 {
            padding-bottom: 8px;
        }

        .plus-icn {
            display: none;
        }

        ul.breadcrumb li {
            display: inline;
            font-size: 0.6rem;
        }

        .datetime-div .form-div .form-check {
            margin-left: 3px !important;
            width: 100% !important;
        }


    }

    img.card-img-top {
        width: 8vw;
        object-fit: contain;
        */
    }
</style>

<style>
    .error {
        color: #ff0000;
        display: block !important;
    }
</style> --}}

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">


@include('managedashboard.layout.loader')

<section class="form-sec mt-5">

    <div class="form-group pr-3 mt-5">
        <button onclick="hideEditForm()" style="width: 55px;height:50px;position:absolute;right:33px"
            class="btn-icon btn btn-danger btn-round btn-sm">
            <i class="ti-close"></i>
        </button>
    </div>





    <form class="row g-3" method="post" action="#" id="product_discount_add" name="product_discount_add_form"
        enctype="multipart/form-data">
        @csrf


        @foreach ($discountData as $data)
            <div class="container">

                <input type="hidden" id="discount_id" value="{{ $data['discount_id'] }}" />






                <div class="row">
                    <div class="discount-page">
                        <div class="discount-head">
                            <div class="discount-heading">
                                <i class="ti-shopping-cart"></i>
                                <h3>Create New Coupon/Discount</h3>
                            </div>




                        </div>

                        <div class="datetime-div">
                            <div class="heading">
                                <p>Coupan Start Date & End Date</p>
                                <h1>+</h1>
                            </div>

                            <div class="form-div">

                                <div class="form-group">
                                    <label for="start_date_edit">Start Date <span>*</span></label>
                                    <input type="datetime-local" id="start_date_edit" value="{{ $data['start_date'] }}"
                                        name="start_date_edit" class="mb-4" />
                                    <span id="start_date_error_edit" style="color: #ff0000"></span>
                                </div>
                                <div class="form-group">
                                    <label for="end_date_edit">End Date <span>*</span></label>
                                    <input type="datetime-local" id="end_date_edit" value="{{ $data['end_date'] }}"
                                        name="end_date_edit" class="mb-4" />
                                    <span id="end_date_error_edit" style="color: #ff0000"></span>
                                </div>
                                <div class="form-group">
                                    <label for="discount_title_edit">Discount Title <span>*</span></label>
                                    <input type="text" class="form-control" name="discount_title_edit"
                                        id="discount_title_edit" value="{{ $data['discount_title'] }}"
                                        placeholder="Please Enter Discount Title"
                                        aria-describedby="inputGroup-sizing-sm">
                                    <span id="discount_title_error_edit" style="color: #ff0000"></span>
                                </div>

                            </div>
                        </div>
                        <div class="datetime-div my-5">
                            <div class="heading">
                                <p>Discount Details</p>
                            </div>
                            <div class="form-div">





                                <!-- Upload Area -->
                                <div class="form-group">
                                    <label for="coupon-code">Image</label>
                                    <div id="uploadAreaEdit" class="upload-area">
                                        <!-- Header -->
                                        <div class="upload-area__header">
                                            <p class="upload-area__paragraph">
                                                File should be an image
                                                <strong class="upload-area__tooltip">
                                                    Like
                                                    <span class="upload-area__tooltip-data"></span>
                                                    <!-- Data Will be Comes From Js -->
                                                </strong>
                                            </p>
                                        </div>
                                        <!-- End Header -->

                                        <!-- Drop Zoon -->





                                        <div id="dropZoonEdit" class="upload-area__drop-zoon drop-zoon">
                                            <span class="drop-zoon__icon">
                                                <i class="bx bxs-file-image"></i>
                                            </span>
                                            <p class="drop-zoon__paragraph">Upload Image</p>
                                            <span id="loadingTextEdit" class="drop-zoon__loading-text">Please
                                                Wait</span>
                                            <img @if (isset($data['banner_image'])) src="{{ asset('product/banner/' . $data['banner_image']) }}"
                                            @else src="" @endif
                                                alt="Preview Image" id="previewImageedit"
                                                class="drop-zoon__preview-image" draggable="false"
                                                style="display: block;" />
                                            <input type="file" id="discount_banner_image_edit"
                                                name="discount_banner_image_edit" class="drop-zoon__file-input"
                                                accept="image/jpeg,image/png,image/svg+xml,image/gif" />
                                        </div>
                                        <!-- End Drop Zoon -->

                                        <!-- File Details -->
                                        <div id="fileDetailsEdit" class="upload-area__file-details file-details">
                                            <div id="uploadedFileEdit" class="uploaded-file">
                                                <div class="uploaded-file__icon-container">
                                                    <i class="bx bxs-file-blank uploaded-file__icon"></i>
                                                    <span class="uploaded-file__icon-text"></span>
                                                    <!-- Data Will be Comes From Js -->
                                                </div>

                                                <div id="uploadedFileEditInfoedit" class="uploaded-file__info">
                                                    <span class="uploaded-file__name">Proejct 1</span>
                                                    <span class="uploaded-file__counter">0%</span>
                                                </div>
                                            </div>
                                        </div>

                                        <span id="discount_banner_image_error_edit" style="color: #ff0000"></span>


                                        <!-- End File Details -->

                                    </div>

                                    <div class="plus-icn">
                                        <i class="fa fa-plus-square"></i>
                                    </div>

                                </div>
                                <div class="form-group justify-content-center">

                                </div>
                                <!-- End Upload Area -->
                                <div class="form-group my-5">
                                    <label for="product_specification_details" class="form-label">Detail</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="product_discount_details_edit" placeholder="Leave a comment here"
                                            id="product_discount_details_edit" style="height: 100px">{{ $data['details'] }}</textarea>
                                        <span id="product_discount_detail_error_edit" style="color: red;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info my-5">
                            <div class="heading">
                                <p>Product Information</p>
                            </div>
                            <div class="form-div">

                                <section class="bg-light pt-5 pb-5 shadow-sm">
                                    <div class="container">
                                        <div class="row pt-5">
                                            <div class="col-12">
                                                <h3 class="text-uppercase border-bottom mb-4">Choosen Product</h3>
                                            </div>
                                        </div>

                                        <div class="row" id="choosenproductcontaineredit">

                                            <h3>Please Select Products.....</h3>
                                            <span id="product_error_edit" style="color: red;"></span>


                                            @if (isset($data['products']))
                                                @php  $productId=[]; @endphp
                                                @foreach ($data['products'] as $product)
                                                    @php $productId[]=$product['product_id'] ;@endphp
                                                    <div class="col-lg-2 mb-3 d-flex align-items-stretch"
                                                        id="productnewelementedit{{ $product['product_id'] }}">
                                                        <div class="card position-relative">

                                                            <img src="{{ asset('product/banner/' . $product['product_banner_image']) }}"
                                                                class="card-img-top" alt="Card Image"
                                                                style="width:8vw;object-fit:contain">




                                                            <div class="card-body d-flex flex-column">
                                                                <h5 class="card-title">{{ $product['product_title'] }}
                                                                </h5>
                                                                <button type="button"
                                                                    onclick="removeChossenProductElemetEdit('productnewelementedit{{ $product['product_id'] }}',{{ $product['product_id'] }})"
                                                                    class="delete btn btn-danger "><i
                                                                        class="ti-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif


                                        </div>
                                    </div>
                                </section>




                                {{-- <select name="product[]" id="product" class="my-select selectpicker" multiple
                                            data-live-search="true" aria-label="Default select example">


                                            @foreach ($vendorProduct as $data)
                                                <option value="{{ $data->id }}">{{ $data->product_title }}</option>
                                            @endforeach



                                        </select> --}}
                                <table class="data-table table table-striped" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Sr No.</th>
                                            <th>Product Title </th>

                                            <th>Product Image </th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>











                                <div class="form-group mb-3">
                                    <label for="coupon-code">Discount Type</label>
                                    <div class="col-md-4" id="discount_type">
                                        <label for="product_category" class="form-label">Discount Type</label>
                                        <select name="discount_type" id="discount_type_select_edit_id"
                                            onchange="selectformEdit(this)" class="form-select discount_type_select"
                                            aria-label="Default select example">


                                            <option selected disabled>Please selec Menu </option>
                                            <option @if ($data['discount_type'] == '1') selected @endif value="1">
                                                Bulk Discount</option>
                                            <option @if ($data['discount_type'] == '2') selected @endif value="2">
                                                Combo Discount</option>

                                        </select>
                                        <span id="discount_type_error_edit" style="color: red;"></span>
                                    </div>
                                </div>
                                @if ($data['discount_type'] == '1')
                                    <div class="col-md-12 card" id="bulkcardcontaineredit">





                                        <div class="row p-3">
                                            <div class="col-md-4 py-3">
                                                <label for="inputAddress" class="form-label">Product
                                                    Quantity</label>
                                                <input type="number" name="bulk_discount[quantity]"
                                                    class="form-control"
                                                    value="{{ $data['discount_data']['quantity'] }}"
                                                    id="bulk_discount_quantity_edit" autocomplete="off">
                                                <span id="bulk_discount.quantity_error_edit"
                                                    style="color: red;"></span>
                                            </div>
                                            <div class="col-md-4 py-3">
                                                <label for="inputAddress" class="form-label">Discount Amount</label>
                                                <input type="number" name="bulk_discount[amount]"
                                                    class="form-control"
                                                    value="{{ $data['discount_data']['amount'] }}"
                                                    id="bulk_discount_amount_edit" autocomplete="off">
                                                <span id="bulk_discount.amount_error_edit" style="color: red;"></span>
                                            </div>




                                            <div class="col-md-4 py-3">
                                                <label for="inputcurrency" class="form-label">Type</label>
                                                <select id="bulk_discount_amount_type_edit"
                                                    name="bulk_discount[amount_type]" class="form-select">
                                                    <option selected disabled> Please Select Type</option>
                                                    <option @if ($data['discount_data']['amount_type'] == '0') selected @endif
                                                        value="0">FlAT</option>
                                                    <option @if ($data['discount_data']['amount_type'] == '1') selected @endif
                                                        value="1">PERCENTAGE</option>

                                                </select>
                                                <span id="bulk_discount.amount_type_error_edit"
                                                    style="color: red;"></span>
                                            </div>











                                        </div>

                                    </div>
                                @else
                                    <div class="col-md-12 card" id="bulkcardcontaineredit" hidden>





                                        <div class="row p-3">
                                            <div class="col-md-4 py-3">
                                                <label for="inputAddress" class="form-label">Product
                                                    Quantity</label>
                                                <input type="number" name="bulk_discount[quantity]"
                                                    class="form-control" value=""
                                                    id="bulk_discount_quantity_edit" autocomplete="off">
                                                <span id="bulk_discount.quantity_error_edit"
                                                    style="color: red;"></span>
                                            </div>
                                            <div class="col-md-4 py-3">
                                                <label for="inputAddress" class="form-label">Discount Amount</label>
                                                <input type="number" name="bulk_discount[amount]"
                                                    class="form-control" value=""
                                                    id="bulk_discount_amount_edit" autocomplete="off">
                                                <span id="bulk_discount.amount_error_edit" style="color: red;"></span>
                                            </div>




                                            <div class="col-md-4 py-3">
                                                <label for="inputcurrency" class="form-label">Type</label>
                                                <select id="bulk_discount_amount_type_edit"
                                                    name="bulk_discount[amount_type]" class="form-select">
                                                    <option selected disabled> Please Select Type</option>
                                                    <option value="0">FlAT</option>
                                                    <option value="1">PERCENTAGE</option>

                                                </select>
                                                <span id="bulk_discount.amount_type_error_edit"
                                                    style="color: red;"></span>
                                            </div>











                                        </div>

                                    </div>
                                @endif

                                @if ($data['discount_type'] == '2')
                                    <div class="col-md-12 card" id="combocardcontaineredit">


                                        <div class="row p-3">

                                            <div class="col-md-6 py-3">
                                                <label for="inputAddress" id="product_measurment_quantity"
                                                    class="form-label">Discount Amount</label>
                                                <input type="number" value="{{ $data['discount_data']['amount'] }}"
                                                    name="combo_discount[amount]" class="form-control"
                                                    id="combo_discount_amount_edit" autocomplete="off">
                                                <span id="combo_discount.amount_error_edit"
                                                    style="color: red;"></span>
                                            </div>




                                            <div class="col-md-6 py-3">
                                                <label for="inputcurrency" class="form-label">Type</label>
                                                <select id="combo_discount_amount_type_edit"
                                                    name="combo_discount[amount_type]" class="form-select">
                                                    <option selected disabled> Please Select Type</option>
                                                    <option @if ($data['discount_data']['amount_type'] == '0') selected @endif
                                                        value="0">FlAT</option>
                                                    <option @if ($data['discount_data']['amount_type'] == '1') selected @endif
                                                        value="1">PERCENTAGE</option>

                                                </select>
                                                <span id="combo_discount.amount_type_error_edit"
                                                    style="color: red;"></span>
                                            </div>











                                        </div>

                                    </div>
                                @else
                                    <div class="col-md-12 card" id="combocardcontaineredit" hidden>


                                        <div class="row p-3">

                                            <div class="col-md-6 py-3">
                                                <label for="inputAddress" id="product_measurment_quantity"
                                                    class="form-label">Discount Amount</label>
                                                <input type="number" value="" name="combo_discount[amount]"
                                                    class="form-control" id="combo_discount_amount_edit"
                                                    autocomplete="off">
                                                <span id="combo_discount.amount_error_edit"
                                                    style="color: red;"></span>
                                            </div>




                                            <div class="col-md-6 py-3">
                                                <label for="inputcurrency" class="form-label">Type</label>
                                                <select id="combo_discount_amount_type_edit"
                                                    name="combo_discount[amount_type]" class="form-select">
                                                    <option selected disabled> Please Select Type</option>
                                                    <option value="0">FlAT</option>
                                                    <option value="1">PERCENTAGE</option>

                                                </select>
                                                <span id="combo_discount.amount_type_error_edit"
                                                    style="color: red;"></span>
                                            </div>











                                        </div>

                                    </div>
                                @endif




                            </div>
                        </div>
                        {{-- <div class="datetime-div">
                        <div class="heading">
                            <p>Allow Only To Specific User Role</p>
                        </div>
                        <div class="form-div">
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Check to allow only to specific user role
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                        <div class="buttons">
                            <button class="save-btn" id="productdiscountbuttonedit">Update</button>

                        </div>

                    </div>

                </div>

            </div>
        @endforeach
    </form>
</section>

<script>
    // Design By
    // - https://dribbble.com/shots/13992184-File-Uploader-Drag-Drop

    // $('.my-select').selectpicker();


    $('.discount_type_select').select2({
        placeholder: "Open this select menu",
        allowClear: true
    })


    var choosedProductIdEdit = {!! json_encode($productId ?? []) !!};

    choosedProductIdEdit = choosedProductIdEdit.map(Number);





    var productDiscountDetailTextareaEdit;
    ClassicEditor.create(
            document.querySelector(`#product_discount_details_edit`), {
                ckfinder: {
                    uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                },
            }
        )
        .then((newEditor) => {
            productDiscountDetailTextareaEdit = newEditor;
        })
        .catch((error) => {
            console.error(error);
        });


    // Select Upload-Area


    function removeChossenProductElemetEdit(id, productid) {
        console.log(id);
        console.log(productid);
        let index = choosedProductIdEdit.indexOf(productid);

        if (index !== -1) {
            choosedProductIdEdit.splice(index, 1);
        }
        $(`#${id}`).remove();

        console.log(choosedProductIdEdit);

    }








    ProductdataTableEdit();

    function ProductdataTableEdit() {



        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var table = $('.data-table').DataTable({



            stateSave: true,
            "bDestroy": true,
            processing: true,
            serverSide: true,
            fixedHeader: true,

            ajax: {
                url: "{{ route('product.list') }}",
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

                    data: 'product_image',
                    name: 'product_image',
                    orderable: false,
                    searchable: false,

                },


            ],
            language: {
                // Customization for the "Entries per page" text
                lengthMenu: "Show _MENU_ Entries per Page"
            },
            rowCallback: function(row, data) {
                // Apply click event to the row
                $(row).on('click', function() {
                    // Show product name and its ID on console choosedProductIdEdit
                    console.log('Product Name:', data.product_title);
                    console.log('Product ID:', data.id);
                    choosedProductIdEdit.push(data.id);

                    choosenProduct = `<div class="col-lg-2 mb-3 d-flex align-items-stretch" id="productnewelementedit${data.id}">
                                        <div class="card position-relative">

                                            <img src="${data.imgsrc}"
                                                class="card-img-top" alt="Card Image" style="width:8vw;object-fit:contain">
                                        
              
                                         
                                               
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">${data.product_title}</h5>
                                                <button type="button" onclick="removeChossenProductElemetEdit('productnewelementedit${data.id}',${data.id})" class="delete btn btn-danger "><i
                                                        class="ti-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>`;






                    $('#choosenproductcontaineredit').append(choosenProduct);






                });
            }


        });



    };



    function selectformEdit(data) {
        console.log(data.value);
        if (data.value == 1) {

            $("#combocardcontaineredit").attr('hidden', 'true');
            $("#bulkcardcontaineredit").removeAttr('hidden');
            $('#bulk_discount_amount_type_edit').select2();

        } else {
            $("#bulkcardcontaineredit").attr('hidden', 'true');
            $("#combocardcontaineredit").removeAttr('hidden');
            $('#combo_discount_amount_type_edit').select2();

        }

    }






    ProductDiscountEdit();

    function ProductDiscountEdit() {


        const uploadAreaEdit = document.querySelector("#uploadAreaEdit");

        // Select Drop-Zoon Area
        const dropZoonEdit = document.querySelector("#dropZoonEdit");

        console.log(dropZoonEdit);

        // Loading Text
        const loadingTextEdit = document.querySelector("#loadingTextEdit");

        // Slect File Input
        const discount_banner_image_edit = document.querySelector("#discount_banner_image_edit");

        // Select Preview Image
        const previewImageedit = document.querySelector("#previewImageedit");

        // File-Details Area
        const fileDetailsEdit = document.querySelector("#fileDetailsEdit");

        // Uploaded File
        const uploadedFileEdit = document.querySelector("#uploadedFileEdit");

        // Uploaded File Info
        const uploadedFileEditInfoedit = document.querySelector("#uploadedFileEditInfoedit");

        // Uploaded File  Name
        const uploadedFileEditName = document.querySelector(".uploaded-file__name");

        // Uploaded File Icon
        const uploadedFileEditIconText = document.querySelector(
            ".uploaded-file__icon-text"
        );

        // Uploaded File Counter
        const uploadedFileEditCounter = document.querySelector(
            ".uploaded-file__counter"
        );

        // ToolTip Data
        const toolTipData = document.querySelector(".upload-area__tooltip-data");

        // Images Types
        const imagesTypes = ["jpeg", "png", "svg", "gif"];

        // Append Images Types Array Inisde Tooltip Data
        toolTipData.innerHTML = [...imagesTypes].join(", .");

        // When (drop-zoon) has (dragover) Event
        dropZoonEdit.addEventListener("dragover", function(event) {
            // Prevent Default Behavior
            event.preventDefault();

            // Add Class (drop-zoon--over) On (drop-zoon)
            dropZoonEdit.classList.add("drop-zoon--over");
        });

        // When (drop-zoon) has (dragleave) Event
        dropZoonEdit.addEventListener("dragleave", function(event) {
            // Remove Class (drop-zoon--over) from (drop-zoon)
            dropZoonEdit.classList.remove("drop-zoon--over");
        });

        // When (drop-zoon) has (drop) Event
        dropZoonEdit.addEventListener("drop", function(event) {
            // Prevent Default Behavior
            event.preventDefault();

            // Remove Class (drop-zoon--over) from (drop-zoon)
            dropZoonEdit.classList.remove("drop-zoon--over");

            // Select The Dropped File
            const file = event.dataTransfer.files[0];

            // Call Function uploadFile(), And Send To Her The Dropped File :)
            uploadFile(file);
        });

        // When (drop-zoon) has (click) Event
        dropZoonEdit.addEventListener("click", function(event) {
            // Click The (discount_banner_image_edit)
            discount_banner_image_edit.click();
        });

        // When (discount_banner_image_edit) has (change) Event
        discount_banner_image_edit.addEventListener("change", function(event) {
            // Select The Chosen File
            const file = event.target.files[0];

            // Call Function uploadFile(), And Send To Her The Chosen File :)
            uploadFile(file);
        });

        // Upload File Function
        function uploadFile(file) {
            // FileReader()
            const fileReader = new FileReader();
            // File Type
            const fileType = file.type;
            // File Size
            const fileSize = file.size;

            // If File Is Passed from the (File Validation) Function
            if (fileValidate(fileType, fileSize)) {
                // Add Class (drop-zoon--Uploaded) on (drop-zoon)
                dropZoonEdit.classList.add("drop-zoon--Uploaded");

                // Show Loading-text
                loadingTextEdit.style.display = "block";
                // Hide Preview Image
                previewImageedit.style.display = "none";

                // Remove Class (uploaded-file--open) From (uploadedFileEdit)
                uploadedFileEdit.classList.remove("uploaded-file--open");
                // Remove Class (uploaded-file__info--active) from (uploadedFileEditInfoedit)
                uploadedFileEditInfoedit.classList.remove("uploaded-file__info--active");

                // After File Reader Loaded
                fileReader.addEventListener("load", function() {
                    // After Half Second
                    setTimeout(function() {
                        // Add Class (upload-area--open) On (uploadAreaEdit)
                        uploadAreaEdit.classList.add("upload-area--open");

                        // Hide Loading-text (please-wait) Element
                        loadingTextEdit.style.display = "none";
                        // Show Preview Image
                        previewImageedit.style.display = "block";

                        // Add Class (file-details--open) On (fileDetailsEdit)
                        fileDetailsEdit.classList.add("file-details--open");
                        // Add Class (uploaded-file--open) On (uploadedFileEdit)
                        uploadedFileEdit.classList.add("uploaded-file--open");
                        // Add Class (uploaded-file__info--active) On (uploadedFileEditInfoedit)
                        uploadedFileEditInfoedit.classList.add("uploaded-file__info--active");
                    }, 500); // 0.5s

                    // Add The (fileReader) Result Inside (previewImageedit) Source
                    previewImageedit.setAttribute("src", fileReader.result);

                    // Add File Name Inside Uploaded File Name
                    uploadedFileEditName.innerHTML = file.name;

                    // Call Function progressMove();
                    progressMove();
                });

                // Read (file) As Data Url
                fileReader.readAsDataURL(file);
            } else {
                // Else

                this; // (this) Represent The fileValidate(fileType, fileSize) Function
            }
        }

        // Progress Counter Increase Function
        function progressMove() {
            // Counter Start
            let counter = 0;

            // After 600ms
            setTimeout(() => {
                // Every 100ms
                let counterIncrease = setInterval(() => {
                    // If (counter) is equle 100
                    if (counter === 100) {
                        // Stop (Counter Increase)
                        clearInterval(counterIncrease);
                    } else {
                        // Else
                        // plus 10 on counter
                        counter = counter + 10;
                        // add (counter) vlaue inisde (uploadedFileEditCounter)
                        uploadedFileEditCounter.innerHTML = `${counter}%`;
                    }
                }, 100);
            }, 600);
        }

        // Simple File Validate Function
        function fileValidate(fileType, fileSize) {
            // File Type Validation
            let isImage = imagesTypes.filter(
                (type) => fileType.indexOf(`image/${type}`) !== -1
            );

            // If The Uploaded File Type Is 'jpeg'
            if (isImage[0] === "jpeg") {
                // Add Inisde (uploadedFileEditIconText) The (jpg) Value
                uploadedFileEditIconText.innerHTML = "jpg";
            } else {
                // else
                // Add Inisde (uploadedFileEditIconText) The Uploaded File Type
                uploadedFileEditIconText.innerHTML = isImage[0];
            }

            // If The Uploaded File Is An Image
            if (isImage.length !== 0) {
                // Check, If File Size Is 2MB or Less
                if (fileSize <= 2000000) {
                    // 2MB :)
                    return true;
                } else {
                    // Else File Size
                    return alert("Please Your File Should be 2 Megabytes or Less");
                }
            } else {
                // Else File Type
                return alert("Please make sure to upload An Image File Type");
            }


        }


    }



    $("#productdiscountbuttonedit").on("click", function(e) {
        e.preventDefault();

        var formData = new FormData($("#product_discount")[0]);
        let discountImage = $('input[name="discount_banner_image_edit"]')[0].files[0];

        formData.append("start_date", $("#start_date_edit").val());

        formData.append("end_date", $("#end_date_edit").val());

        formData.append("discount_title", $("#discount_title_edit").val());

        formData.append("discount_id", $("#discount_id").val());

        formData.append("discount_banner_image", discountImage);

        formData.append("product_discount_detail", productDiscountDetailTextareaEdit.getData());
        formData.append("discount_type", $("#discount_type_select_edit_id").val());

        if ($("#discount_type_select_edit_id").val() == 1) {

            formData.append("bulk_discount[quantity]", $("#bulk_discount_quantity_edit").val());

            formData.append("bulk_discount[amount]", $("#bulk_discount_amount_edit").val());

            formData.append("bulk_discount[amount_type]", $("#bulk_discount_amount_type_edit").val());
        }


        if ($("#discount_type_select_edit_id").val() == 2) {
            formData.append("combo_discount[amount_type]", $("#combo_discount_amount_type_edit").val());

            formData.append("combo_discount[amount]", $("#combo_discount_amount_edit").val());
        }



        let uniqueArraySelectedProduct = [...new Set(choosedProductIdEdit)];
        const selectedProducts = uniqueArraySelectedProduct;



        if (selectedProducts) {
            selectedProducts.forEach(productId => {
                formData.append('product[]', productId);
            });
        }


        $.ajax({
            url: "{{ route('product.updatediscount') }}",
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

                $('#start_date_error_edit').html(" ");
                $('#end_date_error_edit').html(" ");

                $("#discount_title_error_edit").html(" ");
                $("#discount_banner_image_edit_error_edit").html(" ");

                $("#product_discount_detail_error_edit").html(" ");

                $("#product_error_edit").html(" ");

                $("#discount_type_error_edit").html(" ");

                $("#bulk_discount.amount_error_edit").html(" ");

                $("#bulk_discount.amount_type_error_edit").html(" ");

                $("#combo_discount.amount_error_edit").html(" ");

                $("#combo_discount.amount_type_error_edit").html(" ");


            },
            success: (data) => {
                toastr.success(
                    "Product Discount Updated Sucessfully"
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

                    for (var fieldName in errorMessage) {

                        if (errorMessage.hasOwnProperty(fieldName)) {
                            $(`[id="${fieldName}_error_edit"]`).html(errorMessage[fieldName][
                                0
                            ]);


                        }

                    }



                    window.scrollTo(0, 0);




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
