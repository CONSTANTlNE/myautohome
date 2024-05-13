
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
        <tr>
            <td><input type="text" id="col1" class="form-control searchinput"></td>
            <td><input type="text" id="col2" class="form-control searchinput"></td>
            <td><input type="text" id="col3" class="form-control searchinput"></td>
            <td><input type="text" id="col4" class="form-control searchinput"></td>
            <td><input type="text" id="col5" class="form-control searchinput"></td>
            <td><input type="text" id="col6" class="form-control searchinput"></td>
            <td><input type="text" id="col7" class="form-control searchinput"></td>
            <td><input type="text" id="col8" class="form-control searchinput"></td>
            <td><input type="text" id="col9" class="form-control searchinput"></td>
            <td><input type="text" id="col10" class="form-control searchinput"></td>
            <td><input type="text" id="col11" class="form-control searchinput"></td>
            <td></td>

        </tr>
        <tr>
            <th>შექმნის დრო</th>
            <th>განახლების დრო</th>
            <th>ნომერი <br> </th>
            <th>ოპერაოტრი</th>
            <th>კლიენტი</th>
            <th>ნომერი</th>
            <th>წყარო</th>
            <th>სტატუსი</th>
            <th>პროდუქტი</th>
            <th>კომპანია</th>
            <th>ბოლო კომენტარი</th>
            <th>მოქმედება</th>
        </tr>
        </thead>
        <tbody>
        @foreach($applications as $index=> $application)
            <tr>

                <td>{{$application->created_at}}</td>
                <td>{{$application->updated_at}}</td>
                <td>{{$application->number}}</td>
                <td>{{$application->user->name}}</td>
                <td>{{$application->client->name}}
                    {{$application->client->pid}}
                </td>
                <td>{{$application->client->mobile1}}</td>
                <td>{{$application->source->name}}</td>
                <td>{{$application->status->name}}</td>
                <td>{{$application->product->name}}</td>
                <td>
                    @foreach($application->companies as $index2c=> $company)

                        {{$company->name}} <br>
                    @endforeach
                </td>
                <td>{{$application->comments->last()?->name}}</td>
                <td>

            </tr>

        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>შექმნის დრო</th>
            <th>განახლების დრო</th>
            <th>ნომერი</th>
            <th>ოპერაოტრი</th>
            <th>კლიენტი</th>
            <th>ნომერი</th>
            <th>წყარო</th>
            <th>სტატუსი</th>
            <th>პროდუქტი</th>
            <th>კომპანია</th>
            <th>ბოლო კომენტარი</th>
            <th>მოქმედება</th>


        </tr>
        </tfoot>
    </table>

    <script>
        let table{{$counter}};

        let table{{$counter}} = new DataTable('#example', {
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
            table{{$counter}}
                .columns(0)
                .search(this.value)
                .draw();
        });
        $('#col2').on('keyup', function () {
            table{{$counter}}
                .columns(1)
                .search(this.value)
                .draw();
        });
        $('#col3').on('keyup', function () {
            table{{$counter}}
                .columns(2)
                .search(this.value)
                .draw();
        });
        $('#col4').on('keyup', function () {
            table{{$counter}}
                .columns(3)
                .search(this.value)
                .draw();
        });
        $('#col5').on('keyup', function () {
            table{{$counter}}
                .columns(4)
                .search(this.value)
                .draw();
        });
        $('#col6').on('keyup', function () {
            table{{$counter}}
                .columns(5)
                .search(this.value)
                .draw();
        });
        $('#col7').on('keyup', function () {
            table{{$counter}}
                .columns(6)
                .search(this.value)
                .draw();
        });
        $('#col8').on('keyup', function () {
            table{{$counter}}
                .columns(7)
                .search(this.value)
                .draw();
        });
        $('#col9').on('keyup', function () {
            table{{$counter}}
                .columns(8)
                .search(this.value)
                .draw();
        });
        $('#col10').on('keyup', function () {
            table{{$counter}}
                .columns(9)
                .search(this.value)
                .draw();
        });
        $('#col11').on('keyup', function () {
            table{{$counter}}
                .columns(10)
                .search(this.value)
                .draw();
        });


    </script>
