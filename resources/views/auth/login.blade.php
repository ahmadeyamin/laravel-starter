<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | Laravel-Starter - Admin Template</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>
        <link rel="icon" href="../favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/theme.min.css') }}">
        <script src="{{ asset('src/js/vendor/modernizr-2.8.3.min.js') }}"></script>

        <script>
            Turbolinks.start();
        </script>

    </head>

    <body>
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="
                    background-image: url('{{asset('img/login.svg')}}');background-position: center;
                    background-size: 70% 75%;">
                            {{-- <div class="lavalite-overlay"></div> --}}
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0 shadow">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="/"><img src="{{ asset('src/img/brand.svg') }}" alt=""></a>
                            </div>
                            <h3>Sign In to Laravel-Starter</h3>
                            <p>Happy to see you again!</p>
                            <form action="{{ route('login') }}" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required="" value="{{old('email')}}" />
                                    <i class="ik ik-user"></i>

                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                @csrf
                                <div class="form-group" x-data="{show:false}">


                                <input  x-bind:type="!show?'password':'text'" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="" name="password" />


                                      <div class="input-group-append position-absolute" style="right: 10px;top:9px;">

                                        <a href="#" @click.prevent="show = !show" x-show="show"><i class="ik ik-eye" aria-hidden="true"></i></a>
                                        <a href="#" @click.prevent="show = !show" x-show="!show"><i class="ik ik-eye-off" aria-hidden="true"></i></a>
                                      </div>
                                    <i class="ik ik-lock"></i>



                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" {{ old('remember') ? 'checked' : '' }} name="item_checkbox" value="option1">
                                            <span class="custom-control-label"> {{ __('Remember Me') }}</span>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                    <a href="{{ route('password.request') }}">{{__('Forgot Password ?')}}</a>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                <button class="btn btn-theme">{{__('Sign In')}}</button>
                                </div>
                            </form>

                            <div class="d-flex justify-content-around mt-4">
                                <a href="{{ route('login.provider','facebook') }}" class="btn social-btn btn-facebook" >
                                    <i class="ik-facebook ik"></i>
                                </a>
                                <a href="#" class="btn social-btn btn-twitter">
                                    <i class="ik-twitter ik"></i>
                                </a>
                                <a href="{{ route('login.provider','github') }}" class="btn social-btn btn-dark">
                                    <i class="ik-github ik"></i>
                                </a>
                            </div>

                            @if (Route::has('register'))
                            <div class="register">
                                <p>Don't have an account? <a href="{{ route('register')}}">Create an account</a></p>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="{{ asset('plugins/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    </body>
</html>
