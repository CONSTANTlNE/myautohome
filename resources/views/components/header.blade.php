{{--@php--}}
{{--dd($users)--}}
{{--@endphp--}}
<header class="app-header">
    <nav class="main-header !h-[3.75rem]" aria-label="Global">
        <div class="main-header-container ps-[0.725rem] pe-[1rem] ">

            <div class="header-content-left">
                <!-- Start::header-element -->
                <div class="header-element">
                    <div class="horizontal-logo">
                        <a
                                {{--                                                                href="{{route('main')}}"--}}
                                hx-get="{{route('main2')}}"
                                hx-target="#main-content"
                                hx-indicator="#indicator"
                                id="mainpagelink1"
                                class="header-logo">
                            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-logo">
                            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="toggle-logo">
                            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-dark">
                            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="toggle-dark">
                            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-white">
                            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="toggle-white">
                        </a>
                    </div>
                </div>
                <!-- End::header-element -->
                <!-- Start::header-element -->
                <div class="header-element md:px-[0.325rem] !items-center">
                    <!-- Start::header-link -->
                    <a aria-label="Hide Sidebar"
                       class="sidemenu-toggle animated-arrow  hor-toggle horizontal-navtoggle inline-flex items-center"
                       href="javascript:void(0);"><span></span></a>
                    <!-- End::header-link -->
                </div>
                <!-- End::header-element -->
            </div>



            <div id="mainpageheader" class="flex justify-center items-center gap-4  ">
                <form
                        {{--                        action="{{route('date.range')}}"--}}
                        style=" margin-right: 50px"
                        method="post"
                        class="mt-2">
                    <div style="padding-bottom: 10px" class="input-group flex flex-row justify-center gap-4 ">

                        @csrf
{{--                                                <select name="invoice" class=" form-control ti-form-select rounded-sm !py-2 !px-3">--}}
{{--                                                    @foreach($users as $index => $user)--}}

{{--                                                        <option  value="{{$index}}">{{$user}}</option>--}}

{{--                                                    @endforeach--}}

