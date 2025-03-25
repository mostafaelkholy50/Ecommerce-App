<x-app-layout>

   <!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Fashion & Style</p>
                        <h1>Discover Your Perfect Outfit</h1>
                        <div class="hero-btns">
                            <a href="{{ route('login') }}" class="btn custom-boxed-btn">Login</a>
                            <a href="{{ route('register') }}" class="btn custom-bordered-btn">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- end hero area -->
    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Free Shipping</h3>
                            <p>When order over $75</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Support</h3>
                            <p>Get support all day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Refund</h3>
                            <p>Get refund within 3 days!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->

    <!-- product section -->
    <div class="product-section mt-150 mb-150 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h3><span class="orange-text">Our</span> Products</h3>
                    <p class="lead">Discover our latest fashionable collections, crafted for elegance and comfort.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row justify-content-center align-items-stretch">
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="card mb-4 text-center flex-fill">
                            <img src="{{ asset('assets/img/categories/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="card-text flex-grow-1">{{ Str::limit($category->description, 100) }} <a href="#" class="text-primary">Show More</a></p>
                                <a href="#" class="boxed-btn">View More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">No categories available at the moment.</p>
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
    <!-- end product section -->

</x-app-layout>
