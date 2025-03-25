@include('components.head')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('assets/img/1741914690345.png') }}" alt="Admin Logo"
                                    class="img-fluid" style="width: 150px;">
                            </a>
                        </div><!-- End Logo -->

                        <div class="card shadow-lg border-0 rounded-lg mb-4 w-100">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <h3 class="card-title pb-0 fw-bold">Admin Login</h3>
                                    <p class="text-muted">Enter your email & password to login</p>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form class="row g-4 needs-validation" novalidate method="POST"
                                    action="{{ route('admin.login') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label fw-semibold">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text bg-primary text-white"><i
                                                    class="bi bi-envelope"></i></span>
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                id="yourEmail" required>
                                            <div class="invalid-feedback">Please enter a valid email.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label fw-semibold">Password</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text bg-primary text-white"><i
                                                    class="bi bi-lock"></i></span>
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="cart-btn w-100 fw-bold btn-lg" type="submit">Login</button>
                                    </div>

                                    <div class="col-12 text-center">
                                        <p class="small mb-0">Don't have an account? <a href="{{ route('admin.register') }}"
                                                class="text-primary fw-semibold">Create an account</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
</main>
