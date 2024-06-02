@foreach($notifications as $notification)
    @if($notification->user_id===auth()->user()->id)
        <li style="background-color: #1a1c1e!important" class="ti-dropdown-item dropdown-item ">
            <div class="flex items-start justify-center">
                <div class="pe-2">
                    <span
                            class="inline-flex @if($notification->type==='დაემატა განაცხადი') text-success @else text-warning  @endif justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem] @if($notification->type==='დაემატა განაცხადი') !bg-primary/10 @else !bg-warning/10 @endif  !rounded-[50%]">
                     @if($notification->type==='დაემატა განაცხადი')
                            <span class="material-symbols-outlined">add</span>
                        @else
                            <span class="material-symbols-outlined">edit_note</span>
                        @endif

                    </span>
                </div>
                <div class="grow flex items-center justify-between">
                    <div style="width: 100%">
                        <p style="cursor:pointer"
                           class="newnotifications mb-0 text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50 text-[0.8125rem] font-semibold">
                            <a hx-indicator="#indicator" hx-get="{{route('edit.htmx', $notification->application->id)}}"
                               hx-target="#edittarget" data-hs-overlay="#editmodal" href="javascript:void(0);"
                               class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block">{{$notification->type}} {{$notification->application->number}}</a>
                        </p>
                        {{--                    <span class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">Order No: 123456--}}
                        {{--                        Has Shipped To Your Delivery Address</span>--}}
                    </div>
                    {{--                <div>--}}
                    {{--                    <a aria-label="anchor" href="javascript:void(0);" class="min-w-fit text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"><i--}}
                    {{--                                class="ti ti-x text-[1rem]"></i></a>--}}
                    {{--                </div>--}}
                </div>
            </div>
        </li>
    @endif

@endforeach
<script>

    newnotifications = document.querySelectorAll(".newnotifications")

    newnotifications.forEach((notification) => {
        notification.addEventListener("click", () => {

            document.getElementById('notifdetailsbtn')

        })
    })
</script>