<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" class="dark"
      data-header-styles="dark" data-menu-styles="dark" data-toggled="close">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAutoHome</title>
    <meta name="description" content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading.">
    <meta name="keywords" content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/site-logo.svg')}}">

    <!-- Main Theme Js -->
    <script src="{{asset('assets/js/authentication-main.js')}}"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">

    <!-- Simplebar Css -->
    <link id="style" href="{{asset('assets/libs/simplebar/simplebar.min.css" rel="stylesheet')}}">

    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}">



</head>


<body>


<!-- Loader -->
<div id="loader" >
{{--    <img src="../assets/images/media/loader.svg" alt="">--}}
</div>
<!-- Loader -->


<div class="container">
    <div class="flex justify-center authentication authentication-basic items-center h-full text-defaultsize text-defaulttextcolor">
        <div class="grid grid-cols-12">
            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-2"></div>
            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-6 sm:col-span-8 col-span-12">
                <div style="max-height: 100px" class="my-[1.5rem] flex justify-center">
                    <a href="#">
                        <img style="max-height: 100px" src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-logo">
                        <img style="max-height: 100px" src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-dark">
                    </a>
                </div>
                <div class="box">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                    <div class="box-body !p-[3rem]">
{{--                        <p class="h5 font-semibold mb-2 text-center">Sign In</p>--}}
                        <div class="grid grid-cols-12 gap-y-4">
                            <div class="xl:col-span-12 col-span-12">
                                <label for="signin-username" class="form-label text-default">მომხმარებელი</label>

                                <input name="email" type="text" class="form-control form-control-lg w-full !rounded-md" id="signin-username" >
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="xl:col-span-12 col-span-12 mb-2">
                                <label for="signin-password" class="form-label text-default block">პაროლი</label>
                                <div class="input-group">
                                    <input name="password" type="password" class="form-control form-control-lg !rounded-s-md" id="signin-password">
                                    <button aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="xl:col-span-12 col-span-12 grid mt-2">
                                <button class="ti-btn ti-btn-primary !bg-primary !text-white !font-medium">ავტორიზაცია</button>
                            </div>



                        </div>

                    </div>
                    </form>
                </div>
            </div>
            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-2"></div>
        </div>
    </div>
</div>

<!-- Show Password JS -->
<script src="{{asset('assets/js/show-password.js')}}"></script>

<!-- Auth Custom JS -->
<script src="{{asset('assets/js/auth-custom.js')}}"></script>

</body>

</html>