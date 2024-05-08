<div class="col-md-6">
    <label for="" class="form-label">Brand Name</label>
    <div class="input-group">
        <select name="product_brand_id" id="product_brand_main_id" class="form-select" data-live-search="true"
            aria-label="Default select example">
            <option selected disabled>Open this select menu</option>
            @foreach ($product_brands as $data)
                <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
            @endforeach
        </select>

        <button type="button" id="openModalButton" class="btn btn-primary ">Add option</button>

        <span id="product_brand_id" style="color: red;"></span>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal content goes here -->


                        <div class="form-group">
                            <label for="brandName">Brand Name</label>
                            <input type="text" class="form-control" id="brandName" name="brandName">
                            <span id="brandNameError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="brandImage">Choose File</label>

                            <input type="file" class="form-control-file" id="brandImage" onchange="showImage()"
                                name="brandImage">
                            <img src="" id="brandimagepreviewupload" alt="" />
                            <span id="brandImageError" class="text-danger"></span>
                        </div>


                        <button type="button" class="btn btn-primary" id="submitBrandAddForm">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
