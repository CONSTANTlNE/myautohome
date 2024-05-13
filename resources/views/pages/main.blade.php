@extends('layout')

@php
//    dd($applications[0]);
@endphp
@section('main')
    <div class="flex justify-center mt-7">


        <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-light ti-btn-wave"
                data-hs-overlay="#hs-large-modal">
            ახალი განაცხადი
        </button>

        <div id="hs-large-modal" class="hs-overlay hidden ti-modal">
            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out md:!max-w-2xl md:w-full m-3 md:mx-auto">
                <form action="{{route('app.create')}}" method="post">
                    @csrf
                    <div class="ti-modal-content">
                        <div class="ti-modal-header">
                            <h6 class="ti-modal-title">
                                განაცხადის შექმნა
                            </h6>
                            <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                                    data-hs-overlay="#hs-large-modal">
                                <span class="sr-only">Close</span>
                                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                            fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                        <div class="ti-modal-body">
                            <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2">
                                <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                                    <label class="form-label">პირადი ნომერი</label>
                                    <input name="customer_pid" type="text" class="form-control"
                                           aria-label="ninedigitnumber">
                                </div>
                                <div class="md:col-span-4 col-span-12 mb-4">
                                    <label class="form-label">სახელი / გვარი</label>
                                    <input name="customer_name" type="text" class="form-control"
                                           aria-label="FullName">
                                </div>
                                <div class="md:col-span-2 col-span-12 mb-4">
                                    <label class="form-label">მობილური</label>
                                    <input aria-label="tel" name="customer_mobile"
                                           style="padding-left: 0!important;padding-right: 0!important"
                                           type="text"
                                           class="form-control"
                                    >
                                </div>
                                <div class="md:col-span-3 col-span-12 mb-4">
                                    <label class="form-label">წყარო</label>
                                    <select name="source" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                        <option>არ არის არჩეული</option>
                                        @foreach($sources as $index => $source)
                                            <option value="{{$source->id}}">{{$source->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="md:col-span-4 col-span-12 mb-4">
                                    <label class="form-label">სტატუსი</label>
                                    <select name="status" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                        <option>არ არის არჩეული</option>
                                        @foreach($statuses as $index => $status)
                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="md:col-span-4 col-span-12 mb-4">
                                    <label class="form-label">პროდუქტი</label>
                                    <select name="product" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                        <option>არ არის არჩეული</option>
                                        @foreach($products as $index => $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class=" md:col-span-4 col-span-12 mb-4">
                                    <label class="form-label">კომპანია</label>
                                    <select name="company[]" class=" sm:mb-0 form-select !py-3"
                                            id="inlineFormSelectPref">
                                        <option selected="">არ არის არჩეული</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            {{--                        ==================================================================================--}}
                            <template id="companytemplate">
                                <div class="flex justify-end gap-6 w-full mt-2">
                                    <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecompany">წაშლა
                                    </button>

                                    <select style="max-width: 200px" name="company[]" class=" sm:mb-0 form-select !py-3"
                                            id="inlineFormSelectPref">
                                        <option selected="">არ არის არჩეული</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </template>
                            <div id="companydiv" class="w-full">

                            </div>
                            <div class="flex justify-center mt-7  mb-4">
                                <button id="newcompany" type="button" class="ti-btn ti-btn-primary-full ti-btn-wave">
                                    ახალი კომპანიის დამატება
                                </button>
                            </div>

                            {{--                            <p class="mb-4 text-center w-full">ავტომობილი მონაცემები</p>--}}
                            <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 mt-7">
                                <div class="md:col-span-3 col-span-12 mb-4">
                                    <label class="form-label">მწარმოებელი</label>

                                    <select aria-label="car" name="car" class="ti-form-select rounded-sm !p-0"
                                            id="carsselect"
                                            autocomplete="off">
                                        <option></option>

                                    </select>
                                </div>
                                <div class="md:col-span-3 col-span-12 mb-4">
                                    <label class="form-label">მოდელი</label>

                                    <select name="model" class="ti-form-select rounded-sm !p-0" id="modelsselect"
                                            autocomplete="off">
                                        <option></option>

                                    </select>
                                </div>
                                <div class="md:col-span-3 col-span-12 mb-4">
                                    <label class="form-label">წელი</label>
                                    <input name="year" type="text" class="form-control"
                                           aria-label="year">
                                </div>
                                <div class="md:col-span-3 col-span-12 mb-4">
                                    <label class="form-label">ძრავი</label>

                                    <input name="engine" type="text" class="form-control"
                                           aria-label="float number">
                                </div>
                                <div class="md:col-span-12 col-span-12 mb-4">
                                    <label class="form-label">ლინკი</label>

                                    <input name="link" type="url" class="form-control"
                                           aria-label="url">
                                </div>
                            </div>
                            <div class="md:col-span-12 col-span-12 mb-4">
                                <label class="form-label">კომენტარი</label>
                                <textarea name="comment" class="form-control" aria-label="With textarea"
                                          rows="3"></textarea>
                            </div>
                        </div>


                        <button class="ti-btn ti-btn-primary-full ti-btn-wave">შენახვა</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<div id="htmx">
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
</div>


@endsection