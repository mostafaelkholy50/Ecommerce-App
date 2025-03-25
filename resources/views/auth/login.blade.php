@include('components.head')
  <!-- Session Status -->
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <!-- Logo -->
              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/img/1741914690345.png') }}" alt="Admin Logo" class="img-fluid" style="width: 150px;">
                </a>
              </div>
              <!-- End Logo -->

              <!-- Card -->
              <div class="card shadow-lg border-0 rounded-lg mb-4 w-100">
                <div class="card-body p-5">
                  <div class="text-center">
                    <h3 class="card-title pb-0 fw-bold">User Login</h3>
                    <p class="text-muted">Enter your email & password to login</p>
                  </div>

                  @if (session('error'))
                    <div class="alert alert-danger">
                      {{ session('error') }}
                    </div>
                  @endif

                  <x-auth-session-status class="mb-4" :status="session('status')" />

                  <form method="POST" action="{{ route('login') }}" class="mt-6 p-0">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                      <x-input-label for="email" :value="__('Email')" />
                      <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                      <x-input-label for="password" :value="__('Password')" />
                      <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                      <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                      <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Forgot Password & Login Button -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="{{ route('password.request') }}">
                          {{ __('Forgot your password?') }}
                        </a>
                      @endif
                      <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                      </x-primary-button>
                    </div>

                    <!-- Register Link -->
                    <p class="text-center text-gray-700">
                      Don't have an account?
                      <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
                    </p>
                  </form>
                </div>
              </div>
              <!-- End Card -->

            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

