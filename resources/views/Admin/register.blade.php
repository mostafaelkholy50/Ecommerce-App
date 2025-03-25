@include('components.head')

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/img/1741914690345.png') }}" alt="Admin Logo" class="img-fluid" style="width: 150px; height: auto;">
                </a>
              </div><!-- End Logo -->

              <div class="card shadow-lg border-0 rounded-lg mb-4 w-100">
                <div class="card-body p-5">
                  <div class="text-center">
                    <h3 class="card-title pb-2 fw-bold">Create an Account</h3>
                    <p class="text-muted mb-4">Enter your details to register</p>
                  </div>

                  <form class="row g-4 needs-validation" novalidate method="POST" action="{{ route('admin.register') }}">
                    @csrf

                    <div class="col-12">
                      <label for="yourName" class="form-label fw-bold">Full Name</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text bg-primary text-white"><i class="bi bi-person"></i></span>
                        <input type="text" name="name" class="form-control form-control-lg" id="yourName" required>
                        <div class="invalid-feedback">Please enter your name.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label fw-bold">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text bg-primary text-white"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control form-control-lg" id="yourEmail" required>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label fw-bold">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text bg-primary text-white"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control form-control-lg" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your password.</div>
                      </div>
                    </div>

                    <div class="col-12  mt-3">
                      <button class="btn cart-btn w-100 fw-bold py-3" type="submit">Create Account</button>
                    </div>

                    <div class="col-12 text-center">
                      <p class="small mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold">Log in</a></p>
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
