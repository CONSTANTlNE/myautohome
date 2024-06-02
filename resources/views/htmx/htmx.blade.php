

<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <td><input type="text" id="col1" class="form-control searchinput"></td>
        <td><input type="text" id="col1" class="form-control searchinput"></td>
        <td><input type="text" id="col2" class="form-control searchinput"></td>
        <td><input type="text" id="col4" class="form-control searchinput"></td>
        <td><input type="text" id="col5" class="form-control searchinput"></td>
        <td><input type="text" id="col6" class="form-control searchinput"></td>
        <td><input type="text" id="col7" class="form-control searchinput"></td>
        <td><input type="text" id="col8" class="form-control searchinput"></td>
        <td><input type="text" id="col9" class="form-control searchinput"></td>
        {{--        <td><input type="text" id="col10" class="form-control searchinput"></td>--}}
        <td><input type="text" id="col11" class="form-control searchinput"></td>
        <td></td>

    </tr>
    <tr style="text-align: center">
        <th style="text-align: center">ნომერი</th>
        <th style="text-align: center">შექმნის დრო</th>
        <th style="text-align: center">განახლების დრო</th>
        <th style="text-align: center">ოპერაოტრი</th>
        <th style="text-align: center">კლიენტი</th>
        <th style="text-align: center">მობილური</th>
        <th style="text-align: center">წყარო</th>
        <th style="text-align: center;width: 100px!important">სტატუსი</th>
        <th style="text-align: center">პროდუქტი</th>
        {{--        <th style="text-align: center">კომპანია</th>--}}
        <th style="text-align: center">ბოლო კომენტარი</th>
        <th style="text-align: center">მოქმედება</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $index=> $application)
        <tr style="text-align: center!important">
            <td>{{$application->id}}</td>
            <td style="white-space: normal !important;text-align: center!important">{{$application->created_at}}</td>
            <td style="white-space: normal !important;text-align: center!important">{{$application->updated_at}}</td>
            <td>{{$application->user->name}}</td>
            <td style="white-space: normal !important;">
                {{$application->client->name}}
                {{$application->client->pid}}
            </td>
            <td style="white-space: normal !important">{{$application->client->mobile1}}</td>
            <td>{{$application->source->name}}</td>
            <td style="text-align: center!important;width: 100px;!important;white-space: normal !important">
                <span style="font-size: 15px;text-align: center!important"
                      class="{{$application->status->color}}">{{$application->status->name}}</span>

            </td>
            <td>{{$application->product->name}}</td>
            {{--            <td>--}}
            {{--                @foreach($application->companies as $index2c=> $company)--}}
            {{--                    {{$company->name}}<br>--}}
            {{--                @endforeach--}}
            {{--            </td>--}}
            <td style="white-space: normal !important;max-width: 250px!important;">{{$application->comments->last()?->comment}}</td>

            <td>
                <div class="hs-dropdown ti-dropdown">
                    <a aria-label="anchor" href="javascript:void(0);"
                       class="flex items-center justify-center w-[1.75rem] h-[1.75rem]  !text-[0.8rem] !py-1 !px-2 rounded-sm bg-light border-light shadow-none !font-medium"
                       aria-expanded="false">
                        <i class="fe fe-more-vertical text-[0.8rem]"></i>
                    </a>
                    <ul style="position: absolute" class="hs-dropdown-menu ti-dropdown-menu hidden">

                        {{--  TESTING ROUTES--}}
                        @role('developer')
                        <li>
                            <a target="_blank"
                               class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                               href="{{route('app.details', $application->id)}}">დეტალურად 1</a>
                        </li>

                        <li>

                            <a target="_blank"
                               class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                               href="{{route('app.edit', $application->id)}}"
                            >რედაქტირება 1</a>
                        </li>

                        <li
                                hx-get="{{route('edit.htmx', $application->id)}}"
                                hx-target="#edittarget"
                                hx-indicator="#indicator">
                            <a data-hs-overlay="#editmodal" href="javascript:void(0);"
                               class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                            >დეტალურად</a>
                        </li>

                        @endrole

                        <li
                                hx-get="{{route('edit.htmx', $application->id)}}"
                                hx-target="#edittarget"
                                hx-indicator="#indicator">
                            <a data-hs-overlay="#editmodal" href="javascript:void(0);"
                               class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                            >დეტალურად</a>
                        </li>

                        {{--ADMIN ROUTES--}}
                        @role('admin')
                        <li>
                            <a href="javascript:void(0);"
                               class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                               data-hs-overlay="#delete"
                               hx-get="{{route('app.htmx.deletete', $application->id)}}"
                               hx-target="#deletedetails"
                               hx-indicator="#indicator"
                            >წაშლა
                            </a>
                        </li>
                        @endrole


                    </ul>


                </div>

            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>ნომერი</th>

        <th>შექმნის დრო</th>
        <th>განახლების დრო</th>
        <th>ნომერი</th>
        <th>ოპერაოტრი</th>
        <th>კლიენტი</th>
        <th>წყარო</th>
        <th>სტატუსი</th>
        <th>პროდუქტი</th>
        {{--        <th>კომპანია</th>--}}
        <th>ბოლო კომენტარი</th>
        <th>მოქმედება</th>


    </tr>
    </tfoot>
</table>

<script>


    table.destroy();


    {{--let table{{$counter}};--}}

        table = new DataTable('#example', {
        //Generall SETTINGS

        lengthMenu: [10, 100, 150, {label: 'All', value: -1}],

        columnDefs: [
            {orderable: false, targets: [2, 3, 4, 5, 6, 7, 8, 9, 10]}
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
                buttons: ['pageLength', 'colvis' @if($authuser->hasAnyRole('admin|developer')) , 'excel' @endif ],
                // pageLength: {
                //   menu: [ 10, 25, 50, 100,5000 ]
                // }
            },

            topEnd: {
                // search: '',
            }
        },


    });


    $('#col1').on('keyup', function () {
        table
            .columns(1)
            .search(this.value)
            .draw();
    });

    $('#col2').on('keyup', function () {
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
    // $('#col9').on('keyup', function () {
    //     table
    //         .columns(8)
    //         .search(this.value)
    //         .draw();
    // });
    $('#col10').on('keyup', function () {
        table
            .columns(8)
            .search(this.value)
            .draw();
    });
    $('#col11').on('keyup', function () {
        table
            .columns(9)
            .search(this.value)
            .draw();
    });


</script>
