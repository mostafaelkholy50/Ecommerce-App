<x-app-layout>
    <!-- Check Out Section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <!-- فورم إدخال البيانات -->
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <!-- عنوان الفواتير -->
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <form id="checkout-form" action="{{ route('user.checkout.store') }}" method="POST">
                                                @csrf
                                                <p><input type="text" name="address" placeholder="Address" required></p>
                                                <p><input type="tel" name="phone" placeholder="Phone" required></p>

                                                <!-- اختيار طريقة الدفع -->
                                                <p>
                                                    <select name="payment_method" id="payment_method" required>
                                                        <option selected disabled>Select Payment Method</option>
                                                        <option value="cash_on_delivery">Cash on Delivery</option>
                                                        <option value="fawry">Fawry Payment</option>
                                                        <!-- يمكن إضافة خيار Stripe هنا لو احتجت -->
                                                        <!-- <option value="stripe">Stripe Payment</option> -->
                                                    </select>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- تفاصيل الطلب -->
                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Your Order Details</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                <tr>
                                    <td>Product</td>
                                    <td>Total</td>
                                </tr>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }} (x{{ $item->quantity }})</td>
                                        <td>${{ $item->getTotalPrice() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody class="checkout-details">
                                <tr>
                                    <td>Total</td>
                                    <td>${{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- زر إتمام الطلب -->
                        <button type="submit" id="place-order-btn" class="cart-btn mt-4">Place Order</button>
                        </form> <!-- نهاية الفورم -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->

    <!-- CSS لتنسيق الـ Select -->
    <style>
        /* تنسيق الـ Select */
        #payment_method {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            font-size: 16px;
            color: #333;
            appearance: none;
            /* لإخفاء السهم الافتراضي */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D'http://www.w3.org/2000/svg'%20width%3D'12'%20height%3D'12'%3E%3Cpath%20fill%3D'%23333'%20d%3D'M2.8%204l3.2%203.2L9.2%204z'%2F%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px 12px;
        }
    </style>
</x-app-layout>
