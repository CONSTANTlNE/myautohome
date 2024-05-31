
{{--    User Applications Modal--}}
{{--    <button type="button" class="m-1 ms-0 ti-btn ti-btn-primary-full" data-hs-overlay="#hs-full-screen-modal">--}}
{{--        Full screen--}}
{{--    </button>--}}
    <div id="hs-full-screen-modal" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
        <div class="hs-overlay-open:mt-0 ti-modal-box mt-10 !m-0 !max-w-full !w-full">
            <div class="ti-modal-content !rounded-none">
                <div class="ti-modal-header">
                    <h6 class="ti-modal-title">
                        მომხმარებლის მიერ შექმნილი განაცხადები
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#hs-full-screen-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <div id="userdetails" class="ti-modal-body">

                </div>
{{--                <div class="ti-modal-footer">--}}
{{--                    <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-secondary-full" data-hs-overlay="#hs-full-screen-modal">--}}
{{--                        დახურვა--}}
{{--                    </button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
{{--    click is triggered by datatables button--}}
    <a style="display: none" id="click" href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full" data-hs-overlay="#createuser">Launch demo modal
    </a>

    <div id="createuser" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">ახალი მომხმარებლის დამატება</h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#createuser">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <form
{{--                      action="{{route('user.create')}}"--}}

                      method="post">
                    @csrf
                <div class="ti-modal-body px-4">
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">სახელი</p>
                        <input type="text" name="name" class="form-control" id="input">

                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">მეილი</p>
                        <input type="email" name="email" class="form-control" id="input">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">მობილური</p>
                        <input type="text" name="mobile" class="form-control" id="input">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">პაროლი</p>
                        <input type="text" name="password" class="form-control" id="input">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                    <p class="mb-2 text-muted">როლი</p>
                    <select name="role" class="ti-form-select rounded-sm !py-2 !px-3">
                        <option selected=""></option>
                        <option value="operator">ოპერატორი</option>
                        <option value="admin">ადმინისტრატორი</option>
                        <option value="callcenter">ქოლცენტრის ოპერატორი</option>

                    </select>
                    </div>
                </div>
                <div class="ti-modal-footer">
                    <button data-hs-overlay="#createuser"

                            hx-target="#main-content"
                            hx-indicator="#indicator"
                            hx-trigger="click throttle:2s"
                            hx-post="{{route('user.htmxcreate')}}"
                            class="ti-btn bg-primary text-white !font-medium ">დამატება</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <table id="userstable" class="display nowrap" style="width:100%">
        <thead>
        <tr style="text-align: center!important;">

            <td style="text-align: center!important;">მომხმარებელი</td>
            <td style="text-align: center!important;">როლი</td>
            <td style="text-align: center!important;">მეილი</td>
            <td style="text-align: center!important;">მობილური</td>
            <td style="text-align: center!important;">განცხადებები</td>
            <td style="text-align: center!important;">პაროლის ცვლილება</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $index => $user)
            @if($user->name !== 'developer')
            <tr style="text-align: center!important;" >

                <td style="text-align: center!important;">{{$user->name}}</td>
                <td style="text-align: center!important;">{{$user->roles->first()->name}}</td>
                <td style="text-align: center!important;">{{$user->email}}</td>
                <td style="text-align: center!important;">{{$user->mobile}}</td>
                <td style="text-align: center!important;">


    <span style="cursor: pointer" hx-get="{{route('user.apps',$user->id)}}" hx-target="#userdetails" hx-indicator="#indicator" data-hs-overlay="#hs-full-screen-modal"  style="font-size: 1.2rem" class="badge !bg-warning/10 !text-warning !py-[0.25rem] !px-[0.45rem] !text-[0.75em] ms-2">{{$user->applications_count}}</span>

                </td>
                <td style="text-align: center!important;">
                    <a href="javascript:void(0);"  data-hs-overlay="#userpasswordupdate{{$index}}" class="side-menu__item hs-dropdown-toggle">
                        <span style="margin-right: 5px"   class="material-symbols-outlined text-primary">passkey</span>
                    </a>
                    </td>

            </tr>
            <div id="userpasswordupdate{{$index}}" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
                <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                    <div class="ti-modal-content">
                        <form action="{{route('user.password.change')}}" method="post" target="hidden_iframe">
                            @csrf
                            <input type="hidden" name="userid" value="{{$user->id}}">
                            <div class="ti-modal-header">
                                <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">
                                    {{$user->name}}
                                </h6>
                                <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#userpasswordupdate{{$index}}">
                                    <span class="sr-only">Close</span>
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <div class="ti-modal-body px-4">
                                <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                                    <label class="form-label">ახალი პაროლი</label>
                                    <input  name="password" type="text" class="form-control" aria-label="newpass">
                                </div>
                            </div>
                            <div class="ti-modal-footer">
                                <button type="submit" data-hs-overlay="#userpasswordupdate{{$index}}" class="userpasschange ti-btn bg-primary text-white !font-medium">შეცვლა</button>
                            </div>
                        </form>
                    </div>
                    <iframe name="hidden_iframe" style="display:none;"></iframe>
                </div>
            </div>
            @endif
        @endforeach
        </tbody>
{{--        <tfoot>--}}
{{--        <tr>--}}
{{--            <td style="text-align: center!important;">შექმნის თარიღი</td>--}}
{{--            <td style="text-align: center!important;">მომხმარებელი</td>--}}
{{--            <td style="text-align: center!important;">განცხადებები</td>--}}
{{--        </tr>--}}
{{--        </tfoot>--}}
    </table>

<script>

    if (typeof userstable !== 'undefined'  ) {
        userstable.destroy();
    }

    userstable = new DataTable('#userstable', {
        //Generall SETTINGS
        lengthMenu: [50, 100, 150, {label: 'All', value: -1}],

        columnDefs: [
            {orderable: true, targets: [0, 1, 2]}
        ],
        order: [[0, 'desc']],

        // lengthMenu: [ {label: 'All', value: -1}],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ka.json',
        },

        scrollX: true,
        scrollY: 700,


        layout: {

            topStart: {
                buttons: ['pageLength', 'colvis',
                    {
                        text: 'მომხმარებლის დამატება',
                        action: function (e, dt, node, config) {

                            document.getElementById('click').click()
                        }
                    }
                ],
            },

            topEnd: {
                search: '',
            }
        },
    });

</script>