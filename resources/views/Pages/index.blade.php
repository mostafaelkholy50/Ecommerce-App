<x-app-layout>
    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider - Abayas -->
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Elegance & Modesty</p>
                                <h1>Discover the Latest Abaya Collection</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('user.product', 1) }}" class="boxed-btn">Shop Abayas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- single home slider - Shirts -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Style Meets Comfort</p>
                                <h1>Premium Shirt Collection for Every Occasion</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('user.product', 2) }}" class="boxed-btn">Shop Shirts</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- single home slider - Pants -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Perfect Fit, Ultimate Comfort</p>
                                <h1>Explore Our Trendy Pants Collection</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('user.product', 3) }}" class="boxed-btn">Shop Pants</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end home page slider -->

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
    <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="{{ route('user.shop') }}" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner -->
    <!-- product section -->
    <div class="product-section mt-150 mb-150 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p class="lead">Discover our latest fashionable collections, crafted for elegance and comfort.
                        </p>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row justify-content-center align-items-stretch">
                    @if ($Categories->count() > 0)
                        @foreach ($Categories as $category)
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="card mb-4 text-center flex-fill">
                                    <img src="{{ asset('assets/img/categories/' . $category->image) }}" class="card-img-top"
                                        alt="{{ $category->name }}" style="height: 250px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $category->name }}</h5>
                                        <p class="card-text flex-grow-1">
                                            {{ Str::limit($category->description, 20) }} <a
                                                href="{{ route('user.product', $category->id) }}" class="text-primary">Show
                                                More</a>
                                        </p>
                                        <a href="{{ route('user.product', $category->id) }}" class="boxed-btn">View More</a>
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



    <!-- testimonail-section -->

    <div class="testimonail-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="testimonial-sliders">
                        @foreach($comments as $comment)
                        <a href="{{ route('user.single-product', $comment->product->id) }}">
                            <div class="single-testimonial-slider">
                                <div class="client-avater">
                                    <img src="{{ asset('assets/img/User/' . $comment->user->Image ?? 'assets/img/User/default.png') }}"
                                        alt="{{ $comment->user->name }}">
                                </div>
                                <div class="client-meta">
                                    <h3>
                                        {{ $comment->user->name }}
                                        <span>
                                            {{-- عرض التقييم مع نجوم مثلاً --}}
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi {{ $i <= $comment->rating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                                            @endfor
                                        </span>
                                    </h3>
                                    <p class="testimonial-body">
                                        "{{ $comment->content }}"
                                    </p>
                                    <div class="last-icon">
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->




    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="{{ asset('assets/img/company-logos/1.png') }}" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="{{ asset('assets/img/company-logos/2.png') }}" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="{{ asset('assets/img/company-logos/3.png') }}" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="{{ asset('assets/img/company-logos/4.png') }}" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="{{ asset('assets/img/company-logos/5.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->
</x-app-layout>
