<x-Admin>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-1 text-primary"></i>
                    <h5 class="mt-3">Users</h5>
                    <h4 class="fw-bold">{{ $usersCount ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body text-center">
                    <i class="bi bi-cart fs-1 text-success"></i>
                    <h5 class="mt-3">Orders</h5>
                    <h4 class="fw-bold">{{ $ordersCount ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body text-center">
                    <i class="bi bi-currency-dollar fs-1 text-warning"></i>
                    <h5 class="mt-3">Revenue</h5>
                    <h4 class="fw-bold">${{ $revenue ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam fs-1 text-danger"></i>
                    <h5 class="mt-3">Products</h5>
                    <h4 class="fw-bold">{{ $productsCount ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</x-Admin>
