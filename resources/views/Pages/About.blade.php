<x-app-layout>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>We sell stylish clothing</p>
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- featured section -->
    <div class="feature-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="featured-text">
                        <h2 class="pb-3">Why <span class="orange-text">FashionHub</span></h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Fast Delivery</h3>
                                        <p>We ensure quick and secure delivery of your favorite clothing items.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Best Prices</h3>
                                        <p>Get the best value for stylish clothing at unbeatable prices.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-tshirt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Custom Designs</h3>
                                        <p>Personalize your outfits with our exclusive custom design services.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Easy Returns</h3>
                                        <p>Shop with confidence knowing that returns are hassle-free.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end featured section -->

    <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>Winter Sale is Here! <br> Get up to <span class="orange-text">50% Off...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="{{ route('user.shop') }}" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner -->
    <!-- team section -->
    <div class="mt-150 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3>Our <span class="orange-text">Team</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-team-item text-center">
                        <div class="team-bg team-bg-1"></div>
                        <h4>Mostafa Elkholy <span>BackEnd Developer</span></h4>
                        <ul class="social-link-team d-flex justify-content-center">
                            <li><a href="https://www.linkedin.com/in/mostafa-elkholy-4333b3262/" target="_blank"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="https://www.facebook.com/mostafaelkhol/" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://x.com/MOSTAFA_AHMAD50" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/mostafa_ahmad_elkholy/" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
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


</x-app-layout>
