<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div style="padding:0!important" class="main-sidebar-header">
        <a
                {{--                                href="{{route('main')}}"--}}
                href="javascript:void(0);"
                hx-get="{{route('main2')}}"
                hx-target="#main-content"
                hx-indicator="#indicator"
                class="header-logo"
                id="mainpagelink1"
        >
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

                @role('admin|developer')
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
                            <a
                                    hx-get="{{route('htmx.users')}}" hx-trigger="click throttle:2s"
                                    hx-indicator="#indicator"
                                    hx-target="#main-content"
                                    id="userspage"
                                    class="side-menu__item htmxlink">მომხმარებლების მართვა</a>
                        </li>
                        <li class="slide ">
                            <a
                                    {{--                                    href="{{route('other')}}"--}}

                                    id="controlpanelpage"
                                    href="javascript:void(0);"
                                    hx-get="{{route('htmx.other')}}" hx-trigger="click "
                                    hx-target="#main-content" hx-indicator="#indicator"
                                    class="side-menu__item htmxlink">მართვის
                                პანელი</a>
                        </li>
                        @role('developer')
                        <li class="slide ">
                            <a href="{{route('upload.index')}}" class="side-menu__item htmxlink">ატვირთვა</a>
                        </li>
                        @endrole
                        {{--                        <li class="slide ">--}}
                        {{--                            <button hx-indicator="#indicator" hx-trigger="click throttle:2s" hx-get="{{route('main2')}}"--}}
                        {{--                                    hx-target="#main-content" class="side-menu__item htmxlink">მთავარი--}}
                        {{--                            </button>--}}
                        {{--                        </li>--}}
                        <li class="slide ">
                            <a href="javascript:void(0);" data-hs-overlay="#cars"
                               class="side-menu__item hs-dropdown-toggle">
                                <span class="side-menu__label">ავტომობილის დამატება</span>
                            </a>
                        </li>
{{--                        <li class="slide">--}}
{{--                            <a href="javascript:void(0);" data-hs-overlay="#ips"--}}
{{--                               hx-get="{{route('htmx.create')}}"--}}
{{--                               hx-target="#iptarget"--}}
{{--                               hx-indicator="#indicator"--}}
{{--                               class="side-menu__item hs-dropdown-toggle">--}}
{{--                                <span class="side-menu__label">IP დაშვება</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                @endrole

                {{--                General Menu--}}
                {{--                <li class="slide ">--}}
                {{--                    <a href="{{route('existing.clients')}}" class="side-menu__item">--}}
                {{--                        <span style="color:green;margin-right: 5px" class="material-symbols-outlined">group</span>--}}
                {{--                        <span class="side-menu__label">არსებული კლიენტები</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="slide ">
                    <a
                            {{--                                                        href="{{route('potential.clients')}}"--}}
                            href="javascript:void(0);"
                            hx-get="{{route('htmx.potential.clients')}}"
                            hx-indicator="#indicator"
                            hx-target="#main-content"
                            id="potentialclientsbtn"
                            class="side-menu__item">
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
<div id="newpassword" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content">
            <form action="{{route('password.change')}}" method="post" target="hidden_iframe">
                @csrf
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">
                        @if(auth()->check())
                            {{$authuser->name}}
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
{{--    ADD new Car Modal--}}
@role('admin')
<div id="cars" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content">
            <form action="{{route('cars.add')}}" method="post"
                  target="hidden_iframe2"
            >
                @csrf
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold">
                        ახალი მწარმოებლის და მოდელის დამატება
                    </h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                            data-hs-overlay="#cars">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ti-modal-body px-4">
                    <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">ახალი მწარმოებელი</label>
                        <input name="newcar" type="text" class="form-control" aria-label="newcar">
                    </div>
                    <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">მოდელი</label>
                        <input name="newmodel" type="text" class="form-control" aria-label="newmodel">
                    </div>
                </div>
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold">
                        არსებულ მწარმოებელზე ახალი მოდელის დამატება
                    </h6>
                </div>
                <div class="ti-modal-body px-4">
                    <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">არსებული მწარმოებელი</label>
                        <select
                                aria-label="car" name="existingcar" class="ti-form-select rounded-sm !p-0"
                                id="carsselect3"
                                autocomplete="off">
                            <option></option>
                            @foreach($cars as $car)
                                <option value="{{$car->id}}">{{$car->make}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">ახალი მოდელი</label>
                        <input name="newmodel2" type="text" class="form-control" aria-label="newmodel2">
                    </div>
                </div>
                <div class="ti-modal-footer">
                    <button id="" type="submit" data-hs-overlay="#cars"
                            class="ti-btn bg-primary text-white !font-medium">დამატება
                    </button>
                </div>
            </form>
        </div>
        <iframe name="hidden_iframe2" style="display:none;"></iframe>
    </div>
</div>
@endrole
{{--    ADD new Ip Modal--}}
<div id="ips" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out" id="iptarget">


    </div>
</div>
<iframe name="hidden_iframe3" style="display:none;"></iframe>
