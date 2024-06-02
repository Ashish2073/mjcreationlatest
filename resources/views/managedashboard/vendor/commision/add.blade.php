<div class="row mb-3">
    <div class="col-md-12">
        <div class="card card-custom">
            <div class="card-body">
                <div class="form-group ">
                    <button onclick="hideAddForm()" style="width: 55px;height:50px;right:73px"
                        class="btn-icon btn btn-danger btn-round btn-sm">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <!-- Vendor Details Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div id="vendorBox" class="row border p-3 mb-3 d-flex justify-content-center">
                            <h5>Vendor Details</h5>
                            <p id="vendorInfo">Click on a table row to see details</p>
                        </div>
                        <span id="vendor_id_error" style="color: red"></span>
                        <table class="table table-bordered vendor_data " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Vendor Name</th>
                                    <th>Vendor Email </th>
                                    <th>Vendor Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Commission on Per Order Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Commission on Per Order</h5>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="perorderamount" placeholder="Enter amount">
                            <span id="perorderamount_error" style="color: red"></span>
                        </div>
                        <label for="type">Select Type</label>
                        <div class="form-group">

                            <select class="form-control productcommisiontype" id="ordertype">
                                <option></option>
                                <option value="flat">Flat</option>
                                <option value="percentage">Percentage</option>
                            </select>
                            <span id="perorderamount_commision_type_error" style="color: red"></span>
                        </div>
                        <button class="btn btn-primary"
                            onclick="saveDataOnPerOrderVendorCommmisionVendorCommmision()">Save</button>
                    </div>
                </div>

                <!-- Commission on Category Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Commission on Category</h5>
                        <div class="form-group">
                            <label for="type">Select Type</label>
                            <select class="form-control vendorcategories" id="vendorcategory">
                                <option></option>
                                <!-- Options go here -->
                            </select>
                        </div>
                        <span id="category_id_error" style="color:red"></span>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="category_commison_amount"
                                placeholder="Enter amount">
                            <span id="categoryamount_error" style="color:red"></span>
                        </div>
                        <label for="type">Select Type</label>
                        <div class="form-group">

                            <select class="form-control productcommisiontype" id="categorytype">
                                <option></option>
                                <option value="flat">Flat</option>
                                <option value="percentage">Percentage</option>
                            </select>
                            <span id="category_commision_type_error" style="color:red"></span>
                        </div>
                        <button class="btn btn-primary" onclick="savecategorycommision()">Save</button>
                    </div>
                </div>

                <!-- Commission on Vendor Product Card -->
                <div class="card">
                    <div class="card-body">
                        <h5>Commission on Vendor Product</h5>
                        <div id="productBox" class="row border p-3 mb-3 d-flex justify-content-center">
                            <h5>Selected Product</h5>
                            <p id="productInfo">Choose a product</p>
                        </div>
                        <table class="table table-bordered vendor-product-table">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows go here -->
                            </tbody>
                        </table>
                        <span id="product_id_error" style="color:red"></span>
                        <div class="form-group">
                            <label for="product_commison_amount">Amount</label>
                            <input type="number" class="form-control" id="product_commison_amount"
                                placeholder="Enter amount">
                            <span id="product_commison_amount_error" style="color: red"></span>
                        </div>
                        <label for="product_commison_type">Select Type</label>
                        <div class="form-group">

                            <select class="form-control productcommisiontype" id="product_commison_type">
                                <option></option>
                                <option value="flat">Flat</option>
                                <option value="percentage">Percentage</option>
                            </select>
                            <span id="product_commision_type_error" style="color:red"></span>
                        </div>
                        <button class="btn btn-primary" onclick="saveProductCommision()">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
