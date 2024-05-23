@extends('managedashboard.layout.main')
@section('title', 'Product List')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
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
</style>

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

@section('content')
    <section class="form-sec">
        <div class="container">
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
                                <label for="start-date">Start Date <span>*</span></label>
                                <input type="datetime-local" id="start-date" name="start-date" class="mb-4" required />
                            </div>
                            <div class="form-group">
                                <label for="end-date">End Date <span>*</span></label>
                                <input type="datetime-local" id="end-date" name="end-date" class="mb-4" required />
                            </div>
                            <div class="form-group">
                                <label for="discount_title">Discount Title <span>*</span></label>
                                <input type="text" class="form-control" id="discount_title"
                                    placeholder="Please Enter Discount Title" aria-describedby="inputGroup-sizing-sm">
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
                                <div id="uploadArea" class="upload-area">
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
                                    <div id="dropZoon" class="upload-area__drop-zoon drop-zoon">
                                        <span class="drop-zoon__icon">
                                            <i class="bx bxs-file-image"></i>
                                        </span>
                                        <p class="drop-zoon__paragraph">Upload Image</p>
                                        <span id="loadingText" class="drop-zoon__loading-text">Please Wait</span>
                                        <img src="" alt="Preview Image" id="previewImage"
                                            class="drop-zoon__preview-image" draggable="false" />
                                        <input type="file" id="fileInput" class="drop-zoon__file-input"
                                            accept="image/*" />
                                    </div>
                                    <!-- End Drop Zoon -->

                                    <!-- File Details -->
                                    <div id="fileDetails" class="upload-area__file-details file-details">
                                        <div id="uploadedFile" class="uploaded-file">
                                            <div class="uploaded-file__icon-container">
                                                <i class="bx bxs-file-blank uploaded-file__icon"></i>
                                                <span class="uploaded-file__icon-text"></span>
                                                <!-- Data Will be Comes From Js -->
                                            </div>

                                            <div id="uploadedFileInfo" class="uploaded-file__info">
                                                <span class="uploaded-file__name">Proejct 1</span>
                                                <span class="uploaded-file__counter">0%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End File Details -->
                                </div>
                                <div class="plus-icn">
                                    <i class="fa fa-plus-square"></i>
                                </div>
                            </div>
                            <!-- End Upload Area -->
                            <div class="form-group my-5">
                                <label for="product_specification_details" class="form-label">Detail</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="product_discount_details" placeholder="Leave a comment here"
                                        id="product_discount_details" style="height: 100px"></textarea>
                                    <span id="product_discount_details" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info my-5">
                        <div class="heading">
                            <p>Product Information</p>
                        </div>
                        <div class="form-div">



                            <div class="form-group mb-3">
                                <label for="coupon-code">Products</label>
                                <div class="col-md-4" id="Product_detail">
                                    <label for="product" class="form-label">Products</label>
                                    <select name="product[]" id="product" class="my-select selectpicker" multiple
                                        data-live-search="true" aria-label="Default select example">


                                        @foreach ($vendorProduct as $data)
                                            <option value="{{ $data->id }}">{{ $data->product_title }}</option>
                                        @endforeach



                                    </select>
                                    <span id="product_category" style="color: red;"></span>
                                </div>


                            </div>







                            <div class="form-group mb-3">
                                <label for="coupon-code">Discount Type</label>
                                <div class="col-md-4" id="discount_type">
                                    <label for="product_category" class="form-label">Discount Type</label>
                                    <select name="discount_type" id="discount_type_select_id" onchange="selectform(this)"
                                        class="form-select discount_type_select" aria-label="Default select example">


                                        <option selected disabled>Please selec Menu </option>
                                        <option value="1">Bulk Discount</option>
                                        <option value="2">Combo Discount</option>

                                    </select>
                                    <span id="product_category" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="col-md-12 card" id="bulkcardcontainer" hidden>


                                <div class="row p-3">
                                    <div class="col-md-4 py-3">
                                        <label for="inputAddress" class="form-label">Product
                                            Quantity</label>
                                        <input type="number" name="bulk_product_quantity" class="form-control"
                                            id="bulk_product_quantity" autocomplete="off">
                                        <span id="bulk_product_quantity" style="color: red;"></span>
                                    </div>
                                    <div class="col-md-4 py-3">
                                        <label for="inputAddress" class="form-label">Discount Amount</label>
                                        <input type="number" name="bulk_discount_amount" class="form-control"
                                            autocomplete="off">
                                        <span id="bulk_discount_amount" style="color: red;"></span>
                                    </div>




                                    <div class="col-md-4 py-3">
                                        <label for="inputcurrency" class="form-label">Type</label>
                                        <select id="select_bulk_amount_type" name="bulk_amount_type" class="form-select">
                                            <option selected disabled> Please Select Type</option>
                                            <option value="0">FlAT</option>
                                            <option value="1">PERCENTAGE</option>

                                        </select>
                                        <span id="bulk_amount_type" style="color: red;"></span>
                                    </div>











                                </div>

                            </div>


                            <div class="col-md-12 card" id="combocardcontainer" hidden>


                                <div class="row p-3">

                                    <div class="col-md-6 py-3">
                                        <label for="inputAddress" id="product_measurment_quantity"
                                            class="form-label">Discount Amount</label>
                                        <input type="number" name="combo_discount_amount" class="form-control"
                                            id="" autocomplete="off">
                                        <span id="combo_discount_amount" style="color: red;"></span>
                                    </div>




                                    <div class="col-md-6 py-3">
                                        <label for="inputcurrency" class="form-label">Type</label>
                                        <select id="select_combo_amount_type" name="combo_amount_type"
                                            class="form-select">
                                            <option selected disabled> Please Select Type</option>
                                            <option value="0">FlAT</option>
                                            <option value="1">PERCENTAGE</option>

                                        </select>
                                        <span id="combo_amount_type" style="color: red;"></span>
                                    </div>











                                </div>

                            </div>





                        </div>
                    </div>
                    <div class="datetime-div">
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
                    </div>
                    <div class="buttons">
                        <button class="save-btn">save</button>
                        <button class="back-btn">back to discounts</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script>
        // Design By
        // - https://dribbble.com/shots/13992184-File-Uploader-Drag-Drop
        $('.my-select').selectpicker();


        $('.discount_type_select').select2({
            placeholder: "Open this select menu",
            allowClear: true
        })


        // Select Upload-Area



        function selectform(data) {
            console.log(data.value);
            if (data.value == 1) {

                $("#combocardcontainer").attr('hidden', 'true');
                $("#bulkcardcontainer").removeAttr('hidden');
                $('#select_bulk_amount_type').select2();

            } else {
                $("#bulkcardcontainer").attr('hidden', 'true');
                $("#combocardcontainer").removeAttr('hidden');
                $('#select_combo_amount_type').select2();

            }

        }






        ProductDiscount();

        function ProductDiscount() {

            let productDiscountDetailTextarea = [];
            ClassicEditor.create(
                    document.querySelector(`#product_discount_details`), {
                        ckfinder: {
                            uploadUrl: `{{ route('product-textarea-image-upload') . '?_token=' . csrf_token() }}`,
                        },
                    }
                )
                .then((newEditor) => {
                    productDiscountDetailTextarea.push(newEditor);
                })
                .catch((error) => {
                    console.error(error);
                });







            const uploadArea = document.querySelector("#uploadArea");

            // Select Drop-Zoon Area
            const dropZoon = document.querySelector("#dropZoon");

            // Loading Text
            const loadingText = document.querySelector("#loadingText");

            // Slect File Input
            const fileInput = document.querySelector("#fileInput");

            // Select Preview Image
            const previewImage = document.querySelector("#previewImage");

            // File-Details Area
            const fileDetails = document.querySelector("#fileDetails");

            // Uploaded File
            const uploadedFile = document.querySelector("#uploadedFile");

            // Uploaded File Info
            const uploadedFileInfo = document.querySelector("#uploadedFileInfo");

            // Uploaded File  Name
            const uploadedFileName = document.querySelector(".uploaded-file__name");

            // Uploaded File Icon
            const uploadedFileIconText = document.querySelector(
                ".uploaded-file__icon-text"
            );

            // Uploaded File Counter
            const uploadedFileCounter = document.querySelector(
                ".uploaded-file__counter"
            );

            // ToolTip Data
            const toolTipData = document.querySelector(".upload-area__tooltip-data");

            // Images Types
            const imagesTypes = ["jpeg", "png", "svg", "gif"];

            // Append Images Types Array Inisde Tooltip Data
            toolTipData.innerHTML = [...imagesTypes].join(", .");

            // When (drop-zoon) has (dragover) Event
            dropZoon.addEventListener("dragover", function(event) {
                // Prevent Default Behavior
                event.preventDefault();

                // Add Class (drop-zoon--over) On (drop-zoon)
                dropZoon.classList.add("drop-zoon--over");
            });

            // When (drop-zoon) has (dragleave) Event
            dropZoon.addEventListener("dragleave", function(event) {
                // Remove Class (drop-zoon--over) from (drop-zoon)
                dropZoon.classList.remove("drop-zoon--over");
            });

            // When (drop-zoon) has (drop) Event
            dropZoon.addEventListener("drop", function(event) {
                // Prevent Default Behavior
                event.preventDefault();

                // Remove Class (drop-zoon--over) from (drop-zoon)
                dropZoon.classList.remove("drop-zoon--over");

                // Select The Dropped File
                const file = event.dataTransfer.files[0];

                // Call Function uploadFile(), And Send To Her The Dropped File :)
                uploadFile(file);
            });

            // When (drop-zoon) has (click) Event
            dropZoon.addEventListener("click", function(event) {
                // Click The (fileInput)
                fileInput.click();
            });

            // When (fileInput) has (change) Event
            fileInput.addEventListener("change", function(event) {
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
                    dropZoon.classList.add("drop-zoon--Uploaded");

                    // Show Loading-text
                    loadingText.style.display = "block";
                    // Hide Preview Image
                    previewImage.style.display = "none";

                    // Remove Class (uploaded-file--open) From (uploadedFile)
                    uploadedFile.classList.remove("uploaded-file--open");
                    // Remove Class (uploaded-file__info--active) from (uploadedFileInfo)
                    uploadedFileInfo.classList.remove("uploaded-file__info--active");

                    // After File Reader Loaded
                    fileReader.addEventListener("load", function() {
                        // After Half Second
                        setTimeout(function() {
                            // Add Class (upload-area--open) On (uploadArea)
                            uploadArea.classList.add("upload-area--open");

                            // Hide Loading-text (please-wait) Element
                            loadingText.style.display = "none";
                            // Show Preview Image
                            previewImage.style.display = "block";

                            // Add Class (file-details--open) On (fileDetails)
                            fileDetails.classList.add("file-details--open");
                            // Add Class (uploaded-file--open) On (uploadedFile)
                            uploadedFile.classList.add("uploaded-file--open");
                            // Add Class (uploaded-file__info--active) On (uploadedFileInfo)
                            uploadedFileInfo.classList.add("uploaded-file__info--active");
                        }, 500); // 0.5s

                        // Add The (fileReader) Result Inside (previewImage) Source
                        previewImage.setAttribute("src", fileReader.result);

                        // Add File Name Inside Uploaded File Name
                        uploadedFileName.innerHTML = file.name;

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
                            // add (counter) vlaue inisde (uploadedFileCounter)
                            uploadedFileCounter.innerHTML = `${counter}%`;
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
                    // Add Inisde (uploadedFileIconText) The (jpg) Value
                    uploadedFileIconText.innerHTML = "jpg";
                } else {
                    // else
                    // Add Inisde (uploadedFileIconText) The Uploaded File Type
                    uploadedFileIconText.innerHTML = isImage[0];
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

        // Upload File Function

        // :)
    </script>
@endsection
