<x-app-layout>
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Trendy & Stylish</p>
                        <h1>Clothing Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <a href="{{ route('user.shop') }}">
                                <li class="active" data-filter="*">All</li>
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('user.product', $category->id) }}">
                                    <li data-filter=".{{ Str::slug($category->slug) }}">{{ $category->name }}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="row justify-content-center align-items-stretch">
                    @if ($products->count() > 0)
                            @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 d-flex {{ Str::slug($product->category->slug) }} mb-4">
                                        <div class="card mb-4 text-center flex-fill">
                                            <img src="{{ asset('assets/img/products/' . $product->image) }}" alt="{{ $product->name }}"
                                                style="height: 250px; object-fit: cover;">
                                            <a href="{{ route('user.single-product', $product->id) }}">
                                                <div class="card-body d-flex flex-column p-3">
                                                    <h3 class="card-title">{{ $product->name }}</h3>
                                                    <p class="product-price flex-grow-1">
                                                        <span>
                                                        {{ Str::limit($product->description, 17) }} </span>
                                                        <br>
                                                        <strong>{{ $product->price }}$</strong>
                                                    </p>
                                            </a>

                                            <!-- فورم لإضافة المنتج إلى السلة -->
                                            <form action="{{ route('user.cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="cart-btn">
                                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p class="alert alert-warning">No products available at the moment.</p>
                        </div>
                    @endif
        </div>
        </section>


        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap align-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
