@extends('layout')

@php

//dd(auth()->user()->roles->pluck('name'));


@endphp
@section('potential-clients')

    {{--    click is triggered by datatables button--}}
    <a style="display: none" id="addclient" href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full" data-hs-overlay="#createpotentialclient">Launch demo modal
    </a>
    <div id="createpotentialclient" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">პოტენციური კლიენტის დამატება</h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#createpotentialclient">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <form action="{{route('potential.clients.create')}}" method="post">
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
                        <button class="ti-btn bg-primary text-white !font-medium">დამატება</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <table id="potentialclients" class="display nowrap" style="width:100%">
        <thead>
        <tr style="text-align: center!important;">
            <td style="text-align: center!important;">შექმნის თარიღი</td>
            <td style="text-align: center!important;">პირადი ნომერი</td>
            <td style="text-align: center!important;">სახელი გვარი</td>
            <td style="text-align: center!important;">მობილური</td>
            <td style="text-align: center!important;">კომენტარი</td>
            @hasanyrole('admin|developer')
            <td style="text-align: center!important;">მოქმედება</td>
            @endhasanyrole

        </tr>
        </thead>
        <tbody>
        @foreach($potentialclients as $index => $client)
            <tr style="text-align: center!important;" >
                <td style="text-align: center!important;">{{$client->created_at}}</td>
                <td style="text-align: center!important;">{{$client->pid}}</td>
                <td style="text-align: center!important;">{{$client->name}}</td>
                <td style="text-align: center!important;">{{$client->mobile}}</td>
                <td style="text-align: center!important;">{{$client->comment}}</td>
                @hasanyrole('admin|developer')
                <td style="text-align: center!important;">წაშლა</td>
                @endhasanyrole
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td style="text-align: center!important;">შექმნის თარიღი</td>
            <td style="text-align: center!important;">პირადი ნომერი</td>
            <td style="text-align: center!important;">სახელი გვარი</td>
            <td style="text-align: center!important;">მობილური</td>
            <td style="text-align: center!important;">კომენტარი</td>
            @hasanyrole('admin|developer')
            <td style="text-align: center!important;">მოქმედება</td>
            @endhasanyrole
        </tr>
        </tfoot>
    </table>
@endsection