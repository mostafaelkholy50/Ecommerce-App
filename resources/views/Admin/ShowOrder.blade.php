<x-admin>
    <!-- Filter Buttons -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills justify-content-center mb-4">
                <li class="nav-item">
                    <a class="nav-link filter-btn active" data-filter="all" href="#">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-btn" data-filter="pending" href="#">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-btn" data-filter="shipped" href="#">Shipped</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-btn" data-filter="delivered" href="#">Delivered</a>
                </li>
            </ul>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Orders Table -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="cart-table-wrap">
                        @if($checkouts->isEmpty())
                            <p class="alert alert-warning text-center">No orders found.</p>
                        @else
                            <table class="table table-striped cart-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Action</th>
                                        <th>User</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Payment Status</th>
                                        <th>Shipping Status</th>
                                        <th>Total Price</th>
                                        <th>Details</th>
                                        <th>Ship</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkouts as $checkout)
                                        <tr class="order-row {{ strtolower($checkout->shipping_status) }}">
                                            <td>
                                            @if (!(strtolower($checkout->payment_status) == 'paid' || strtolower($checkout->shipping_status) == 'shipped'|| strtolower($checkout->shipping_status) == 'delivered'))
                                            <form action="{{ route('admin.checkout.delete', $checkout->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>{{ $checkout->user->name ?? 'Guest' }}</td>
                                            <td>{{ $checkout->Address }}</td>
                                            <td>{{ $checkout->Phone }}</td>
                                            <td>
                                                @if (strtolower($checkout->payment_status) == 'pending')
                                                    <span class="badge bg-danger">Cash on delivery</span>
                                                @elseif (strtolower($checkout->payment_status) == 'paid')
                                                    <span class="badge bg-success">Payment via wallet</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($checkout->payment_status) }}</span>
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
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#orderDetails{{ $checkout->id }}">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                @if(strtolower($checkout->shipping_status) == 'pending')
                                                    <form action="{{ route('admin.markShipped', $checkout->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            🚚 Ship Order
                                                        </button>
                                                    </form>
                                                @elseif(strtolower($checkout->shipping_status) == 'shipped')
                                                    <form action="{{ route('admin.markdelivered', $checkout->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            ✅ Mark as Delivered
                                                        </button>
                                                    </form>
                                                @elseif(strtolower($checkout->shipping_status) == 'delivered')
                                                    <span class="badge bg-info text-dark">
                                                         Delivered
                                                    </span>
                                                @endif
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

    <!-- Order Details Modals -->
    @foreach($checkouts as $checkout)
        <div class="modal fade" id="orderDetails{{ $checkout->id }}" tabindex="-1"
            aria-labelledby="orderDetailsLabel{{ $checkout->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsLabel{{ $checkout->id }}">Order #{{ $checkout->id }} Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($checkout->checkoutItems as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.EditProduct', $item->product->id) }}">
                                                {{ $item->product->name ?? 'Unknown Product' }}
                                            </a>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->product->price ?? 0, 2) }}</td>
                                        <td>${{ number_format($item->quantity * ($item->product->price ?? 0), 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- JavaScript Filtering -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterBtns = document.querySelectorAll(".filter-btn");
            const rows = document.querySelectorAll(".order-row");

            filterBtns.forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    const filter = this.getAttribute("data-filter");

                    // Update active class for buttons
                    filterBtns.forEach(b => b.classList.remove("active"));
                    this.classList.add("active");

                    // Show/hide rows based on filter
                    rows.forEach(row => {
                        if (filter === "all" || row.classList.contains(filter)) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                });
            });
        });
    </script>
</x-admin>
