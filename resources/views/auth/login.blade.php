<!DOCTYPE html>
<html class="light-style customizer-hide" data-theme="theme-default" data-assets-path=""
    data-template="vertical-menu-template-free" lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Sungava Travel</title>
    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon"
        href="{{ $settings['fav_icon'] ? asset('admin/images/setting/' . $settings['fav_icon']) : asset('admin/images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link class="template-customizer-core-css" rel="stylesheet"
        href="{{ asset('admin/assets/vendor/css/core.css') }}" />
    <link class="template-customizer-theme-css" rel="stylesheet"
        href="{{ asset('admin/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/page-auth.css') }}" />
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a class="app-brand-link gap-2" href="{{ route('login') }}">
                                <span class="app-brand-logo demo">
                                </span>
                                <img src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : asset('admin/images/logo.png') }}"
                                    alt="logo" height="90">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Sungava Travel</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        <form class="mb-3" id="formAuthentication" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="email">Email or Username</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    type="text" name="email" placeholder="Enter your email or username"
                                    value="{{ old('email') }}" autofocus />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>*{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <small>Forgot Password?</small>
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group input-group-merge">
                                    <input class="form-control @error('password') is-invalid @enderror" id="myInput"
                                        type="password" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer" id=""
                                        onclick="myFunction()"><i class="bx bx-hide"></i></span>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="remember" type="checkbox" name="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!-- Core JS -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
</body>

</html>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        x.type === "password" ? x.type = "text" : x.type = "password";
    }
</script>
