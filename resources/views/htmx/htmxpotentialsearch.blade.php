<div class="mt-3 grid grid-cols-12 gap-2 text-center border-[2px] border-primary rounded-[0.25rem]">
    <div class="md:col-span-2 mt-3  col-start-2 col-span-12 mb-4">
        <label class="form-label">შექმნის თარიღი</label>
    </div>
    <div class="md:col-span-2  mt-3 col-start-2 col-span-12 mb-4">
        <label class="form-label">ოპერატორი</label>
    </div>

    <div class="md:col-span-2 mt-3 col-start-2 col-span-12 mb-4">
        <label class="form-label">სახელი გვარი</label>
    </div>
    <div class="md:col-span-2 mt-3 col-start-2 col-span-12 mb-4">
        <label class="form-label">მობილური</label>
    </div>
    <div class="md:col-span-2 mt-3 col-start-2 col-span-12 mb-4">
        <label class="form-label">კომენტარი</label>
    </div>
    <div class="md:col-span-2 mt-3 col-start-2 col-span-12 mb-4">
        <label class="form-label">რედაქტირება</label>
    </div>

    @foreach($potentials as $index5 => $potential)

        <div class="md:col-span-2  col-span-12 mb-4 ">

            <input style="white-space: normal!important" disabled type="text" class="form-control"
                   aria-label="ninedigitnumber" value="{{$potential->created_at}}">
        </div>
        <div class="md:col-span-2  col-span-12 mb-4 ">

            <input disabled type="text" class="form-control"
                   aria-label="ninedigitnumber" value="{{$potential->user->name}}">
        </div>

        <div class="md:col-span-2 col-span-12 mb-4">

            <input style="white-space: normal!important" disabled type="text" class="form-control"
                   aria-label="ninedigitnumber" value="{{$potential->name}}">
            <input style="white-space: normal!important" disabled type="text" class="form-control"
                   aria-label="ninedigitnumber" value="{{$potential->pid}}">
        </div>
        <div class="md:col-span-2  col-span-12 mb-4">

            <input disabled type="text" class="form-control"
                   aria-label="ninedigitnumber" value="{{$potential->mobile}}">
        </div>

        <div class="md:col-span-2   col-span-12 mb-4">
<textarea disabled name="comment" class="form-control"  rows="3">{{$potential->comment}}</textarea>
        </div>
        <div class="md:col-span-2  col-span-12 mb-4">
            <button data-hs-overlay="#editpotentialclientinsearch"
                    hx-get="{{route('edit.search.potential',$potential->id)}}"
                    hx-target="#potentialeditform"
                    hx-indicator="#indicator"

            class="ti-btn bg-primary text-white !font-medium">რედაქტირება</button>

        </div>
    @endforeach

</div>
