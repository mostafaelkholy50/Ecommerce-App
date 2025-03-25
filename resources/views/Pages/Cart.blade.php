<x-app-layout>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Trendy & Stylish</p>
                        <h1>Shopping Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        @if ($cartItems->isEmpty())
                            <p class="alert alert-warning text-center">Your cart is empty.</p>
                        @else
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove"></th>
                                        <th class="product-image">Product Image</th>
                                        <th class="product-name">Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr class="table-body-row">
                                            <td class="product-remove">
                                                <form action="{{ route('user.cart.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="far fa-window-close"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="product-image">
                                                <img src="{{ asset('assets/img/products/' . $item->product->image) }}"
                                                    alt="{{ $item->product->name }}">
                                            </td>
                                            <td class="product-name">{{ $item->product->name }}</td>
                                            <td class="product-price">${{ number_format($item->product->price, 2) }}</td>
                                            <td class="product-quantity">
                                                <input type="number" class="form-control quantity-input"
                                                    data-id="{{ $item->id }}" value="{{ $item->quantity }}" min="1"
                                                    style="width: 80px;">
                                            </td>
                                            <td class="product-total">
                                                ${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td id="total-price">${{ number_format($totalCartPrice, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if (!$cartItems->isEmpty())
                            <div class="cart-buttons">
                                <a href="{{ route('user.checkout')  }}" class="boxed-btn black">Check Out</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->

    <!-- jQuery & AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".quantity-input").on("change", function () {
                let id = $(this).data("id");
                let quantity = $(this).val();

                $.ajax({
                    url: "{{ route('user.cart.update') }}",
                    method: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        quantity: quantity
                    },
                    success: function (response) {
                        location.reload(); // تحديث الصفحة بعد التعديل
                    },
                    error: function (xhr) {
                        alert("Something went wrong!");
                    }
                });
            });
        });
    </script>
</x-app-layout>
