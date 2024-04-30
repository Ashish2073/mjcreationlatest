@extends('managedashboard.layout.main')
@section('title', 'vendor')
@section('content')
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

        <div class="container py-3">


            <div class="row py-4">
                <div class="col-md-12 d-flex justify-content-between">
                    <h3>Product</h3>
                    {{-- <button class="btn btn-success btn-sm ">Add More Product</button> --}}
                </div>
            </div>
            <form class="row g-3" id="vendorform" enctype="multipart/form-data">

                <div class="col-md-12">
                    <div class="row" id="productcategoryelement">
                        <div class="col-md-4" id="main_product_category">
                            <label for="" class="form-label">Category</label>
                            <select name="product_category[]" id="product_category"
                                onchange="selectSubproductcategory(this)" class="form-select"
                                aria-label="Default select example">

                                <option selected disabled>Open this select menu</option>
                                @foreach ($product_category as $data)
                                    <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                                @endforeach
                            </select>



                        </div>




                    </div>







                </div>




                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="product_title" class="form-control" id="inputEmail4"
                                autocomplete="off">
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">
                        @include('managedashboard.product.brand')
                        {{-- <div class="col-md-4">
                            <label for="" class="form-label">Brand Name</label>
                            <select name="product_brandid" class="form-select" aria-label="Default select example">


                                <option selected disabled>Open this select menu</option>
                                @foreach ($product_brands as $data)
                                    <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                                @endforeach
                            </select>

                        </div> --}}
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Product Quantity</label>
                            <input type="number" name="product_quantity" class="form-control" id="inputEmail4"
                                autocomplete="off">
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <label for="product_desc" class="form-label">Discription</label>
                    <div class="form-floating">
                        <textarea class="form-control" id="product_desc" name="product_desc" placeholder="Leave a comment here"
                            style="height: 100px"></textarea>
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
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Product Measurment Parameter</label>
                            <select id="product_measurment_parameter" name="product_measurment_parameter"
                                class="form-select">
                                <option selected disabled> Please Select Parameter</option>
                                <option value="length">Length</option>
                                <option value="weight">Weight</option>
                                <option value="display">Display</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Product Measurment Parameter Unit</label>
                            <select id="product_measurment_unit" name="product_measurment_unit" class="form-select">
                                <option selected disabled> Unit</option>
                                <option value="m">Meter</option>
                                <option value="gm">Gm</option>
                                <option value="inc">Inch</option>
                            </select>
                        </div>



                        <div class="row g-3 form-group">
                            <div class="col-md-12 card " id="productpricecontainer">
                                <div class="col-md-12 py-4 d-flex justify-content-end">
                                    <span class="btn btn-success btn-sm px-3" onclick="productpricedetail()">+</span>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 py-3">
                                        <label for="inputAddress" id="product_measurment_quantity"
                                            class="form-label">Product
                                            Measurment Quantity</label>
                                        <input type="number" name="product_measurment_quantity[]" class="form-control"
                                            id="product_measurment_quantity" autocomplete="off">
                                    </div>
                                    <div class="col-md-3 py-3">
                                        <label for="inputAddress" id="product_measurment_quantity"
                                            class="form-label">Price(MRP)</label>
                                        <input type="number" name="product_measurment_quantity_price[]"
                                            class="form-control" id="" autocomplete="off">
                                    </div>




                                    <div class="col-md-3 py-3">
                                        <label for="inputcurrency" class="form-label">Currency Type</label>
                                        <select id="product_currency_type" name="product_currency_type[]"
                                            class="form-select">
                                            <option selected disabled> Unit</option>
                                            <option value="inr">INR</option>
                                            <option value="usd">USD</option>

                                        </select>
                                    </div>

                                    <div class="col-md-3 py-3">
                                        <label for="product_stock_quantity" class="form-label">Product Stock
                                            Quantity</label>
                                        <input type="number" name="product_stock_quantity[]" class="form-control"
                                            id="product_stock_quantity" autocompvare="off">
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


                </div> --}}




                <h4 class="mt-5">Specification</h4>
                <div class="col-md-12 card py-4" id="productspecfictaioncontainer">
                    <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-success btn-sm px-3" onclick="addMoreProductspecification()">+</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 px-5" id="specification_heading">
                            <label for="product_specification_heading" class="form-label">Specification Heading</label>
                            <select id="product_specification_heading" name="product_specification_heading[]"
                                class="form-select">
                                <option selected disabled>Please Select heading</option>
                                @foreach ($product_specification_headings as $data)
                                    <option value="{{ $data->name }}">{{ ucwords($data->name) }}</option>
                                @endforeach


                            </select>
                        </div>


                        <div class="col-md-6 px-5">
                            <label for="product_specfication" class="form-label">Name</label>
                            <input type="text" name="product_specification[]" class="form-control"
                                id="product_specfication" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 px-5">
                        <label for="product_specification_details" class="form-label">Detail</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="product_specification_details[]" placeholder="Leave a comment here"
                                id="product_specification_details" style="height: 100px"></textarea>

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

                <span class="btn btn-success btn-sm px-3" onclick="addMoreImagefordiffentcolorContainer()">+</span>
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



