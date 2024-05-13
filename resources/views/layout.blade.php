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

</head>

<body>

<!-- ========== Switcher  ========== -->
@include('components.switcher')
<!-- ========== END Switcher  ========== -->

<!-- Loader -->
<div id="loader">
    {{--        <img src="../assets/images/media/loader.svg" alt="">--}}
</div>
<!-- Loader -->
<div class="page">

    <!-- Start::Header -->
    @include('components.header')
    <!-- End::Header -->
    <!-- Start::app-sidebar -->
    @include('components.sidebar')
    <!-- End::app-sidebar -->


    <!-- Start::content  -->
    <div class="content">
        <!-- Start::main-content -->
        <div id="main-content" class="main-content">

            @yield('main')
            @yield('other')
            @yield('users')
            @yield('upload')

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
            {orderable: false, targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}
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

    newcompany.addEventListener('click', () => {

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
</script>


{{--CarsJson--}}
@if(request()->routeIs('main'))
    <script>

        const carsData = {!! $carsJson !!};

        // CARS
        // console.log(carsData)
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

