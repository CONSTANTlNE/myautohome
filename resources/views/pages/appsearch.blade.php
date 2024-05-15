
@extends('layout')

@php
//        dd($applications->applications);
@endphp
@foreach($applications->applications as $index => $application)

    @php
//                dd($application->number , $application->status->name);
    @endphp


@endforeach
@section('search')

<div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out md:!max-w-2xl md:w-full m-3 md:mx-auto">
    <form action="http://127.0.0.1:8000/search" method="get">
        <input type="hidden" name="_token" value="o8t4nW363aKeQ3TO2t4x7PorLQ9I0DaYsSpHrNe2" autocomplete="off">                    <div class="ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="ti-modal-title">
                    ძებნა
                </h6>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#searchmodal">
                    <span class="sr-only">Close</span>
                    <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"></path>
                    </svg>
                </button>
            </div>
            <div class="ti-modal-body">
                <div class="input-group border-[2px] border-primary rounded-[0.25rem] w-full flex">
                    <a aria-label="anchor" href="javascript:void(0);" class="input-group-text flex items-center bg-light border-e-[#dee2e6] !py-[0.375rem] !px-[0.75rem] !rounded-none !text-[0.875rem]" id="Search-Grid"><i class="fe fe-search header-link-icon text-[0.875rem]"></i></a>
                    <input type="search" name="search" class="form-control border-0 px-2 !text-[0.8rem] w-full focus:ring-transparent" placeholder="პირადი ნომერი / სახელი / გვარი / მობილური" aria-label="Username">
                </div>
                <div class="mt-3 grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 border-[2px] border-primary rounded-[0.25rem]">
                    <div class="md:col-span-3 mt-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">ნომერი</label>
                    </div>
                    <div class="md:col-span-3  mt-3 col-start-2 col-span-12 mb-4">
                        <label class="form-label">სტატუსი</label>
                    </div>
                    <div class="md:col-span-3 mt-3 col-start-2 col-span-12 mb-4">
                        <label class="form-label">ოპერატორი</label>
                    </div>
                    <div class="md:col-span-3 mt-3 col-start-2 col-span-12 mb-4">
                        <label class="form-label">დეტალურად</label>
                    </div>
                @foreach($applications->applications as $index => $application)

                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4 ">

                            <input disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->number}}">
                        </div>
                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4">

                            <input disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->status->name}}">
                        </div>
                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4">

                            <input disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->user->name}}">
                        </div>
                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                            <a style="margin:auto!important;" class="form-control " href="{{route('app.details',$application->id)}}" target="_blank">დეტალურად</a>
                        </div>

                    @endforeach

                    </div>
            </div>

            <div class="ti-modal-footer !py-[1rem] !px-[1.25rem]">
                <div class="inline-flex rounded-md  shadow-sm">
                    <button class="ti-btn-group !px-[0.75rem] !py-[0.45rem]  rounded-s-[0.25rem] !rounded-e-none ti-btn-primary !text-[0.75rem] dark:border-white/10">
                        მოძებნე
                    </button>

                </div>
            </div>

        </div>

    </form>
</div>

@endsection