@extends('layout')

@section('main')
    <div id="tableContainer" style="overflow: auto;">
        <table id="dataTable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th><p>ნომერი</p>
                    <input type="text"  class="form-control searchinput"></th>
                <th>
                    <p>შექმნის დრო</p>
                    <input type="text" id="col1" class="form-control searchinput"></th>

            </tr>

            </thead>
            <tbody>
            @foreach($applications as $index=> $application)
                <tr style="text-align: center!important">
                    <td style="white-space: normal !important;text-align: center!important">{{$application->id}}</td>
                    <td style="white-space: normal !important;text-align: center!important">{{$application->created_at}}</td>

                    <td>
                        <div class="hs-dropdown ti-dropdown">
                            <a aria-label="anchor" href="javascript:void(0);"
                               class="flex items-center justify-center w-[1.75rem] h-[1.75rem]  !text-[0.8rem] !py-1 !px-2 rounded-sm bg-light border-light shadow-none !font-medium"
                               aria-expanded="false">
                                <i class="fe fe-more-vertical text-[0.8rem]"></i>
                            </a>
                            <ul style="position: absolute" class="hs-dropdown-menu ti-dropdown-menu hidden">

                                <li>
                                    <a target="_blank"
                                       class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                       href="{{route('app.edit2', $application->id)}}"
                                    >რედაქტირება 1</a>
                                </li>


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
                {{--            <th>კომპანია</th>--}}
                <th>ბოლო კომენტარი</th>
                <th>მოქმედება</th>


            </tr>
            </tfoot>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInputs = document.querySelectorAll('.searchinput');
            const dataTable = document.getElementById('dataTable').getElementsByTagName('tbody')[0];

            // Function to filter rows based on input values
            function filterRows() {
                const filters = Array.from(searchInputs).map(input => input.value.trim());

                Array.from(dataTable.rows).forEach(row => {
                    const cells = Array.from(row.cells);
                    const rowData = cells.map(cell => cell.textContent.trim());
                    const rowVisible = filters.every((filter, index) => {
                        return filter === '' || rowData[index].includes(filter);
                    });

                    row.style.display = rowVisible ? '' : 'none';
                });
            }

            // Add event listeners to search inputs
            searchInputs.forEach(input => {
                input.addEventListener('input', filterRows);
            });
        });

        // FIX HEADER AND SCROLLBAR
        document.addEventListener("DOMContentLoaded", function () {
            const dataTable = document.getElementById('dataTable');
            const tableContainer = document.getElementById('tableContainer');

            // Adjust the table width to match the container's width
            const adjustTableWidth = () => {
                const containerWidth = tableContainer.clientWidth;
                dataTable.style.width = containerWidth + 'px';
            };

            // Fix the table header when scrolling
            const fixTableHeader = () => {
                const containerRect = tableContainer.getBoundingClientRect();
                const tableRect = dataTable.getBoundingClientRect();

                if (containerRect.top > tableRect.top) {
                    dataTable.classList.remove('fixed-header');
                } else {
                    dataTable.classList.add('fixed-header');
                }
            };

            // Listen for container resize and scroll events
            tableContainer.addEventListener('scroll', fixTableHeader);
            window.addEventListener('resize', adjustTableWidth);

            // Initial adjustments
            adjustTableWidth();
            fixTableHeader();
        });


    </script>
@endsection