@endsection

@section('page-script')



    <script>
        $('#product_category').select2();
        $('#product_brand_id').select2();
        $('#product_measurment_parameter').select2();
        $('#product_measurment_unit').select2();
        $('#product_currency_type').select2();
        $('#product_specification_heading').select2();




        var specification_heading = $("#specification_heading").html();

        function isset(variable) {
            return typeof variable !== 'undefined' && variable !== null;
        }





        function removeElement(id) {

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
                                    <span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElement('imagecontainer${multipelimageId}')">-</span>
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


<span class="btn btn-danger justify-content-center" style="font-size:unset !important ;margin-top: 45px;" onclick="removeElement('addMoreImagefordiffentcolorContainer${addMoreImagefordiffentcolorContainerId}')">-</span>


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

        var productspecification = 1;

        var productSpecficationTextarea = [];

        function addMoreProductspecification() {
            productspecification++;

            var specificationHTML = `  <div class="row" id="productspecification${productspecification}">
                           <div class="col-md-6 px-5 mt-5" id="specification_heading${productspecification}">
                           ${specification_heading}
                            </div>
                          <div class="col-md-6 px-5 mt-5" >
                          
                            <label for="product_specfication${productspecification}" class="form-label">Name</label>
                            <input type="text" name="product_specification[]" class="form-control"
                                id="product_specfication${productspecification}" autocompvare="off">
                        </div>
                        
                        <div class="col-md-12 px-5">
                           
                            <label for="product_specification_details${productspecification}" class="form-label">Detail</label>
                            <div class="form-floating">
                            <textarea class="form-control" name="product_specification_details[]" placeholder="Leave a comment here"
                                id="product_specification_details${productspecification}" style="height: 100px"></textarea>
                            </div>
                        
                        <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-danger btn-sm px-3" onclick="removeElement('productspecification${productspecification}')">-</span>
                    </div>
                        

                    </div>`;

            $("#productspecfictaioncontainer").append(specificationHTML);

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

        var productpricedetailId = 1;

        function productpricedetail() {
            productpricedetailId++;

            var productpricedetailHTML = `  <div class="row" id="productpricecontainer${productpricedetailId}">
                        <div class="col-md-3 py-3">
                            <label for="product_measurment_quantity${productpricedetailId}" 
                                class="form-label">Product
                                Measurment Quantity</label>
                            <input type="number" name="product_measurment_quantity[]" class="form-control" id="product_measurment_quantity${productpricedetailId}" autocompvare="off">
                        </div>
                        <div class="col-md-3 py-3">
                            <label for="product_measurment_quantity_price${productpricedetailId}" 
                                class="form-label">Price(MRP)</label>
                            <input type="number" name="product_measurment_quantity_price[]"  class="form-control" id="product_measurment_quantity_price${productpricedetailId}" autocompvare="off">
                        </div>
                       
                        <div class="col-md-3 py-3">
                            <label for="product_currency_type${productpricedetailId}" class="form-label">Currency Type</label>
                            <select id="product_currency_type${productpricedetailId}" name="product_currency_type[]" class="form-select">
                                <option selected disabled> Unit</option>
                                <option value="inr">INR</option>
                                <option value="usd">USD</option>

                            </select>
                        </div>

                        <div class="col-md-3 py-3">
                            <label for="product_stock_quantity${productpricedetailId}" 
                                class="form-label">Product Stock Quantity</label>
                            <input type="number" name="product_stock_quantity[]"  class="form-control" id="product_stock_quantity${productpricedetailId}" autocompvare="off">
                        </div>

                                   
                        <div class="col-md-12 px-5 d-flex justify-content-end">
                        <span class="btn btn-danger btn-sm px-3" onclick="removeElement('productpricecontainer${productpricedetailId}')">-</span>
                    </div>
                        
                    </div>`;



            $("#productpricecontainer").append(productpricedetailHTML);


            $(`#product_currency_type${productpricedetailId}`).select2();

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



            formData.append("product_desc", product_desc.getData());
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
                "product_specification_details[0]",
                product_specification_details.getData()
            );
            var productSpecficationTextareaLength = productSpecficationTextarea.length;
            for (var i = 1; i <= productSpecficationTextareaLength; i++) {
                formData.append(
                    `product_specification_details[${i}]`,
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
                },
                success: (data) => {
                    console.log(data);
                    $("#loader").html("");
                    $("#main_content").removeAttr("class", "demo");
                },
                error: (error) => {},
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
                        $("#product_brand_id").append(brandOptionHtml);

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
    </script>


@endsection
