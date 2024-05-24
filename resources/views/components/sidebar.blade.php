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
                </svg>
            </div>
            <ul class="main-menu">

                {{--                Admin Menu--}}

                @role('admin')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <span style="margin-right: 5px" class="material-symbols-outlined text-primary">settings</span>
                        <span class="side-menu__label">ადმინი</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Dashboards</a>
                        </li>
                        <li class="slide htmxlink">
                            <a target="_blank" href="{{ url('/log-viewer') }}" class="side-menu__item htmxlink">ცვლილებების
                                ნახვა</a>
                        </li>
                        <li class="slide htmxlink">
                            <a href="{{route('users')}}" class="side-menu__item htmxlink">მომხმარებლების მართვა</a>
                        </li>
                        <li class="slide ">
                            <a hx-get="{{route('htmx.other')}}" hx-push-url="true" hx-trigger="click "
                               hx-target="#main-content" hx-indicator="#indicator" class="side-menu__item htmxlink">მართვის
                                პანელი</a>
                        </li>
                        <li class="slide ">
                            <a href="{{route('upload.index')}}" class="side-menu__item htmxlink">ატვირთვა</a>
                        </li>
                        <li class="slide ">
                            <button hx-indicator="#indicator" hx-trigger="click throttle:2s" hx-get="{{route('main2')}}"
                                    hx-target="#main-content" class="side-menu__item htmxlink">მთავარი
                            </button>
                        </li>
                    </ul>
                </li>
                @endrole

                {{--                General Menu--}}
                <li class="slide ">
                    <a href="{{route('existing.clients')}}" class="side-menu__item">
                        <span style="color:green;margin-right: 5px" class="material-symbols-outlined">group</span>
                        <span class="side-menu__label">არსებული კლიენტები</span>
                    </a>
                </li>
                <li class="slide ">
                    <a href="{{route('potential.clients')}}" class="side-menu__item">
                        <span style="color:orange;margin-right: 5px" class="material-symbols-outlined">group</span>
                        <span class="side-menu__label">პოტენციური კლიენტები</span>
                    </a>
                </li>
                <li class="slide ">
                    <a href="javascript:void(0);" data-hs-overlay="#newpassword"
                       class="side-menu__item hs-dropdown-toggle">
                        <span style="margin-right: 5px" class="material-symbols-outlined text-primary">passkey</span>
                        <span class="side-menu__label">პაროლის ცვლილება</span>
                    </a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                     height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>

{{--password reset modal--}}
<div id="newpassword" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content">
            <form action="{{route('password.change')}}" method="post" target="hidden_iframe">
                @csrf
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">
                        @if(auth()->check())
                            {{auth()->user()->name}}
                        @endif
                    </h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                            data-hs-overlay="#newpassword">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ti-modal-body px-4">
                    <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">ახალი პაროლი</label>
                        <input name="password" type="text" class="form-control" aria-label="newpass">
                    </div>
                </div>
                <div class="ti-modal-footer">
                    <button id="userchangepassword" type="submit" data-hs-overlay="#newpassword"
                            class="ti-btn bg-primary text-white !font-medium">შეცვლა
                    </button>
                </div>
            </form>
        </div>
        <iframe name="hidden_iframe" style="display:none;"></iframe>
    </div>
</div>