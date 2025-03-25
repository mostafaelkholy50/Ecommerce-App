<x-app-layout>
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }
        /* ---------- Product Section ---------- */
        .single-product {
            margin-top: 150px;
            margin-bottom: 150px;
        }
        .custom-product-image {
            cursor: crosshair;
        }
        .zoom-result {
            width: 350px;
            height: 350px;
            border: 2px solid #ddd;
            background-image: url('{{ asset('assets/img/products/' . $products->image) }}');
            background-repeat: no-repeat;
            background-size: 200%;
            display: none;
            margin-top: 90px;
            margin-bottom: 20px;
        }
        /* ---------- Related Products ---------- */
        .more-products {
            margin-bottom: 150px;
        }
        .card img {
            height: 250px;
            object-fit: cover;
        }
        .section-title {
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        /* ---------- Comment Form ---------- */
        .comment-form-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .comment-form-card h3 {
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        /* ---------- Rating Stars (Form) ---------- */
        #rating-stars {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .big-star {
            font-size: 40px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .big-star:hover {
            transform: scale(1.2);
        }
        /* ---------- Comment Display ---------- */
        .comment-display-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .comment-card {
            display: flex;
            align-items: flex-start;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .comment-card:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .reviewer-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 15px;
        }
        .comment-body {
            flex: 1;
        }
        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .comment-header strong {
            margin-right: 10px;
        }
        .comment-header .comment-date {
            font-size: 0.9rem;
            color: #777;
        }
        .comment-rating {
            margin-bottom: 8px;
        }
        .comment-text {
            margin: 0;
            line-height: 1.4;
            font-size: medium;
        }
        /* ---------- Button Style ---------- */
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <!-- Single Product Section with Zoom Effect -->
    <div class="single-product">
        <div class="container">
            <div class="row">
                <!-- Left Column: Product Image -->
                <div class="col-md-6">
                    <div class="img-container" style="position: relative;">
                        <img src="{{ asset('assets/img/products/' . $products->image) }}" alt="{{ $products->name }}"
                             id="mainImage" class="img-fluid custom-product-image">
                    </div>
                </div>
                <!-- Right Column: Zoom Box & Product Details -->
                <div class="col-md-6">
                    <!-- Zoom Box -->
                    <div id="zoomResult" class="zoom-result"></div>
                    <!-- Product Details -->
                    <div class="single-product-content">
                        <h2 class="single-product-title">{{ $products->name }}</h2>
                        <div class="single-product-pricing" style="max-width: 100%; word-wrap: break-word;">
                            <h5>{{ $products->description }}</h5>
                            <strong class="price">${{ $products->price }}</strong>
                        </div>
                        <!-- عرض التقييم تحت الوصف -->

                        <div class=" my-3">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $roundedRating)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @else
                                    <i class="bi bi-star text-secondary"></i>
                                @endif
                            @endfor
                            <span class="ms-2">({{ number_format($roundedRating, 1) }} out of 5)</span>
                        </div>
                        <div class="single-product-form">
                            <form action="{{ route('user.cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="cart-btn btn ">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                            <p class="category mt-2"><strong>Category:</strong> {{ $products->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="more-products">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row justify-content-center align-items-stretch">
                    @if ($relatedProducts->count() > 0)
                        @foreach ($relatedProducts as $product)
                            <div class="col-lg-4 col-md-6 d-flex mb-4">
                                <div class="card mb-4 text-center flex-fill">
                                    <img src="{{ asset('assets/img/products/' . $product->image) }}" alt="{{ $product->name }}">
                                    <a href="{{ route('user.single-product', $product->id) }}">
                                        <div class="card-body d-flex flex-column p-3">
                                            <h3 class="card-title">{{ $product->name }}</h3>
                                            <p class="product-price flex-grow-1">
                                                <span>{{ Str::limit($product->description, 17) }}</span><br>
                                                <strong>${{ $product->price }}</strong>
                                            </p>
                                    </a>
                                    <!-- Add to Cart Form -->
                                    <form action="{{ route('user.cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="cart-btn btn">
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
        </div>
    </div>

    <!-- Error Message (if any) -->
    @if (session('error'))
        <div class="container">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Comment Section Conditions -->
    @if ($AlreadyOrder == 0)
        <!-- حالة عدم طلب الأوردر -->
        <div class="container">
            <div class="alert alert-warning text-center">
                You need to place an order before adding a comment.
            </div>
        </div>
    @elseif ($AlreadyComment > 0)
        <!-- حالة أن المستخدم سبق وعلق -->
        <div class="container">
            <div class="alert alert-info text-center">
                You have already commented on this product.
            </div>
        </div>
        <!-- عرض التعليق الخاص بالمستخدم -->
        <div class="container my-3">
            <div class="comment-card">
                <img src="{{ asset('assets/img/User/' . $YourComment->user->Image) }}" alt="{{ $YourComment->user->name }}" class="reviewer-img">
                <div class="comment-body">
                    <div class="comment-header">
                        <strong>{{ ucfirst($YourComment->user->name) }}</strong>
                        <span class="comment-date">{{ $YourComment->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="comment-rating mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $YourComment->rating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                        @endfor
                    </div>
                    <p class="comment-text">{{ $YourComment->content }}</p>
                </div>
            </div>
        </div>
    @elseif ($AlreadyOrder > 0)
        <!-- حالة أن المستخدم طلب الأوردر ولم يعلق بعد -->
        <div class="container my-5">
            <div class="comment-form-card">
                <h3>Add Your Comment</h3>
                <form action="{{ route('user.store.comment') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <input type="hidden" id="rating-value" name="rating" value="1">

                    <div class="mb-4 text-center">
                        <label class="form-label fw-bold d-block">Rating</label>
                        <div id="rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star big-star text-secondary" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label fw-bold">Comment</label>
                        <textarea class="form-control" id="comment" name="content" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn cart-btn w-100">Submit Comment</button>
                </form>
            </div>
        </div>
    @endif

    <!-- Comments Display Section -->
    <div class="container my-5">
        <div class="comment-display-card">
            <h3 class="text-center mb-4">Comments</h3>
            @if ($comments->count() > 0)
                @foreach ($comments as $comment)
                    <div class="comment-card">
                        <img src="{{ asset('assets/img/User/' . $comment->user->Image) }}" alt="{{ $comment->user->name }}" class="reviewer-img">
                        <div class="comment-body">
                            <div class="comment-header">
                                <strong>{{ ucfirst($comment->user->name) }}</strong>
                                <span class="comment-date">{{ $comment->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div class="comment-rating mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $comment->rating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                                @endfor
                            </div>
                            <p class="comment-text">{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">No comments yet.</p>
            @endif
        </div>
    </div>

    <!-- JavaScript for Interactive Star Rating (Form) -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll("#rating-stars i");
            const ratingValue = document.getElementById("rating-value");

            function setRating(rating) {
                ratingValue.value = rating;
                stars.forEach(star => {
                    if (parseInt(star.getAttribute("data-value")) <= rating) {
                        star.classList.remove("bi-star", "text-secondary");
                        star.classList.add("bi-star-fill", "text-warning");
                    } else {
                        star.classList.remove("bi-star-fill", "text-warning");
                        star.classList.add("bi-star", "text-secondary");
                    }
                });
            }

            stars.forEach(star => {
                star.addEventListener("click", function () {
                    const rating = parseInt(this.getAttribute("data-value"));
                    setRating(rating);
                });
                star.addEventListener("mouseover", function () {
                    const rating = parseInt(this.getAttribute("data-value"));
                    stars.forEach(st => {
                        if (parseInt(st.getAttribute("data-value")) <= rating) {
                            st.classList.remove("bi-star", "text-secondary");
                            st.classList.add("bi-star-fill", "text-warning");
                        } else {
                            st.classList.remove("bi-star-fill", "text-warning");
                            st.classList.add("bi-star", "text-secondary");
                        }
                    });
                });
            });

            // Reset the stars on mouse leave to the current rating
            document.getElementById("rating-stars").addEventListener("mouseleave", function () {
                setRating(parseInt(ratingValue.value));
            });
        });
    </script>

    <!-- JavaScript for Zoom Effect -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var mainImage = document.getElementById("mainImage");
            var zoomResult = document.getElementById("zoomResult");

            mainImage.addEventListener("mouseenter", function () {
                zoomResult.style.display = "block";
            });
            mainImage.addEventListener("mouseleave", function () {
                zoomResult.style.display = "none";
            });
            mainImage.addEventListener("mousemove", function (e) {
                var rect = mainImage.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var y = e.clientY - rect.top;
                var xPercent = (x / rect.width) * 100;
                var yPercent = (y / rect.height) * 100;
                zoomResult.style.backgroundPosition = xPercent + "% " + yPercent + "%";
            });
        });
    </script>
</x-app-layout>
