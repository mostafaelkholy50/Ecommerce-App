<body>

    <!-- اللودر أثناء تحميل الصفحة -->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>

    <!-- الهيدر الرئيسي -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- لوجو الموقع -->
                        <div class="site-logo">
                            <a href="{{ route('user.index') }}">
                                <img src="{{ asset('assets/img/1741914690345.png') }}" alt="Logo">
                            </a>
                        </div>

                        <!-- القائمة الرئيسية -->
                        <nav class="main-menu">
                            <ul>
                                <li class="current-list-item">
                                    <a href="{{ route('user.index') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('user.shop') }}">Shop</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('user.shop') }}">Shop</a></li>
                                        <li><a href="{{ route('user.cart') }}">Cart</a></li>
                                        <li><a href="{{ route('user.checkout') }}">Check Out</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('user.order') }}">Order</a>

                                </li>
                                <li><a href="{{ route('user.about') }}">About</a></li>

                                @guest
                                    <li>
                                        <a href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Register</a>
                                    </li>
                                @endguest

                                @auth
                                    <li>
                                        <div class="header-icons d-flex align-items-center">
                                            <!-- أيقونة عربة التسوق -->
                                            <a class="shopping-cart position-relative" href="{{ route('user.cart') }}" style="display: inline-block; margin-right: 20px;">
                                                <i class="fas fa-shopping-cart" style="font-size: 24px;"></i>
                                                @if ($cartCount > 0)
                                                    <span class="cart-badge" style="
                                                        position: absolute;
                                                        top: -5px;
                                                        right: -10px;
                                                        background-color: red;
                                                        color: white;
                                                        border-radius: 50%;
                                                        padding: 3px 7px;
                                                        font-size: 12px;
                                                    ">{{ $cartCount }}</span>
                                                @endif
                                            </a>

                                            <!-- صورة المستخدم مع القائمة المنسدلة -->
                                            <div class="user-profile-dropdown">
                                                <img id="user-profile-pic" src="{{ asset('assets/img/User/' . ($user->Image ?? 'default.png')) }}" alt="User Profile">
                                                <div id="user-dropdown-menu" class="dropdown-menu">
                                                    <a href="{{ route('profile.edit') }}" class="dropdown-item text-dark">Profile</a>
                                                    <form method="POST" action="{{ route('logout') }}" style="margin: 0; ">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">Logout</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endauth
                            </ul>
                        </nav>

                        <!-- أيقونة البحث في الموبايل -->
                        <a class="mobile-show search-bar-icon" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- منطقة البحث -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn">
                        <i class="fas fa-window-close"></i>
                    </span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" placeholder="Keywords">
                            <button type="submit">
                                Search <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS لتنسيق القائمة المنسدلة لصورة المستخدم -->
    <style>

    </style>

    <!-- JavaScript لجعل القائمة تظهر وتختفي عند تحريك الماوس -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profilePic = document.getElementById("user-profile-pic");
            const dropdownMenu = document.getElementById("user-dropdown-menu");

            // عرض القائمة عند دخول الماوس على الصورة
            profilePic.addEventListener("mouseenter", function() {
                dropdownMenu.style.display = "block";
            });

            // إخفاء القائمة عند خروج الماوس من الصورة إذا لم يكن داخل القائمة
            profilePic.addEventListener("mouseleave", function(event) {
                setTimeout(function() {
                    if (!dropdownMenu.matches(':hover')) {
                        dropdownMenu.style.display = "none";
                    }
                }, 100);
            });

            // إبقاء القائمة مفتوحة عند دخول الماوس عليها
            dropdownMenu.addEventListener("mouseenter", function() {
                dropdownMenu.style.display = "block";
            });

            // إخفاء القائمة عند خروج الماوس منها
            dropdownMenu.addEventListener("mouseleave", function() {
                dropdownMenu.style.display = "none";
            });

            // إخفاء القائمة عند النقر خارجها
            document.addEventListener("click", function(event) {
                if (!profilePic.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = "none";
                }
            });
        });
    </script>

</body>