{{--                                                </select>--}}
                        <div class="input-group-text text-[#8c9097] dark:text-white/50"><i class="ri-calendar-line"></i>
                        </div>
                        <input name="range" type="text" class="form-control flatpickr-input active" id="daterange"
                               placeholder="თარიღებს შორის" readonly="readonly">
                        <button
                                id="daterangebtn"
                                type="button"
                                hx-post="{{route('htmx.date.range')}}" hx-target="#main-content"
                                hx-indicator="#indicator"
                                class=" ti-btn ti-btn-light ti-btn-wave">
                            გაფილტრე
                        </button>
                        {{--                        <a href="{{route('main')}}" style="margin-bottom: 0!important;margin-left:5px!important;"--}}
                        {{--                           class="w ti-btn ti-btn-outline-secondary  ti-btn-wave ">--}}
                        {{--                            ბოლო 1000--}}
                        {{--                        </a>--}}
                    </div>
                </form>

                @if($authuser->hasAnyRole('admin|operator|developer'))
                <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-light ti-btn-wave"
                        data-hs-overlay="#hs-large-modal">
                    ახალი განაცხადი
                </button>
                @endif

                <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-light ti-btn-wave"
                        data-hs-overlay="#searchmodal">
                    ძებნა
                </button>


            </div>


            <div style="display: none" id="potentialclientheader" class="flex justify-center items-center gap-4  ">
                <form
                        {{--                        action="{{route('date.range')}}"--}}
                        style=" margin-right: 50px"
                        method="post"
                        class="mt-2">
                    <div style="padding-bottom: 10px" class="input-group flex flex-row justify-center gap-4 ">

                        @csrf
                        {{--                        <select name="invoice" class=" form-control ti-form-select rounded-sm !py-2 !px-3">--}}
                        {{--                            <option  value="purchase">Only Purchase</option>--}}
                        {{--                            <option value="sales">Only Sales</option>--}}
                        {{--                        </select>--}}
                        <div class="input-group-text text-[#8c9097] dark:text-white/50"><i class="ri-calendar-line"></i>
                        </div>
                        <input name="range" type="text" class="form-control flatpickr-input active" id="daterange2"
                               placeholder="თარიღებს შორის" readonly="readonly">
                        <button
                                id="daterangebtn2"
                                type="button"
                                hx-post="{{route('htmx.potential.clients.daterange')}}" hx-target="#main-content"
                                hx-indicator="#indicator"
                                class=" ti-btn ti-btn-light ti-btn-wave">
                            გაფილტრე
                        </button>
                        {{--                        <a href="{{route('main')}}" style="margin-bottom: 0!important;margin-left:5px!important;"--}}
                        {{--                           class="w ti-btn ti-btn-outline-secondary  ti-btn-wave ">--}}
                        {{--                            ბოლო 1000--}}
                        {{--                        </a>--}}
                    </div>
                </form>

                <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-light ti-btn-wave"
                        data-hs-overlay="#searchmodal2">
                    ძებნა
                </button>


            </div>

            <div class="header-content-right">


                <!-- light and dark theme -->
                <div class="header-element header-theme-mode hidden !items-center sm:block !py-[1rem] md:!px-[0.65rem] px-2">
                    <a aria-label="anchor"
                       class="hs-dark-mode-active:hidden flex hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                       href="javascript:void(0);" data-hs-theme-click-value="dark">
                        <i class="bx bx-moon header-link-icon"></i>
                    </a>
                    <a aria-label="anchor"
                       class="hs-dark-mode-active:flex hidden hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium text-defaulttextcolor  transition-all text-xs dark:bg-bodybg dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                       href="javascript:void(0);" data-hs-theme-click-value="light">
                        <i class="bx bx-sun header-link-icon"></i>
                    </a>
                </div>


                <!--Header Notifictaion -->
                <div class="header-element py-[1rem] md:px-[0.65rem] px-2 notifications-dropdown header-notification hs-dropdown ti-dropdown !hidden md:!block [--placement:bottom-left]">
                    <button id="dropdown-notification" type="button"
                            hx-get="{{route('htmx.notifications')}}"
                            hx-target="#header-notification-scroll"
                            hx-trigger="click"
                            hx-indicator="#indicator"
                            class="hs-dropdown-toggle relative ti-dropdown-toggle !p-0 !border-0 flex-shrink-0  !rounded-full !shadow-none align-middle text-xs">
                        <i class="bx bx-bell header-link-icon  text-[1.125rem]"></i>
                        <span class="flex absolute h-5 w-5 -top-[0.25rem] end-0  -me-[0.6rem]">
              <span
                      style="display: none" id="notificationcircles"
                      class="animate-slow-ping absolute inline-flex -top-[2px] -start-[2px] h-full w-full rounded-full bg-secondary/40 opacity-75">

              </span>
              <span
                      style="display: none"
                      class="relative inline-flex justify-center items-center rounded-full  h-[14.7px] w-[14px] bg-secondary text-[0.625rem] text-white"
                      id="notification-icon-badge">

              </span>
            </span>
                    </button>
                    <div id="notificationcontainer"
                         class="main-header-dropdown !-mt-3 !p-0 hs-dropdown-menu ti-dropdown-menu bg-white !w-[22rem] border-0 border-defaultborder hidden !m-0"
                         aria-labelledby="dropdown-notification">
                        <div class="ti-dropdown-header !m-0 !p-4 !bg-transparent flex justify-center items-center text-center">
                            {{--                            <p class="mb-0 text-[1.0625rem] text-defaulttextcolor font-semibold dark:text-[#8c9097] dark:text-white/50">შეტყობინებები</p>--}}
                            <button hx-get="{{route('mark.as.read')}}" hx-target="#main-content"
                                    hx-indicator="#indicator" type="button"
                                    class="ti-btn ti-btn-light ti-btn-wave mt-1">ყველა ცვლილებების ჩატვირთვა
                            </button>

                            {{--                            <span class="text-[0.75em] py-[0.25rem/2] px-[0.45rem] font-[600] rounded-sm bg-secondary/10 text-secondary" id="notifiation-data">5 Unread</span>--}}
                        </div>
                        <div class="dropdown-divider"></div>
                        <ul class="list-none !m-0 !p-0 end-0" id="header-notification-scroll" data-simplebar="init">

                        </ul>

                        {{--                        <div class="p-4 empty-header-item1 border-t mt-2">--}}
                        {{--                            <div class="grid">--}}
                        {{--                                <a href="notifications.html" class="ti-btn ti-btn-primary-full !m-0 w-full p-2">View All</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="p-[3rem] empty-item1 hidden">
                            <div class="text-center">
                <span class="!h-[4rem]  !w-[4rem] avatar !leading-[4rem] !rounded-full !bg-secondary/10 !text-secondary">
                  <i class="ri-notification-off-line text-[2rem]  "></i>
                </span>
                                <h6 class="font-semibold mt-3 text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50 text-[1rem]">
                                    No New Notifications</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Header Notifictaion -->



                <!-- Fullscreen -->
                <div class="header-element header-fullscreen py-[1rem] md:px-[0.65rem] px-2">
                    <!-- Start::header-link -->
                    <a aria-label="anchor" onclick="openFullscreen();" href="javascript:void(0);"
                       class="inline-flex flex-shrink-0 justify-center items-center gap-2  !rounded-full font-medium dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10">
                        <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                        <i class="bx bx-exit-fullscreen full-screen-close header-link-icon hidden"></i>
                    </a>
                    <!-- End::header-link -->
                </div>
                <!-- End Full screen -->

                <!-- Header Profile -->
                <div style="cursor: pointer"
                     class="header-element md:!px-[0.65rem] px-2 hs-dropdown !items-center ti-dropdown [--placement:bottom-left]">

                    {{--                    <button id="dropdown-profile" type="button"--}}
                    {{--                            class="hs-dropdown-toggle ti-dropdown-toggle !gap-2 !p-0 flex-shrink-0 sm:me-2 me-0 !rounded-full !shadow-none text-xs align-middle !border-0 !shadow-transparent ">--}}
                    {{--                        <img class="inline-block rounded-full " src="../assets/images/faces/9.jpg"  width="32" height="32" alt="Image Description">--}}
                    {{--                    </button>--}}
                    <div class="md:block hidden dropdown-profile">
                        <p class="font-semibold mb-0 leading-none text-[#536485] text-[0.813rem] ">@if(auth()->check())
                                {{$authuser->name}}
                            @endif</p>
                        {{--                        <span class="opacity-[0.7] font-normal text-[#536485] block text-[0.6875rem] ">Web Designer</span>--}}
                    </div>
                    <div
                            class="hs-dropdown-menu ti-dropdown-menu !-mt-3 border-0 w-[11rem] !p-0 border-defaultborder hidden main-header-dropdown  pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="dropdown-profile">

                        <ul class="text-defaulttextcolor font-medium dark:text-[#8c9097] dark:text-white/50">

                            <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex">
                                        <i
                                                class="ti ti-logout text-[1.125rem] me-2 opacity-[0.7]"></i>გასვლა
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Header Profile -->

                <!-- Switcher Icon -->
                <div class="header-element md:px-[0.48rem]">
                    <button aria-label="button" type="button"
                            class="hs-dropdown-toggle switcher-icon inline-flex flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium  align-middle transition-all text-xs dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                            data-hs-overlay="#hs-overlay-switcher">
                        <i class="bx bx-cog header-link-icon animate-spin-slow"></i>
                    </button>
                </div>
                <!-- Switcher Icon -->

                <!-- End::header-element -->
            </div>
        </div>
    </nav>
</header>

