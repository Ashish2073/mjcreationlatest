{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}


@include('managedashboard.layout.loader')

<section class="form-sec mt-5">

    <div class="form-group pr-3 mt-5">
        <button onclick="hideAddForm()" style="width: 55px;height:50px;position:absolute;right:33px"
            class="btn-icon btn btn-danger btn-round btn-sm">
            <i class="ti-close"></i>
        </button>
    </div>





    <form class="row g-3" method="post" action="#" id="product_discount_add" name="product_discount_add_form"
        enctype="multipart/form-data">
        @csrf
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
                                <label for="start_date">Start Date <span>*</span></label>
                                <input type="datetime-local" id="start_date" name="start_date" class="mb-4" />
                                <span id="start_date_error" style="color: #ff0000"></span>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date <span>*</span></label>
                                <input type="datetime-local" id="end_date" name="end_date" class="mb-4" />
                                <span id="end_date_error" style="color: #ff0000"></span>
                            </div>
                            <div class="form-group">
                                <label for="discount_title">Discount Title <span>*</span></label>
                                <input type="text" class="form-control" name="discount_title" id="discount_title"
                                    placeholder="Please Enter Discount Title" aria-describedby="inputGroup-sizing-sm">
                                <span id="discount_title_error" style="color: #ff0000"></span>
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
                                        <input type="file" id="discount_banner_image" name="discount_banner_image"
                                            class="drop-zoon__file-input"
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
                                    <textarea class="form-control" name="product_discount_details" placeholder="Leave a comment here"
                                        id="product_discount_details" style="height: 100px"></textarea>
                                    <span id="product_discount_detail_error" style="color: red;"></span>
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
                                    <div class="row" id="choosenproductcontainer">

                                        <h3>Please Select Products.....</h3>
                                        <span id="product_error" style="color: red;"></span>


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
                                    <select name="discount_type" id="discount_type_select_id"
                                        onchange="selectform(this)" class="form-select discount_type_select"
                                        aria-label="Default select example">


                                        <option selected disabled>Please selec Menu </option>
                                        <option value="1">Bulk Discount</option>
                                        <option value="2">Combo Discount</option>

                                    </select>
                                    <span id="discount_type_error" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="col-md-12 card" id="bulkcardcontainer" hidden>


                                <div class="row p-3">
                                    <div class="col-md-4 py-3">
                                        <label for="inputAddress" class="form-label">Product
                                            Quantity</label>
                                        <input type="number" name="bulk_discount[quantity]" class="form-control"
                                            id="bulk_discount_quantity" autocomplete="off">
                                        <span id="bulk_discount.quantity_error" style="color: red;"></span>
                                    </div>
                                    <div class="col-md-4 py-3">
                                        <label for="inputAddress" class="form-label">Discount Amount</label>
                                        <input type="number" name="bulk_discount[amount]" class="form-control"
                                            id="bulk_discount_amount" autocomplete="off">
                                        <span id="bulk_discount.amount_error" style="color: red;"></span>
                                    </div>




                                    <div class="col-md-4 py-3">
                                        <label for="inputcurrency" class="form-label">Type</label>
                                        <select id="bulk_discount_amount_type" name="bulk_discount[amount_type]"
                                            class="form-select">
                                            <option selected disabled> Please Select Type</option>
                                            <option value="0">FlAT</option>
                                            <option value="1">PERCENTAGE</option>

                                        </select>
                                        <span id="bulk_discount.amount_type_error" style="color: red;"></span>
                                    </div>











                                </div>

                            </div>


                            <div class="col-md-12 card" id="combocardcontainer" hidden>


                                <div class="row p-3">

                                    <div class="col-md-6 py-3">
                                        <label for="inputAddress" id="product_measurment_quantity"
                                            class="form-label">Discount Amount</label>
                                        <input type="number" name="combo_discount[amount]" class="form-control"
                                            id="combo_discount_amount" autocomplete="off">
                                        <span id="combo_discount.amount_error" style="color: red;"></span>
                                    </div>




                                    <div class="col-md-6 py-3">
                                        <label for="inputcurrency" class="form-label">Type</label>
                                        <select id="combo_discount_amount_type" name="combo_discount[amount_type]"
                                            class="form-select">
                                            <option selected disabled> Please Select Type</option>
                                            <option value="0">FlAT</option>
                                            <option value="1">PERCENTAGE</option>

                                        </select>
                                        <span id="combo_discount.amount_type_error" style="color: red;"></span>
                                    </div>











                                </div>

                            </div>





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
                        <button class="save-btn" id="productdiscountbutton">save</button>

                    </div>

                </div>

            </div>

        </div>
    </form>
</section>
