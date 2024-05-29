<div class="ti-modal-content">
    <form action="{{route('ips.store')}}" method="post" target="hidden_iframe">
        @csrf
        <div class="ti-modal-header">
            <h6 class="modal-title text-[1rem] font-semibold">
                IP დამატემა
            </h6>
            <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                    data-hs-overlay="#ips">
                <span class="sr-only">Close</span>
                <i class="ri-close-line"></i>
            </button>
        </div>
        <div class="ti-modal-body px-4">
            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                <label class="form-label">ახალი IP</label>
                <input name="ip" type="text" class="form-control" aria-label="ips">
            </div>
            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                <label class="form-label">სახელი</label>
                <input name="name" type="text" class="form-control" aria-label="ips">
            </div>

        </div>
        <div class="ti-modal-footer">
            <button id="" type="submit" data-hs-overlay="#ips"
                    class="ti-btn bg-primary text-white !font-medium">დამატება
            </button>
        </div>
    </form>


    <div class="ti-modal-header">
        <h6 class="modal-title text-[1rem] font-semibold">
            არსებული IP მისამართები
        </h6>
    </div>
    <div class="ti-modal-body px-4">
@foreach($ips as $ip)
    @if($ip->ip!=='94.240.239.76' && $ip->ip !=='185.115.6.5'  && $ip->ip !=='127.0.0.1' )
            <form action="{{route('ips.destroy')}}"   method="post" target="hidden_iframe">
                @csrf
            <input name="id" type="hidden" value="{{$ip->id}}" class="form-control" aria-label="ips">
            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                <label class="form-label">IP</label>
                <input value="{{$ip->ip}}"  type="text" class="form-control" aria-label="ips">
            </div>
            <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                <label class="form-label">სახელი</label>
                <input  value="{{$ip->name}}" name="name" type="text" class="form-control" aria-label="ips">
            </div>
            <div class="ti-modal-footer">
                <button id="" type="submit" data-hs-overlay="#ips"
                        class="ti-btn bg-danger text-white !font-medium">წაშლა
                </button>
            </div>
            </form>
            @endif
    @endforeach
    </div>


</div>
