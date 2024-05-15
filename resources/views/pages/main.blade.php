@extends('layout')

@php
//    dd(auth()->user()->can('Own_Data'));
@endphp
@section('main')


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
        <tr style="text-align: center">
            <th style="text-align: center">შექმნის დრო</th>
            <th style="text-align: center">განახლების დრო</th>
            <th style="text-align: center">ნომერი </th>
            <th style="text-align: center">ოპერაოტრი</th>
            <th style="text-align: center">კლიენტი</th>
            <th style="text-align: center">მობილური</th>
            <th style="text-align: center">წყარო</th>
            <th style="text-align: center">სტატუსი</th>
            <th style="text-align: center">პროდუქტი</th>
            <th style="text-align: center">კომპანია</th>
            <th style="text-align: center">ბოლო კომენტარი</th>
            <th style="text-align: center">მოქმედება</th>
        </tr>
        </thead>
        <tbody>
        @foreach($applications as $index=> $application)

{{--            @php dd($application->car->models->where('id', )->first()) @endphp--}}
            <tr style="text-align: center!important">

                <td style="white-space: normal !important;text-align: center!important" >{{$application->created_at}}</td>
                <td style="white-space: normal !important;text-align: center!important">{{$application->updated_at}}</td>
                <td>{{$application->number}}</td>
                <td >{{$application->user->name}}</td>
                <td style="white-space: normal !important;">
                    {{$application->client->name}}
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
                                   href="{{route('app.details', $application->id)}}">დეტალურად</a>
                            </li>
                            @if($application->user->id == auth()->user()->id && auth()->user()->can('Own_Data'))
                            <li>
                                <a
                                   data-hs-overlay="#editmodal"
                                   class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
{{--                                   href="{{route('app.edit', $application->id)}}"--}}
                                >რედაქტირება</a>
                            </li>
                            @else
                                <li>
                                    <a  data-hs-overlay="#editmodal{{$index}}"
                                       class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                     >რედაქტირება</a>
                                </li>
                            @endif

                            <li>
                                <a href="javascript:void(0);"
                                   class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                   data-hs-overlay="#delete{{$index}}">წაშლა
                                </a>
                            </li>

                        </ul>
                        <div id="delete{{$index}}" class="hs-overlay hidden ti-modal">
                            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                <div class="ti-modal-content">
                                    <div class="ti-modal-header">
                                        {{--                                        <h6 class="modal-title text-[1rem] font-semibold text-center" >Delete Purchase</h6>--}}
                                        {{--                                        <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#todo-compose{{$index}}">--}}
                                        {{--                                            <span class="sr-only">Close</span>--}}
                                        {{--                                            <i class="ri-close-line"></i>--}}
                                        {{--                                        </button>--}}
                                    </div>
                                    <div class="ti-modal-body px-4">
                                        ტექსტი
                                    </div>
                                    <div class="ti-modal-footer">
                                        <button type="button"
                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                data-hs-overlay="#delete{{$index}}">
                                            Close
                                        </button>
                                        <form action="">
                                            <input type="hidden" name="id" value="{{$application->id}}">
                                            @csrf
                                            <button class="ti-btn bg-primary text-white !font-medium">წაშლა</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="editmodal{{$index}}" class="editmodal hs-overlay hidden ti-modal">
                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out md:!max-w-2xl md:w-full m-3 md:mx-auto">
                            <div class="flex justify-center w-full mb-6 mt-2">
                                <input  style="max-width:200px!important;" class="form-control text-center " disabled type="text" value="განაცხადი No {{$application->number}}" >
                            </div>
                            <div class="flex justify-center w-full">

                                <form style="max-width: 700px!important;background-color: rgb(var(--body-bg));padding: 20px" action="{{route('app.update')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$application->id}}">

                                    <div class="ti-modal-body">
                                        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2">
                                            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                                                <label class="form-label">პირადი ნომერი</label><br>
                                                <input name="customer_pid" type="text" class="form-control"
                                                       aria-label="ninedigitnumber" value="{{$application->client->pid}}">
                                            </div>
                                            <div class="md:col-span-4 col-span-12 mb-4">
                                                <label class="form-label">სახელი / გვარი</label><br>
                                                <input name="customer_name" type="text" class="form-control"
                                                       aria-label="FullName" value="{{$application->client->name}}">
                                            </div>
                                            <div class="md:col-span-2 col-span-12 mb-4">
                                                <label class="form-label">მობილური</label><br>
                                                <input aria-label="tel" name="customer_mobile"
                                                       style="padding-left: 0!important;padding-right: 0!important"
                                                       type="text"
                                                       class="form-control"
                                                       value="{{$application->client->mobile1}}"
                                                >
                                            </div>
                                            <div class="md:col-span-3 col-span-12 mb-4">
                                                <label class="form-label">წყარო</label><br>
                                                <select name="source" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">

                                                    <option value="{{$application->source->id}}">{{$application->source->name}}</option>
                                                    @foreach($sources as $index => $source)
                                                        <option value="{{$source->id}}">{{$source->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class=" md:col-span-6 col-span-12 mb-4">
                                                <label class="form-label">სტატუსი</label><br>
                                                <select name="status" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                                    <option value="{{$application->status->id}}">{{$application->status->name}}</option>
                                                    @foreach($statuses as $index => $status)
                                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="md:col-span-6 col-span-12 mb-4">
                                                <label class="form-label">პროდუქტი</label><br>
                                                <select name="product" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                                                    <option value="{{$application->product->id}}">{{$application->product->name}}</option>
                                                    @foreach($products as $index => $product)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>


                                            {{--            <div class=" md:col-span-4 col-span-12 mb-4">--}}
                                            {{--                <label class="form-label">კომპანია</label>--}}
                                            {{--                <select name="company[]" class=" sm:mb-0 form-select !py-3"--}}
                                            {{--                        id="inlineFormSelectPref">--}}
                                            {{--                    <option value="{{$application->companies[0]->id}}">{{$application->companies[0]->name}}</option>--}}
                                            {{--                    @foreach($companies as $company)--}}
                                            {{--                        <option value="{{$company->id}}">{{$company->name}}</option>--}}
                                            {{--                    @endforeach--}}
                                            {{--                </select>--}}
                                            {{--            </div>--}}


                                        </div>
                                        {{--                        ==================================================================================--}}
                                        <template class="companytemplate" >
                                            <div class="flex justify-center gap-6 w-full mt-2">
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
                                        <div  class="w-full companydiv">
                                            @foreach($application->companies as $index5 => $company)

                                                <div class="flex justify-center gap-6 w-full mt-2">
                                                    <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecompany">წაშლა
                                                    </button>

                                                    <select style="max-width: 200px" name="company[]" class=" sm:mb-0 form-select !py-3"
                                                            id="inlineFormSelectPref">

                                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                                        @foreach($companies as $index2 => $company2)
                                                            <option value="{{$company2->id}}">{{$company2->name}}</option>

                                                        @endforeach
                                                    </select>

                                                </div>

                                            @endforeach
                                        </div>
                                        <div class="flex justify-center mt-7  mb-4">
                                            <button  type="button" class="newcompany ti-btn ti-btn-primary-full ti-btn-wave">
                                                ახალი კომპანიის დამატება
                                            </button>
                                        </div>

                                        {{--                            <p class="mb-4 text-center w-full">ავტომობილი მონაცემები</p>--}}
                                        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 mt-7">
                                            <div class="md:col-span-3 col-span-12 mb-4">
                                                <label class="form-label">მწარმოებელი</label>

                                                <select aria-label="car" name="car" class="carsselect ti-form-select rounded-sm !p-0"

                                                        autocomplete="off">
                                                    <option value="{{$application->car_id}}" >{{$application->car->make}}</option>
                                                   <option></option>


                                                </select>
                                            </div>
                                            <div class="md:col-span-3 col-span-12 mb-4">
                                                <label class="form-label">მოდელი</label><br>

                                                <select name="model" class="ti-form-select rounded-sm !p-0 modelsselect"
                                                        autocomplete="off">
                                                    <option  value="{{$application->car_model_id}}">
                                                        {{$models->where('id', $application->car_model_id)->first()->name}}
                                                    </option>
                                                        {{--{{$application->car->models()}}--}}

                                                        <option></option>

                                                    </select>
                                                </div>
                                                <div class="md:col-span-3 col-span-12 mb-4">
                                                    <label class="form-label">წელი</label><br>
                                                    <input name="year" type="text" class="form-control"
                                                           aria-label="year" value="{{$application->year}}">
                                                </div>
                                                <div class="md:col-span-3 col-span-12 mb-4">
                                                    <label class="form-label">ძრავი</label><br>

                                                    <input name="engine" type="text" class="form-control"
                                                           aria-label="float number" value="{{$application->engine}}">
                                                </div>
                                                <div class="md:col-span-10 col-span-12 mb-4">

                                                    <input name="link" type="url" class="form-control"
                                                           aria-label="url" value="{{$application->link}}">

                                                </div>
                                                <div class="md:col-span-2 col-span-12 mt-2">
                                                    <a style="margin:auto!important;" class="form-control " href="{{$application->link}}" target="_blank">გადასვლა</a>
                                                </div>
                                                @foreach($application->comments as $comment)
                                                    <div class="md:col-span-12 col-span-12 mb-4">
                                                        <input type="hidden" name="commentids[]" value="{{$comment->id}}">
                                                        <label class="form-label">კომენტარი {{$comment->user->name}} {{$comment->created_at}}</label><br>
                                                        <textarea name="oldcomment[]" class="form-control" aria-label="With textarea"
                                                                  rows="3">{{$comment->comment}}</textarea>
                                                    </div>
                                                @endforeach


                                            </div>
                                            <template id="commenttemplate">
                                                <div class="md:col-span-12 col-span-12 mb-4">

                    <textarea name="newcomment[]" class="form-control" aria-label="With textarea"
                              rows="3"></textarea><br>
                                                    <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecomment">წაშლა
                                                    </button>
                                                </div>
                                            </template>
                                            <div id="mydiv2"></div>
                                            <div class="flex justify-center mt-7  mb-4">
                                                <button id="newcomment" type="button" class="ti-btn ti-btn-primary-full ti-btn-wave">
                                                    ახალი კომენტარი
                                                </button>
                                            </div>
                                        </div>
                                        <button class="ti-btn ti-btn-primary-full ti-btn-wave w-full">შენახვა</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
                {{--                            Edit Modal--}}

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



    @endsection