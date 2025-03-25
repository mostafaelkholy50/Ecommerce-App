<x-app-layout>
    <style>
        /* تكبير حجم النص داخل الجدول */
        .cart-table,
        .cart-table th,
        .cart-table td {
            font-size: 1.2rem;
            /* عدل القيمة حسب المطلوب */
        }
    </style>

    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <p>All Orders</p>
                        <h1>Orders List</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="cart-table-wrap">
                        @if($checkouts->isEmpty())
                            <p class="alert alert-warning text-center">No orders found.</p>
                        @else
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th></th>
                                        <th>User</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Payment Status</th>
                                        <th>Shipping Status</th>
                                        <th>Total Price</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkouts as $checkout)
                                        <tr class="table-body-row">
                                            <td>
                                                @if (!(strtolower($checkout->payment_status) == 'paid' || strtolower($checkout->shipping_status) == 'shipped'|| strtolower($checkout->shipping_status) == 'delivered'))
                                                    <form action="{{ route('user.checkout.delete', $checkout->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="far fa-window-close"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>{{ $checkout->user->name ?? 'Guest' }}</td>
                                            <td>{{ $checkout->Address }}</td>
                                            <td>{{ $checkout->Phone }}</td>
                                            <td>
                                                @if (strtolower($checkout->payment_status) == 'pending')
                                                    <span class="badge bg-danger text-white">Cash on delivery</span>
                                                @elseif (strtolower($checkout->payment_status) == 'paid')
                                                    <span class="badge bg-success text-white">Payment via wallet</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary text-white">{{ ucfirst($checkout->payment_status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                 @if(strtolower($checkout->shipping_status) == 'pending')
                                                    <span class="badge bg-warning text-dark">
                                                        ⏳ Awaiting Shipment
                                                    </span>
                                                @elseif(strtolower($checkout->shipping_status) == 'shipped')
                                                    <span class="badge bg-primary">
                                                        🚚 Shipped
                                                    </span>
                                                @elseif(strtolower($checkout->shipping_status) == 'delivered')
                                                    <span class="badge bg-success">
                                                        ✅ Delivered
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst($checkout->shipping_status) }}</span>
                                                @endif
                                            </td>
                                            <td>${{ number_format($checkout->total_price, 2) }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#orderDetails{{ $checkout->id }}">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- نقل مودالات التفاصيل خارج الجدول --}}
    @foreach($checkouts as $checkout)
        <div class="modal fade" id="orderDetails{{ $checkout->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order #{{ $checkout->id }} Details</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($checkout->checkoutItems as $checkoutItemsItem)
                                    <tr>
                                        <td><a
                                                href="{{ route('user.single-product', $checkoutItemsItem->product->id) }}">{{ $checkoutItemsItem->product->name ?? 'Unknown Product' }}</a>
                                        </td>
                                        <td>{{ $checkoutItemsItem->quantity }}</td>
                                        <td>${{ number_format($checkoutItemsItem->product->price ?? 0, 2) }}</td>
                                        <td>${{ number_format($checkoutItemsItem->quantity * ($checkoutItemsItem->product->price ?? 0), 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
