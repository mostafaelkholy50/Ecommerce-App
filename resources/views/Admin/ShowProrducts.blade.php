<x-admin>
    <section class="section">
        <div class="row justify-content-center align-items-stretch">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 d-flex {{ Str::slug($product->category->slug) }} mb-4">
                        <div class="card mb-4 text-center flex-fill">
                            <img src="{{ asset('assets/img/products/' . $product->image) }}" alt="{{ $product->name }}"
                                style="height: 250px; object-fit: cover;">
                            <div class="card-body d-flex flex-column p-3">
                                <h3 class="card-title">{{ $product->name }}</h3>
                                <p class="product-price flex-grow-1">
                                    <span>{{ Str::limit($product->description, 17) }}</span>
                                    <br>
                                    <strong>${{ $product->price }}</strong>
                                </p>

                                <!-- فورم لإضافة المنتج إلى السلة -->
                                <form action="{{ route('admin.EditProduct', $product->id) }}" method='get'>
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-shopping-cart"></i> Edit Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <div class="d-flex justify-content-center">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @else
                <div class="col-12 text-center">
                    <p class="alert alert-warning">No products available at the moment.</p>
                </div>
            @endif
        </div>
    </section>

</x-admin>
