
{{--    click is triggered by datatables button--}}
<a style="display: none" id="addclient" href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full" data-hs-overlay="#createpotentialclient">Launch demo modal
</a>
<div id="createpotentialclient" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">პოტენციური კლიენტის დამატება</h6>
                <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#createpotentialclient">
                    <span class="sr-only">Close</span>
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <form action="{{route('htmx.potential.clients.create')}}" method="post">
                @csrf
                <div class="ti-modal-body px-4">
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">პირადი ნომერი</p>
                        <input type="text" name="pid" class="form-control" >
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">სახელი</p>
                        <input type="text" name="name" class="form-control" >
                    </div>

                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">მობილური</p>
                        <input type="text" name="mobile" class="form-control" >
                    </div>

                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">კომენტარი</p>
                        <textarea name="comment" class="form-control"  rows="3"></textarea>
                    </div>
                </div>
                <div class="ti-modal-footer">
                    <button
                            hx-post="{{route('potential.clients.create')}}"
                            hx-target="#main-content"
                            hx-indicator="#indicator"
                            type="button"
                            data-hs-overlay="#createpotentialclient"
                            class="ti-btn bg-primary text-white !font-medium">დამატება
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<table id="potentialclients" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <td><input type="text"  id="column1" class="form-control searchinput"></td>
        <td><input type="text" id="column2"  class="form-control searchinput"></td>
        <td><input type="text" id="column3"  class="form-control searchinput"></td>
        <td><input type="text"  id="column4" class="form-control searchinput"></td>
        <td><input type="text"  id="column5" class="form-control searchinput"></td>
        <td><input type="text" id="column6"  class="form-control searchinput"></td>
        <td></td>
    </tr>
    <tr style="text-align: center!important;">
        <td style="text-align: center!important;">შექმნის თარიღი</td>
        <td style="text-align: center!important;">ოპერატორი</td>
        <td style="text-align: center!important;">პირადი ნომერი</td>
        <td style="text-align: center!important;">სახელი გვარი</td>
        <td style="text-align: center!important;">მობილური</td>
        <td style="text-align: center!important;">კომენტარი</td>
        <td style="text-align: center!important;">მოქმედება</td>

    </tr>
    </thead>
    <tbody>
    @foreach($potentialclients as $index => $client)
        <tr style="text-align: center!important;" >
            <td style="text-align: center!important;">{{$client->created_at}}</td>
            <td style="text-align: center!important;">{{$client->user->name}}</td>
            <td style="text-align: center!important;">{{$client->pid}}</td>
            <td style="text-align: center!important;">{{$client->name}}</td>
            <td style="text-align: center!important;">{{$client->mobile}}</td>
            <td style="text-align: center!important;">{{$client->comment}}</td>

            <td style="text-align: center!important;">


                <a   href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full" data-hs-overlay="#editpotentialclient{{$index}}">რედაქტირება
                </a>
                <div id="editpotentialclient{{$index}}" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                        <div class="ti-modal-content">
                            <div class="ti-modal-header">
                                <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">რედაქტირება {{$index}}</h6>
                                <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#editpotentialclient{{$index}}">
                                    <span class="sr-only">Close</span>
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <form
                                    {{--                                        action="{{route('potential.clients.update')}}" method="post"--}}
                            >
                                @csrf
                                <input type="hidden" name="id" value="{{$client->id}}">
                                <div class="ti-modal-body px-4">
                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                                        <p class="mb-2 text-muted">პირადი ნომერი</p>
                                        <input
                                                @if($client->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter') )
                                                    disabled
                                                @endif
                                                type="text" value="{{$client->pid}}" name="pid" class="form-control" >
                                    </div>
                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                                        <p class="mb-2 text-muted">სახელი</p>
                                        <input
                                                @if($client->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter') )
                                                    disabled
                                                @endif
                                                type="text"  value="{{$client->name}}"  name="name" class="form-control" >
                                    </div>

                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                                        <p class="mb-2 text-muted">მობილური</p>
                                        <input
                                                @if($client->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter') )
                                                    disabled
                                                @endif
                                                type="text" value="{{$client->mobile}}"  name="mobile" class="form-control" >
                                    </div>

                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                                        <p class="mb-2 text-muted">კომენტარი</p>
                                        <textarea
                                                @if($client->user_id!=$authuser->id && $authuser->hasAnyRole('operator') )
                                                    disabled
                                                @endif
                                                name="comment" class="form-control"  rows="3">{{$client->comment}}</textarea>
                                    </div>
                                </div>
                                @if($client->user_id!=$authuser->id && $authuser->hasAnyRole('admin|callcenter|developer') )
                                <div class="ti-modal-footer">
                                    <button data-hs-overlay="#editpotentialclient{{$index}}"
                                            hx-post="{{route('htmx.potential.clients.update')}}"
                                            hx-target="#main-content"
                                            {{--                                                hx-target-error="#errors"--}}
                                            hx-indicator="#indicator"
                                            class="ti-btn bg-primary text-white !font-medium">შენახვა</button>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>


            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td style="text-align: center!important;">შექმნის თარიღი</td>
        <td style="text-align: center!important;">ოპერატორი</td>
        <td style="text-align: center!important;">პირადი ნომერი</td>
        <td style="text-align: center!important;">სახელი გვარი</td>
        <td style="text-align: center!important;">მობილური</td>
        <td style="text-align: center!important;">კომენტარი</td>
        <td style="text-align: center!important;">მოქმედება</td>

    </tr>
    </tfoot>
</table>


<script>


    if (typeof potentialclients !== 'undefined'  ) {
        potentialclients.destroy();
    }



    potentialclients= new DataTable('#potentialclients', {
        //Generall SETTINGS
        lengthMenu: [10, 100, 150, {label: 'All', value: -1}],

        columnDefs: [
            {orderable: false, targets: [1, 2, 3, 4, 5, 6]}
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
                buttons: ['pageLength', 'colvis' @if($authuser->hasAnyRole('admin|developer')) , 'excel' @endif ,
                    {
                        text: ' დამატება',
                        action: function (e, dt, node, config) {

                            document.getElementById('addclient').click()
                        }
                    }
                ],
                // pageLength: {
                //   menu: [ 10, 25, 50, 100,5000 ]
                // }
            },

            topEnd: {
                // search: '',
            }
        },


    });

    $('#column1').on('keyup', function () {
        potentialclients
            .columns(0)
            .search(this.value)
            .draw();
    });

    $('#column2').on('keyup', function () {
        potentialclients
            .columns(1)
            .search(this.value)
            .draw();
    });
    $('#column3').on('keyup', function () {
        potentialclients
            .columns(2)
            .search(this.value)
            .draw();
    });
    $('#column4').on('keyup', function () {
        potentialclients
            .columns(3)
            .search(this.value)
            .draw();
    });
    $('#column5').on('keyup', function () {
        potentialclients
            .columns(4)
            .search(this.value)
            .draw();
    });
    $('#column6').on('keyup', function () {
        potentialclients
            .columns(5)
            .search(this.value)
            .draw();
    });
    $('#column7').on('keyup', function () {
        potentialclients
            .columns(6)
            .search(this.value)
            .draw();
    });

</script>