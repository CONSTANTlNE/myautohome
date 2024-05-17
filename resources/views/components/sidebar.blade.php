<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div style="padding:0!important" class="main-sidebar-header">
        <a href="{{route('main')}}" class="header-logo">
            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-logo">
            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="toggle-logo">
            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-dark">
            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="toggle-dark">
            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="desktop-white">
            <img src="{{asset('assets/images/site-logo.svg')}}" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                                         height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg></div>
            <ul class="main-menu">

{{--                Admin Menu--}}

                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
           <span style="margin-right: 5px" class="material-symbols-outlined text-primary">settings</span>
                        <span class="side-menu__label">ადმინი
{{--                            <span class="badge !bg-warning/10 !text-warning !py-[0.25rem] !px-[0.45rem] !text-[0.75em] ms-2">12</span>--}}
                        </span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Dashboards</a>
                        </li>
                        <li class="slide htmxlink">
{{--                            hx-target="#main-content" hx-get="{{route('users')}}"--}}
                            <a  href="{{route('users')}}" class="side-menu__item htmxlink">მომხმარებლების მართვა</a>
                        </li>
                        <li class="slide ">
                            <a hx-get="{{route('other')}}" hx-trigger="click " hx-target="#main-content" hx-indicator="#indicator" class="side-menu__item htmxlink">მართვის პანელი</a>
                        </li>
                        <li class="slide ">
                            <a  href="{{route('upload.index')}}" class="side-menu__item htmxlink">ატვირთვა</a>
                        </li>
                        <li class="slide ">
                            <button  hx-indicator="#indicator" hx-trigger="click throttle:2s"  hx-get="{{route('main2')}}"  hx-target="#main-content" class="side-menu__item htmxlink">მთვარი</button>
                        </li>
                    </ul>
                </li>


{{--                General Menu--}}
                <li class="slide ">
                    <a href="{{route('existing.clients')}}" class="side-menu__item">
                    <span  style="color:green;margin-right: 5px" class="material-symbols-outlined">group</span>
                        <span class="side-menu__label">არსებული კლიენტები</span>
                    </a>
                </li>
                <li class="slide ">
                    <a href="{{route('potential.clients')}}" class="side-menu__item">
            <span style="color:orange;margin-right: 5px"  class="material-symbols-outlined">group</span>
                        <span class="side-menu__label">პოტენციური კლიენტები</span>
                    </a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                                           height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
