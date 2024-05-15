<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light" data-menu-styles="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> YNEX - Tailwind Admin Template </title>
    <meta name="description"
          content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading.">
    <meta name="keywords"
          content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/site-logo.svg')}}">

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">
    <!-- Tom Select Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/tom-select/css/tom-select.default.min.css')}}">

    <script src="https://unpkg.com/htmx.org@1.9.12"
            integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/css/myStyles.css')}}">


    {{--  DATATABLES CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">

{{--    HTMX--}}
    <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>

    <style >
        .htmx-indicator{
            display:none;
           }
        .htmx-request .htmx-indicator   {
            display:inline;
            width: 200px;
            height: 200px;
            margin-top: 25%;
            margin-left:  50%;
        }

    </style>

</head>

<body>

<!-- ========== Switcher  ========== -->
@include('components.switcher')
<!-- ========== END Switcher  ========== -->

<!-- Loader -->
{{--<div id="loader" class="htmx-indicator">--}}
{{--            <img src="{{asset('assets/images/media/loader.svg')}}" alt="">--}}
{{--</div>--}}

<!-- Loader -->
<div class="page">
    <div id="indicator" class="htmx-indicator  ti-spinner !animate-ping !border-transparent  bg-gray-400" role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
    </div>
{{--        <img id="indicator" class="htmx-indicator" src="{{asset('assets/images/media/loader.svg')}}" alt="">--}}

    <!-- Start::Header -->
    @include('components.header')
    <!-- End::Header -->
    <!-- Start::app-sidebar -->
    @include('components.sidebar')
    <!-- End::app-sidebar -->
@if(request()->routeIs('main'))
    {{--    New Application modal / button in header--}}
    <div id="hs-large-modal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out md:!max-w-2xl md:w-full m-3 md:mx-auto">
            <form action="{{route('app.create')}}" method="post">
                @csrf
                <div class="ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="ti-modal-title">
                            განაცხადის შექმნა
                        </h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                                data-hs-overlay="#hs-large-modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                        fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                    <div class="ti-modal-body">
                        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2">
                            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                                <label class="form-label">პირადი ნომერი</label>
                                <input name="customer_pid" type="text" class="form-control"
                                       aria-label="ninedigitnumber">
                            </div>
                            <div class="md:col-span-4 col-span-12 mb-4">
                                <label class="form-label">სახელი / გვარი</label>
                                <input name="customer_name" type="text" class="form-control"
                                       aria-label="FullName">
                            </div>
                            <div class="md:col-span-2 col-span-12 mb-4">
                                <label class="form-label">მობილური</label>
                                <input aria-label="tel" name="customer_mobile"
                                       style="padding-left: 0!important;padding-right: 0!important"
                                       type="text"
                                       class="form-control"
                                >
                            </div>
                            <div class="md:col-span-3 col-span-12 mb-4">
                                <label class="form-label">წყარო</label>
                                <select name="source" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                    <option>არ არის არჩეული</option>
                                    @foreach($sources as $index => $source)
                                        <option value="{{$source->id}}">{{$source->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="md:col-span-4 col-span-12 mb-4">
                                <label class="form-label">სტატუსი</label>
                                <select name="status" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                    <option>არ არის არჩეული</option>
                                    @foreach($statuses as $index => $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="md:col-span-4 col-span-12 mb-4">
                                <label class="form-label">პროდუქტი</label>
                                <select name="product" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                    <option>არ არის არჩეული</option>
                                    @foreach($products as $index => $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class=" md:col-span-4 col-span-12 mb-4">
                                <label class="form-label">კომპანია</label>
                                <select name="company[]" class=" sm:mb-0 form-select !py-3"
                                        id="inlineFormSelectPref">
                                    <option selected="">არ არის არჩეული</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        {{--                        ==================================================================================--}}
                        <template id="companytemplate">
                            <div class="flex justify-end gap-6 w-full mt-2">
                                <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecompany">წაშლა
                                </button>

                                <select style="max-width: 200px" name="company[]" class=" sm:mb-0 form-select !py-3"
                                        id="inlineFormSelectPref">
                                    <option selected="">არ არის არჩეული</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </template>
                        <div id="companydiv" class="w-full">

                        </div>
                        <div class="flex justify-center mt-7  mb-4">
                            <button id="newcompany" type="button" class="ti-btn ti-btn-primary-full ti-btn-wave">
                                ახალი კომპანიის დამატება
                            </button>
                        </div>

                        {{--                            <p class="mb-4 text-center w-full">ავტომობილი მონაცემები</p>--}}
                        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 mt-7">
                            <div class="md:col-span-3 col-span-12 mb-4">
                                <label class="form-label">მწარმოებელი</label>

                                <select aria-label="car" name="car" class="ti-form-select rounded-sm !p-0"
                                        id="carsselect"
                                        autocomplete="off">
                                    <option></option>

                                </select>
                            </div>
                            <div class="md:col-span-3 col-span-12 mb-4">
                                <label class="form-label">მოდელი</label>

                                <select name="model" class="ti-form-select rounded-sm !p-0" id="modelsselect"
                                        autocomplete="off">
                                    <option></option>

                                </select>
                            </div>
                            <div class="md:col-span-3 col-span-12 mb-4">
                                <label class="form-label">წელი</label>
                                <input name="year" type="text" class="form-control"
                                       aria-label="year">
                            </div>
                            <div class="md:col-span-3 col-span-12 mb-4">
                                <label class="form-label">ძრავი</label>

                                <input name="engine" type="text" class="form-control"
                                       aria-label="float number">
                            </div>
                            <div class="md:col-span-12 col-span-12 mb-4">
                                <label class="form-label">ლინკი</label>

                                <input name="link" type="url" class="form-control"
                                       aria-label="url">
                            </div>
                        </div>
                        <div class="md:col-span-12 col-span-12 mb-4">
                            <label class="form-label">კომენტარი</label>
                            <textarea name="comment" class="form-control" aria-label="With textarea"
                                      rows="3"></textarea>
                        </div>
                    </div>


                    <button class="ti-btn ti-btn-primary-full ti-btn-wave">შენახვა</button>
                </div>

            </form>
        </div>
    </div>
    {{-- Search Modal / button in header--}}
    <div id="searchmodal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out md:!max-w-2xl md:w-full m-3 md:mx-auto">
            {{--                <form action="{{route('search.app')}}" method="get">--}}
            {{--                    @csrf--}}
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="ti-modal-title">
                        ძებნა
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#searchmodal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <div class="ti-modal-body">
                    <div class="input-group border-[2px] border-primary rounded-[0.25rem] w-full flex">
                        <a aria-label="anchor" href="javascript:void(0);" class="input-group-text flex items-center bg-light border-e-[#dee2e6] !py-[0.375rem] !px-[0.75rem] !rounded-none !text-[0.875rem]" id="Search-Grid"><i class="fe fe-search header-link-icon text-[0.875rem]"></i></a>
                        <input hx-get="{{route('search.htmx')}}" hx-target="#searchtarget" hx-trigger="keyup changed delay:500ms" type="search" name="search" class="form-control border-0 px-2 !text-[0.8rem] w-full focus:ring-transparent" placeholder="პირადი ნომერი / სახელი / გვარი / მობილური" aria-label="Username">
                        <div class="inline-flex rounded-md  shadow-sm">
                            <button
                                    hx-get="{{route('search.clear')}}"
                                    hx-target="#searchtarget"
                                    hx-trigger="click"
                                    type="button"
                                    class="ti-btn-group !px-[0.75rem] !py-[0.45rem]  rounded-s-[0.25rem] !rounded-e-none ti-btn-primary !text-[0.75rem] dark:border-white/10">
                                გასუფთავება
                            </button>

                        </div>
                    </div>
                    <div id="searchtarget"></div>

                </div>

                <div class="ti-modal-footer !py-[1rem] !px-[1.25rem]">
                    <div class="inline-flex rounded-md  shadow-sm">
                        {{--                                <button--}}
                        {{--                                        type="button"--}}
                        {{--                                        class="ti-btn-group !px-[0.75rem] !py-[0.45rem]  rounded-s-[0.25rem] !rounded-e-none ti-btn-primary !text-[0.75rem] dark:border-white/10">--}}
                        {{--                                    მოძებნე--}}
                        {{--                                </button>--}}

                    </div>
                </div>

            </div>

            {{--                </form>--}}
        </div>
    </div>


    @endif


    <!-- Start::content  -->
    <div class="content">

        <!-- Start::main-content -->
        <div id="main-content"  class="main-content">

            @yield('main')
            @yield('other')
            @yield('users')
            @yield('upload')
            @yield('editapp')
            @yield('details')
            @yield('search')

        </div>
    </div>
    <!-- End::content  -->

    <!-- ========== Search Modal ========== -->
    {{--<div id="search-modal" class="hs-overlay ti-modal hidden mt-[1.75rem]">--}}
    {{--  <div class="ti-modal-box">--}}
    {{--    <div class="ti-modal-content !border !border-defaultborder dark:!border-defaultborder/10 !rounded-[0.5rem]">--}}
    {{--      <div class="ti-modal-body">--}}

    {{--        <div class="input-group border-[2px] border-primary rounded-[0.25rem] w-full flex">--}}
    {{--          <a aria-label="anchor" href="javascript:void(0);"--}}
    {{--            class="input-group-text flex items-center bg-light border-e-[#dee2e6] !py-[0.375rem] !px-[0.75rem] !rounded-none !text-[0.875rem]"--}}
    {{--            id="Search-Grid"><i class="fe fe-search header-link-icon text-[0.875rem]"></i></a>--}}

    {{--          <input type="search" class="form-control border-0 px-2 !text-[0.8rem] w-full focus:ring-transparent"--}}
    {{--            placeholder="Search" aria-label="Username">--}}

    {{--          <a aria-label="anchor" href="javascript:void(0);" class="flex items-center input-group-text bg-light !py-[0.375rem] !px-[0.75rem]"--}}
    {{--            id="voice-search"><i class="fe fe-mic header-link-icon"></i></a>--}}
    {{--          <div class="hs-dropdown ti-dropdown">--}}
    {{--            <a aria-label="anchor" href="javascript:void(0);"--}}
    {{--              class="flex items-center hs-dropdown-toggle ti-dropdown-toggle btn btn-light btn-icon !bg-light !py-[0.375rem] !rounded-none !px-[0.75rem] text-[0.95rem] h-[2.413rem] w-[2.313rem]">--}}
    {{--              <i class="fe fe-more-vertical"></i>--}}
    {{--            </a>--}}

    {{--            <ul class="absolute hs-dropdown-menu ti-dropdown-menu !-mt-2 !p-0 hidden">--}}
    {{--              <li><a--}}
    {{--                  class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"--}}
    {{--                  href="javascript:void(0);">Action</a></li>--}}
    {{--              <li><a--}}
    {{--                  class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"--}}
    {{--                  href="javascript:void(0);">Another action</a></li>--}}
    {{--              <li><a--}}
    {{--                  class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"--}}
    {{--                  href="javascript:void(0);">Something else here</a></li>--}}
    {{--              <li>--}}
    {{--                <hr class="dropdown-divider">--}}
    {{--              </li>--}}
    {{--              <li><a--}}
    {{--                  class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"--}}
    {{--                  href="javascript:void(0);">Separated link</a></li>--}}
    {{--            </ul>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--        <div class="mt-5">--}}
    {{--          <p class="font-normal  text-[#8c9097] dark:text-white/50 text-[0.813rem] dark:text-gray-200 mb-2">Are You Looking For...</p>--}}

    {{--          <span class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i class="fe fe-user me-2"></i>People<a--}}
    {{--              href="javascript:void(0)" class="tag-addon header-remove-btn"><span class="sr-only">Remove badge</span><i class="fe fe-x"></i></a></span>--}}
    {{--          <span class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i class="fe fe-file-text me-2"></i>Pages<a--}}
    {{--              href="javascript:void(0)" class="tag-addon header-remove-btn"><span class="sr-only">Remove badge</span><i class="fe fe-x"></i></a></span>--}}
    {{--          <span class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i--}}
    {{--              class="fe fe-align-left me-2"></i>Articles<a href="javascript:void(0)" class="tag-addon header-remove-btn"><span class="sr-only">Remove badge</span><i--}}
    {{--                class="fe fe-x"></i></a></span>--}}
    {{--          <span class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i class="fe fe-server me-2"></i>Tags<a--}}
    {{--              href="javascript:void(0)" class="tag-addon header-remove-btn"><span class="sr-only">Remove badge</span><i class="fe fe-x"></i></a></span>--}}

    {{--        </div>--}}


    {{--        <div class="my-[1.5rem]">--}}
    {{--          <p class="font-normal  text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-2">Recent Search :</p>--}}

    {{--          <div id="dismiss-alert" role="alert"--}}
    {{--            class="!p-2 border dark:border-defaultborder/10 rounded-[0.3125rem] flex items-center text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-2 !text-[0.8125rem] alert">--}}
    {{--            <a href="notifications.html"><span>Notifications</span></a>--}}
    {{--            <a aria-label="anchor" class="ms-auto leading-none" href="javascript:void(0);" data-hs-remove-element="#dismiss-alert"><i--}}
    {{--                class="fe fe-x !text-[0.8125rem] text-[#8c9097] dark:text-white/50"></i></a>--}}
    {{--          </div>--}}

    {{--          <div id="dismiss-alert1" role="alert"--}}
    {{--            class="!p-2 border dark:border-defaultborder/10 rounded-[0.3125rem] flex items-center text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-2 !text-[0.8125rem] alert">--}}
    {{--            <a href="alerts.html"><span>Alerts</span></a>--}}
    {{--            <a aria-label="anchor" class="ms-auto leading-none" href="javascript:void(0);" data-hs-remove-element="#dismiss-alert"><i--}}
    {{--                class="fe fe-x !text-[0.8125rem] text-[#8c9097] dark:text-white/50"></i></a>--}}
    {{--          </div>--}}

    {{--          <div id="dismiss-alert2" role="alert"--}}
    {{--            class="!p-2 border dark:border-defaultborder/10 rounded-[0.3125rem] flex items-center text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-0 !text-[0.8125rem] alert">--}}
    {{--            <a href="mail.html"><span>Mail</span></a>--}}
    {{--            <a aria-label="anchor" class="ms-auto lh-1" href="javascript:void(0);" data-hs-remove-element="#dismiss-alert"><i--}}
    {{--                class="fe fe-x !text-[0.8125rem] text-[#8c9097] dark:text-white/50"></i></a>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}

    {{--      <div class="ti-modal-footer !py-[1rem] !px-[1.25rem]">--}}
    {{--        <div class="inline-flex rounded-md  shadow-sm">--}}
    {{--          <button type="button"--}}
    {{--            class="ti-btn-group !px-[0.75rem] !py-[0.45rem]  rounded-s-[0.25rem] !rounded-e-none ti-btn-primary !text-[0.75rem] dark:border-white/10">--}}
    {{--            Search--}}
    {{--          </button>--}}
    {{--          <button type="button"--}}
    {{--            class="ti-btn-group  ti-btn-primary-full rounded-e-[0.25rem] dark:border-white/10 !text-[0.75rem] !rounded-s-none !px-[0.75rem] !py-[0.45rem]">--}}
    {{--            Clear Recents--}}
    {{--          </button>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}
    {{--  </div>--}}
    {{--</div>--}}
    <!-- ========== END Search Modal ========== -->

    <!-- Footer Start -->
    @include('components.footer')
    <!-- Footer End -->

</div>

<!-- Back To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
</div>

<div id="responsive-overlay"></div>

<!-- Preline JS -->
<script src="{{asset('assets/libs/preline/preline.js')}}"></script>

<!-- popperjs -->
<script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>

<!-- Color Picker JS -->
<script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>

<!-- sidebar JS -->
<script src="{{asset('assets/js/defaultmenu.js')}}"></script>

<!-- sticky JS -->
<script src="{{asset('assets/js/sticky.js')}}"></script>

<!-- Switch JS -->
<script src="{{asset('assets/js/switch.js')}}"></script>

<!-- Simplebar JS -->
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

<!-- Tom Select JS -->
<script src="{{asset('assets/libs/tom-select/js/tom-select.complete.min.js')}}"></script>
<script src="{{asset('assets/js/tom-select.js')}}"></script>


<!-- Custom-Switcher JS -->
<script src="{{asset('assets/js/custom-switcher.js')}}"></script>

<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>


{{--    Datatables--}}


<script src="{{asset('assets/js/datatables/datatableJquery.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.js')}}"></script>
<script src="{{asset('assets/js/datatables/datatables.buttons.js')}}"></script>
<script src="{{asset('assets/js/datatables/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.colReorder.js')}}"></script>
<script>

    let table = new DataTable('#example', {
        //Generall SETTINGS
        lengthMenu: [10, 100, 150, {label: 'All', value: -1}],

        columnDefs: [
            {orderable: false, targets: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}
        ],


        // lengthMenu: [ {label: 'All', value: -1}],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ka.json',
        },

        scrollX: true,
        scrollY: 700,


        layout: {

            topStart: {
                buttons: ['pageLength', 'colvis', 'excel'],
                // pageLength: {
                //   menu: [ 10, 25, 50, 100,5000 ]
                // }
            },

            topEnd: {
                search: '',
            }
        },


    });


    $('#col1').on('keyup', function () {
        table
            .columns(0)
            .search(this.value)
            .draw();
    });
    $('#col2').on('keyup', function () {
        table
            .columns(1)
            .search(this.value)
            .draw();
    });
    $('#col3').on('keyup', function () {
        table
            .columns(2)
            .search(this.value)
            .draw();
    });
    $('#col4').on('keyup', function () {
        table
            .columns(3)
            .search(this.value)
            .draw();
    });
    $('#col5').on('keyup', function () {
        table
            .columns(4)
            .search(this.value)
            .draw();
    });
    $('#col6').on('keyup', function () {
        table
            .columns(5)
            .search(this.value)
            .draw();
    });
    $('#col7').on('keyup', function () {
        table
            .columns(6)
            .search(this.value)
            .draw();
    });
    $('#col8').on('keyup', function () {
        table
            .columns(7)
            .search(this.value)
            .draw();
    });
    $('#col9').on('keyup', function () {
        table
            .columns(8)
            .search(this.value)
            .draw();
    });
    $('#col10').on('keyup', function () {
        table
            .columns(9)
            .search(this.value)
            .draw();
    });
    $('#col11').on('keyup', function () {
        table
            .columns(10)
            .search(this.value)
            .draw();
    });


</script>


{{--    add Company--}}
<script>
    const newcompany = document.getElementById('newcompany');
    console.log(newcompany);

    newcompany.addEventListener('click', () => {
console.log('clicked');
        const companytemplate = document.getElementById('companytemplate');
        const clone = document.importNode(companytemplate.content, true)

        document.getElementById('companydiv').appendChild(clone);
    })

    document.getElementById("companydiv").addEventListener("click", function (e) {
        if (e.target.classList.contains("removecompany")) {
            // Remove the parent node (the paragraph)
            e.target.parentNode.remove();
        }
    });

    // Edit modal
    const newcompany2 = document.querySelectorAll('.newcompany');
    console.log(newcompany);

    newcompany2.forEach((newcompany,index) => {
        newcompany.addEventListener('click', () => {
            const companytemplate2 = document.querySelectorAll('.companytemplate');
            const companydiv2 = document.querySelectorAll('.companydiv');
            const clone = document.importNode(companytemplate2[index].content, true)


            companydiv2[index].appendChild(clone);


        })

       const deletecompany= document.querySelectorAll('.companydiv');

        deletecompany.forEach((deletecompany,index) => {
            deletecompany.addEventListener('click', (e) => {
                if (e.target.classList.contains("removecompany")) {
                    // Remove the parent node (the paragraph)
                    e.target.parentNode.remove();
                }
            })
        })
    })




</script>

{{--add Comment--}}
{{--@if(request()->routeIs('app.edit'))--}}
<script>
    const newcomment = document.getElementById('newcomment');

    newcomment.addEventListener('click', () => {

        const commenttemplate = document.getElementById('commenttemplate');
        const clone2 = document.importNode(commenttemplate.content, true)

        document.getElementById('mydiv2').appendChild(clone2);
    })

    document.getElementById("mydiv2").addEventListener("click", function (e) {
        if (e.target.classList.contains("removecomment")) {
            // Remove the parent node (the paragraph)
            e.target.parentNode.remove();
        }
    });
</script>
{{--@endif--}}

{{--CarsJson--}}
@if(request()->routeIs('main') || request()->routeIs('app.edit'))
    <script>

        const carsData = {!! $carsJson !!};

        // CARS
        const make = document.getElementById('carsselect');

        carsData.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id; // Set the option's value to the item's ID
            option.textContent = item.make; // Set the option's text content to the item's name
            make.appendChild(option); // Append the option to the select element
        });

        new TomSelect("#carsselect", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        // Edit Modal Tom Select

        const make2=document.querySelectorAll('.carsselect');

        make2.forEach(i=>{



            carsData.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id; // Set the option's value to the item's ID
                option.textContent = item.make; // Set the option's text content to the item's name
                i.appendChild(option); // Append the option to the select element
            });


        })








        // MODELs
        const modelsselect = document.getElementById('modelsselect');
        let tomselect = new TomSelect("#modelsselect", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        })

        make.addEventListener('change', (event) => {
            tomselect.destroy()
            modelsselect.innerHTML = ''


            const models = carsData[event.target.value - 1].models;
            models.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id; // Set the option's value to the item's ID
                option.textContent = item.name; // Set the option's text content to the item's name
                modelsselect.appendChild(option);
            })

            // reinitialize tomselect;
            tomselect = new TomSelect("#modelsselect", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            })


        })

    </script>
@endif
</body>

</html>

