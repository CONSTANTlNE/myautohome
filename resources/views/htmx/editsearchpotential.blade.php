<div class="ti-modal-header">
    <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">რედაქტირება</h6>
    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#editpotentialclientinsearch">
        <span class="sr-only">Close</span>
        <i class="ri-close-line"></i>
    </button>
</div>
<form
        {{--                                        action="{{route('potential.clients.update')}}" method="post"--}}
>
    @csrf
    <input type="hidden" name="id" value="{{$potential->id}}">
    <div class="ti-modal-body px-4">
        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
            <p class="mb-2 text-muted">პირადი ნომერი</p>
            <input
                    @if($potential->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter') )
                        disabled
                    @endif
                    type="text" value="{{$potential->pid}}" name="pid" class="form-control" >
        </div>
        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
            <p class="mb-2 text-muted">სახელი</p>
            <input
                    @if($potential->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter') )
                        disabled
                    @endif
                    type="text"  value="{{$potential->name}}"  name="name" class="form-control" >
        </div>

        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
            <p class="mb-2 text-muted">მობილური</p>
            <input
                    @if($potential->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter') )
                        disabled
                    @endif
                    type="text" value="{{$potential->mobile}}"  name="mobile" class="form-control" >
        </div>
        <div class="md:col-span-4 col-span-12 mb-4">
            <label class="form-label">სტატუსი</label>
            <select name="status" class=" sm:mb-0 form-select !py-3">
                @if($potential->status_id!=null)
                    <option value="{{$potential->status_id}}" selected="">{{$potential->status->name}}</option>
                @else
                    <option >სტატუსის გარეშე</option>

                @endif
                @foreach($potentialstatuses as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
                @endforeach
            </select>
        </div>

        @if($potential->comments)
            @foreach($potential->comments as $comment)

                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
                    <p class="mb-2 text-muted">
                        კომენტარი {{$comment->user->name}} {{$comment->created_at}}</p>

                    <textarea
                            @if($comment->user_id!=$authuser->id && $authuser->hasAnyRole('operator') )
                                disabled
                            @endif
                            name="comment" class="form-control"
                            rows="3">{{$comment->comment}}</textarea>
                </div>
            @endforeach
        @endif
        @if($potential->comment!==null)

        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 mb-4">
            <p class="mb-2 text-muted">
                კომენტარი {{$potential->user->name}} {{$potential->created_at}}</p>
            <textarea
                    @if($potential->user_id!=$authuser->id && $authuser->hasAnyRole('operator|callcenter'))
                        disabled
                    @endif
                    name="comment" class="form-control"
                    rows="3">{{$potential->comment}}</textarea>
        </div>
        @endif
        <template id="commenttemplate3">
            <div class="md:col-span-12 col-span-12 mb-4">

                <textarea name="newcomment[]" class="form-control" aria-label="With textarea"
                          rows="3"></textarea>

                <button style="margin-left: 45%" type="button"
                        class="ti-btn ti-btn-danger ti-btn-wave removecomment3">წაშლა
                </button>
            </div>
        </template>
        <div id="mydiv3"></div>
        <div class="flex justify-center mt-7  mb-4">
            <button id="newcomment3" type="button" class="ti-btn ti-btn-primary-full ti-btn-wave">
                ახალი კომენტარი
            </button>
        </div>
    </div>

    <div class="ti-modal-footer">
        <button data-hs-overlay="#editpotentialclientinsearch"
                hx-post="{{route('htmx.potential.clients.update')}}"
{{--                hx-target="#main-content"--}}
                {{--                                                hx-target-error="#errors"--}}
                hx-indicator="#indicator"
                class="ti-btn bg-primary text-white !font-medium">შენახვა</button>
    </div>

</form>

{{--Comments--}}
<script>
    newcomment = document.getElementById('newcomment3');

    newcomment.addEventListener('click', () => {

        commenttemplate = document.getElementById('commenttemplate3');
        clone2 = document.importNode(commenttemplate.content, true)

        document.getElementById('mydiv3').appendChild(clone2);
    })

    document.getElementById("mydiv3").addEventListener("click", function (e) {
        if (e.target.classList.contains("removecomment3")) {
            // Remove the parent node (the paragraph)
            e.target.parentNode.remove();
        }
    });


</script>
