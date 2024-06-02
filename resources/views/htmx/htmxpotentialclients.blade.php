{{--    click is triggered by datatables button--}}
<a style="display: none" id="addclient" href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full"
   data-hs-overlay="#createpotentialclient">Launch demo modal
</a>
<div id="createpotentialclient" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">

    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">პოტენციური კლიენტის
                    დამატება</h6>

                <button id="closecreatepotential" type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                        data-hs-overlay="#createpotentialclient">
                    <span class="sr-only">Close</span>
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <form action="{{route('htmx.potential.clients.create')}}" method="post">
                @csrf
                <div class="ti-modal-body px-4">
                    <div id="createpotentialerror"></div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">პირადი ნომერი</p>
                        <input type="text" name="pid" class="form-control">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">სახელი</p>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">მობილური</p>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="md:col-span-4 col-span-12 mb-4">
                        <label class="form-label">სტატუსი</label>
                        <select name="status" class=" sm:mb-0 form-select !py-3">
                            @foreach($potentialstatuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                        <p class="mb-2 text-muted">კომენტარი</p>
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="ti-modal-footer">
                    <button
                            hx-post="{{route('htmx.potential.clients.create')}}"
                            hx-target="#main-content"
                            hx-indicator="#indicator"
{{--                            hx-target-error="#createpotentialerror"--}}
                            type="button"
                            data-hs-overlay="#createpotentialclient"
        id="createpotential"
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
        <td><input type="text" id="column1" class="form-control searchinput"></td>
        <td><input type="text" id="column2" class="form-control searchinput"></td>
        <td><input type="text" id="column3" class="form-control searchinput"></td>
        <td><input type="text" id="column4" class="form-control searchinput"></td>
        <td><input type="text" id="column5" class="form-control searchinput"></td>
        <td><input type="text" id="column6" class="form-control searchinput"></td>
        <td><input type="text" id="column7" class="form-control searchinput"></td>
        <td></td>
    </tr>
    <tr style="text-align: center!important;">
        <td style="text-align: center!important;">შექმნის თარიღი</td>
        <td style="text-align: center!important;">ოპერატორი</td>
        <td style="text-align: center!important;">პირადი ნომერი</td>
        <td style="text-align: center!important;">სახელი გვარი</td>
        <td style="text-align: center!important;">მობილური</td>
        <td style="text-align: center!important;">სტატუსი</td>
        <td style="text-align: center!important;">კომენტარი</td>
        <td style="text-align: center!important;">მოქმედება</td>
    </tr>
    </thead>
    <tbody>
    @foreach($potentialclients as $index => $client)
        <tr style="text-align: center!important;">
            <td style="text-align: center!important;">{{$client->created_at}}</td>
            <td style="text-align: center!important;">{{$client->user->name}}</td>
            <td style="text-align: center!important;">{{$client->pid}}</td>
            <td style="text-align: center!important;">{{$client->name}}</td>
            <td style="text-align: center!important;">{{$client->mobile}}</td>
            <td style="text-align: center!important;">
                @if($client->status_id!==null)
                    <span style="font-size: 15px;text-align: center!important"
                          class="{{$client->status->color}}">{{$client->status->name}}</span>
                @endif
            </td>
            <td style="text-align: center!important;">
                @if(!$client->comments->isEmpty())
                    @foreach($client->comments as $comment)
                        @if($loop->last)
                            <p>{{$comment->user->name}} - {{$comment->created_at}}</p>
                            <p>{{$comment->comment}}</p>
                        @endif
                    @endforeach
                @else
                    @if($client->comment!==null)
                    <p>{{$client->user->name}} - {{$client->created_at}}</p>
                    <p>{{$client->comment}}</p>
                    @endif
                @endif

            </td>
            <td style="text-align: center!important;">
                <button data-hs-overlay="#editpotentialclientinsearch"
                        hx-get="{{route('edit.search.potential',$client->id)}}"
                        hx-target="#potentialeditform"
                        hx-indicator="#indicator"
                        class="ti-btn bg-primary text-white !font-medium">რედაქტირება
                </button>
                @if($authuser->hasAnyrole('admin|developer'))
                <form>
                    @csrf
                <input type="hidden" name="id" value="{{$client->id}}">
                <a style="color:red" href="javascript:void(0);"
                   class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                   hx-post="{{route('potential.htmx.deletete')}}"
                   hx-target="#main-content"
                   hx-indicator="#indicator"
                >წაშლა</a>
                </form>
                @endif
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
        <td style="text-align: center!important;">სტატუსი</td>
        <td style="text-align: center!important;">კომენტარი</td>
        <td style="text-align: center!important;">მოქმედება</td>

    </tr>
    </tfoot>
</table>
<div id="editpotentialclientinsearch" class="hs-overlay hidden ti-modal [--overlay-backdrop:static]">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content" id="potentialeditform">

        </div>
    </div>
</div>


<script>


    if (typeof potentialclients !== 'undefined') {
        potentialclients.destroy();
    }


    potentialclients = new DataTable('#potentialclients', {
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