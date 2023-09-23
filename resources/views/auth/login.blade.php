@extends('layouts.app')

@section('content')
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Login</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                <div class="mb-4">
                   <form method="post" action="{{ route('login') }}" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                    @csrf
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="CustomerEmail">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="CustomerPassword">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                            {{-- <button type="submit" class="btn mb-3">
                                {{ __('Login') }}
                            </button> --}}
                            <input type="submit" class="btn mb-3" value="Sign In">
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
                                  <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-danger">
                                  <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                            </div>
                            <p class="mb-4">
                            @if (Route::has('password.request'))
                                <a class="" id="RecoverPassword" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            &nbsp; | &nbsp;
                            <a href="{{ route('register') }}" id="customer_register_link">Create account</a>
                            </p>
                            {{-- <p class="mb-4">
                                <a href="#" id="RecoverPassword">Forgot your password?</a> &nbsp; | &nbsp;
                                <a href="register.html" id="customer_register_link">Create account</a>
                            </p> --}}
                        </div>
                     </div>
                 </form>
                </div>
               </div>
        </div>
    </div>
@endsection
