<div class="modal-header">
    <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <div class="container">
        <div class="steps">
            <span class="circle active">1</span>
            <span class="circle">2</span>
            <span class="circle">3</span>
            <span class="circle">4</span>
            <div class="progress-bar">
                <span class="indicator"></span>
            </div>
        </div>
        <div class="buttons">
            <button id="prev" disabled>Previous</button>
            <button id="next">Next</button>
        </div>
    </div>





    @foreach ($orderDetails as $data)
        <div class="row">
            <!-- Address Details Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Address Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Order Accept Person Name</th>
                                <td>{{ $data['acceptor_user_name'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Accept Person Phone no</th>
                                <td>{{ $data['acceptor_user_phone_no'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $data['order_shipping_address'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $data['order_shipping_city'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $data['order_shipping_state'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $data['order_shipping_country'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Pincode</th>
                                <td>{{ $data['order_shipping_pincode'] ?? 'N/A' }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <!-- Payment Details Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ATM Card Last Four Digits</th>
                                <td>1234</td>
                            </tr>
                            <tr>
                                <th>Payment Mode</th>
                                <td>{{ $data['payment_method'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Payment Amount</th>
                                <td>{{ $data['payment_with_currency'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th> Payment Billing Address</th>
                                <td>{{ $data['payment_shipping_address'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Billing City</th>
                                <td>{{ $data['payment_shipping_city'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Billing County</th>
                                <td>{{ $data['payment_shipping_country'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Billing Address Pincode </th>
                                <td>{{ $data['payment_shipping_pincode'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Payment Gateway Response</th>
                                <td>{{ $data['payment_gateway_response'] ?? 'N/A' }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Order Details Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Order Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Order Unique ID</th>
                                <td>{{ $data['order_unique_id'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Total Amount</th>
                                <td>{{ $data['orders_with_currency'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td>{{ $data['order_status'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Billing Address</th>
                                <td>{{ $data['order_billing_address'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Billing City</th>
                                <td>{{ $data['order_billing_city'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Billing State</th>
                                <td>{{ $data['order_billing_state'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Billing Pincode</th>
                                <td>{{ $data['order_billing_pincode'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Billing Country</th>
                                <td>{{ $data['order_billing_country'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Tracking Number</th>
                                <td>{{ $data['order_tracking_number'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Shipping Method</th>
                                <td>{{ $data['order_shipping_method'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Shipping Price</th>
                                <td>{{ $data['orders_shipping_with_currency'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ $data['order_date'] ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <!-- Product Details Card -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Discount Details
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr_No</th>
                                    <th>Discount Name</th>
                                    <th>Discount Amount</th>
                                    <th>Discount Type </th>
                                    <th>Discount Start Date</th>
                                    <th>Discount End Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['discounts'] as $key => $discount)
                                    <tr>

                                        @php $discoun_data=json_decode($discount['discount_data']); @endphp

                                        <td> {{ $key + 1 }}</td>
                                        {{-- <td><img src="path_to_image_1.jpg" alt="Product Image 1" width="100">
                                    </td> --}}
                                        <td>{{ $discount['discount_name'] ?? 'N/A' }}</td>

                                        <td>
                                            {{ $discoun_data->amount ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $discoun_data->amount_type == '1' ? 'Percentage' : 'Flat' }}
                                        </td>
                                        <td>{{ $discount['discount_start_date'] ?? 'N/A' }}</td>
                                        <td>{{ $discount['discount_start_date'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach

                                <!-- Add more products as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="row mt-4">
            <!-- Product Details Card -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Product Details
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SrNo</th>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Product Shope Keeping Unit Name</th>
                                    <th>Product Order Quantity</th>
                                    <th>Product Price</th>
                                    <th>Product Measurment </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['products'] as $key => $discount)
                                    <tr>

                                        <td> {{ $key + 1 }}</td>

                                        <td>{{ $discount['product_title'] ?? 'N/A' }}</td>
                                        <td><img src="{{ asset('product/banner/' . $discount['product_image']) }}"
                                                alt="Product Image 1" width="100">
                                        </td>
                                        <td>{{ $discount['product_sku'] ?? 'N/A' }}</td>
                                        <td>{{ $discount['order_quantity'] ?? 'N/A' }}</td>
                                        <td>{{ $discount['product_price'] ?? 'N/A' }}</td>
                                        <td>{{ $discount['product_measurment'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach

                                <!-- Add more products as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="savestauschanges">Save changes</button>
</div>

<script>
    /* Created by Tivotal */
    progressBar();

    function progressBar() {
        const buttons = document.querySelectorAll("button");
        const progressbar = document.querySelector(".indicator");
        const circles = document.querySelectorAll(".circle");

        let currentStep = 1;

        const updateStep = (e) => {
            //update current step based on button click
            currentStep = e.target.id === "next" ? ++currentStep : --currentStep;

            //loop circles and add or remove class active based on current step value

            circles.forEach((circle, index) => {
                circle.classList[`${index < currentStep ? "add" : "remove"}`]("active");
            });

            //update progress bar based on current step value

            progressbar.style.width = `${
    ((currentStep - 1) / (circles.length - 1)) * 100
  }%`;

            //checking if current step is last or first and enable or disable buttons

            if (currentStep === circles.length) {
                buttons[1].disabled = true;
            } else if (currentStep === 1) {
                buttons[0].disabled = true;
            } else {
                buttons.forEach((button) => (button.disabled = false));
            }
        };

        buttons.forEach((button) => {
            button.addEventListener("click", updateStep);
        });

    }
</script>
