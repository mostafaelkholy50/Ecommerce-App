<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <!-- Category Section -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-tags"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="category-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.CreateCategory') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.ShowCategories') }}">
                        <i class="bi bi-circle"></i><span>Show</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Category Section -->

        <!-- Products Section -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="products-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.CreateProducts') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.ShowProduct') }}">
                        <i class="bi bi-circle"></i><span>Show</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Products Section -->

        <!-- Orders Section -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#orders-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cart-check"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="orders-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.ShowOrders') }}">
                        <i class="bi bi-circle"></i><span>Show</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Orders Section -->

    </ul>
</aside>
