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
</style>


















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






        <div id="dropZoon" class="upload-area__drop-zoon drop-zoon">
            <span class="drop-zoon__icon">
                <i class="bx bxs-file-image"></i>
            </span>
            <p class="drop-zoon__paragraph">Upload Image</p>
            <span id="loadingText" class="drop-zoon__loading-text">Please Wait</span>
            <img src="" alt="Preview Image" id="previewImage" class="drop-zoon__preview-image"
                draggable="false" />
            <input type="file" id="discount_banner_image" name="discount_banner_image" class="drop-zoon__file-input"
                accept="image/jpeg,image/png,image/svg+xml,image/gif" />
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

        <span id="discount_banner_image_error" style="color: #ff0000"></span>




    </div>



</div>
