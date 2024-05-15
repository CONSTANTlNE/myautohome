@extends('layout')

@php

//dd($application);


@endphp
@section('details')
    <div class="flex justify-center w-full mb-6 mt-7">
        <input  style="max-width:200px!important;" class="form-control text-center " disabled type="text" value="განაცხადი No {{$application->number}}" >
    </div>
    <div class="flex justify-center w-full" >
   <div  style="max-width: 650px!important;background-color: rgb(var(--body-bg));padding: 20px" >

    <input type="hidden" name="id" value="{{$application->id}}">

    <div class="ti-modal-body">
        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2">
            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                <label class="form-label">პირადი ნომერი</label>
                <input disabled name="customer_pid" type="text" class="form-control"
                       aria-label="ninedigitnumber" value="{{$application->client->pid}}">
            </div>
            <div class="md:col-span-4 col-span-12 mb-4">
                <label class="form-label">სახელი / გვარი</label>
                <input disabled name="customer_name" type="text" class="form-control"
                       aria-label="FullName" value="{{$application->client->name}}">
            </div>
            <div class="md:col-span-2 col-span-12 mb-4">
                <label class="form-label">მობილური</label>
                <input disabled aria-label="tel" name="customer_mobile"
                       style="padding-left: 0!important;padding-right: 0!important"
                       type="text"
                       class="form-control"
                       value="{{$application->client->mobile1}}"
                >
            </div>
            <div class="md:col-span-3 col-span-12 mb-4">
                <label class="form-label">წყარო</label>
                <select disabled name="source" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">

                    <option value="{{$application->source->id}}">{{$application->source->name}}</option>
                    @foreach($sources as $index => $source)
                        <option value="{{$source->id}}">{{$source->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class=" md:col-span-6 col-span-12 mb-4">
                <label class="form-label">სტატუსი</label>
                <select disabled name="status" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                    <option value="{{$application->status->id}}">{{$application->status->name}}</option>
                    @foreach($statuses as $index => $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-6 col-span-12 mb-4">
                <label class="form-label">პროდუქტი</label>
                <select disabled name="product" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
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
        <template id="companytemplate">
            <div class="flex justify-center gap-6 w-full mt-2">
                <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecompany">წაშლა
                </button>

                <select disabled style="max-width: 200px" name="company[]" class=" sm:mb-0 form-select !py-3"
                        id="inlineFormSelectPref">
                    <option selected="">არ არის არჩეული</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>

            </div>
        </template>
        <div id="companydiv" class="w-full">
            @foreach($application->companies as $index => $company)

                <div class="flex justify-center gap-6 w-full mt-2">

                    <select disabled style="max-width: 200px" name="company[]" class=" sm:mb-0 form-select !py-3"
                            id="inlineFormSelectPref">

                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @foreach($companies as $index2 => $company2)
                            <option value="{{$company2->id}}">{{$company2->name}}</option>

                        @endforeach
                    </select>

                </div>

            @endforeach
        </div>

        {{--                            <p class="mb-4 text-center w-full">ავტომობილი მონაცემები</p>--}}
        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 mt-7">
            <div class="md:col-span-3 col-span-12 mb-4">
                <label class="form-label">მწარმოებელი</label>

                <input disabled name="engine" type="text" class="form-control"
                       aria-label="float number" value="{{$application->car->make}}">

            </div>
            <div class="md:col-span-3 col-span-12 mb-4">
                <label class="form-label">მოდელი</label>
                <input disabled name="engine" type="text" class="form-control"
                       aria-label="float number" value="{{$models->where('id', $application->car_model_id)->first()->name}}">

            </div>
            <div class="md:col-span-3 col-span-12 mb-4">
                <label class="form-label">წელი</label>
                <input disabled name="year" type="text" class="form-control"
                       aria-label="year" value="{{$application->year}}">
            </div>
            <div class="md:col-span-3 col-span-12 mb-4">
                <label class="form-label">ძრავი</label>

                <input disabled name="engine" type="text" class="form-control"
                       aria-label="float number" value="{{$application->engine}}">
            </div>
            <div class="md:col-span-10 col-span-12 mb-4">

                <input disabled name="link" type="url" class="form-control"
                       aria-label="url" value="{{$application->link}}">

            </div>
            <div class="md:col-span-2 col-span-12 mt-2">
                <a style="margin:auto!important;" class="form-control " href="{{$application->link}}" target="_blank">გადასვლა</a>
            </div>
        @foreach($application->comments as $comment)
        <div class="md:col-span-12 col-span-12 mb-4">
            <input disabled type="hidden" name="commentids[]" value="{{$comment->id}}">
            <label class="form-label">კომენტარი {{$comment->user->name}} {{$comment->created_at}}</label>
            <textarea disabled name="oldcomment[]" class="form-control" aria-label="With textarea"
                      rows="3">{{$comment->comment}}</textarea>
        </div>
        @endforeach


    </div>
        <template id="commenttemplate">
            <div class="md:col-span-12 col-span-12 mb-4">

                <textarea disabled name="newcomment[]" class="form-control" aria-label="With textarea"
                          rows="3"></textarea>
                <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecomment">წაშლა
                </button>
            </div>
        </template>
        <div id="mydiv2"></div>

    </div>

</div>
    </div>

@endsection