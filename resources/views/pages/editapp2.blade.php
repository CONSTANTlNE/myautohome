@extends('layout')

@php

//dd($application);


@endphp
@section('editapp')
{{--    @if($application->user->id == auth()->user()->id && auth()->user()->can('Own_Data'))--}}
        <div class="flex justify-center w-full mb-6 mt-2">
        <input  style="max-width:200px!important;" class="form-control text-center " disabled type="text" value="განაცხადი No {{$application->id}}" >
        </div>
        <div class="flex justify-center w-full">

        <form style="max-width: 650px!important;background-color: rgb(var(--body-bg));padding: 20px" action="{{route('app.update2')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$application->id}}">

    <div class="ti-modal-body">
        <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2">
            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                <label class="form-label">პირადი ნომერი</label>
                <input  name="customer_pid" type="text" class="form-control" data-disabled-input
                       aria-label="ninedigitnumber" value="{{$application->client->pid}}">
            </div>
            <div class="md:col-span-4 col-span-12 mb-4">
                <label class="form-label">სახელი / გვარი</label>
                <input name="customer_name" type="text" class="form-control" data-disabled-input
                       aria-label="FullName" value="{{$application->client->name}}">
            </div>
            <div class="md:col-span-2 col-span-12 mb-4">
                <label class="form-label">მობილური</label>
                <input aria-label="tel" name="customer_mobile" data-disabled-input
                       style="padding-left: 0!important;padding-right: 0!important"
                       type="text"
                       class="form-control"
                       value="{{$application->client->mobile1}}"
                >
            </div>
            <div class="md:col-span-3 col-span-12 mb-4">
                <label class="form-label">წყარო</label>
                <select data-disabled-input name="source" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">

                    <option value="{{$application->source->id}}">{{$application->source->name}}</option>
                    @foreach($sources as $index => $source)
                        <option value="{{$source->id}}">{{$source->name}}</option>
                    @endforeach

                </select>
            </div>
            <input  disabled  class="form-control md:col-span-4 col-span-12 mb-4" type="text" name=">created_at" value="{{$application->created_at}}">

            <input   class="form-control md:col-span-3 col-span-12 mb-4" type="date" name="created_at" >


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

    </div>
    <button class="ti-btn ti-btn-primary-full ti-btn-wave w-full">შენახვა</button>
</form>
    </div>
{{--    @endif--}}
@endsection