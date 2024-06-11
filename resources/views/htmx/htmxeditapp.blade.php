{{--    @if($application->user->id == auth()->user()->id && auth()->user()->can('Own_Data'))--}}
<div class="flex justify-center w-full mb-6 mt-2 gap-5">
    <div class="text-center">
        <p>განაცხადი</p>
        <input style="max-width:100px!important;" class="form-control text-center " disabled type="text"
               value="{{$application->id}}">
    </div>
    @if($potentialclient)
        <div class="text-center">
            <p>პოტენციური</p>
            <input style="max-width:100px!important;" class="form-control text-center " disabled type="text"
                   value="{{$potentialclient->user->name}}">
        </div>
    @endif
    <div class="text-center">
        <p>ოპერატორი</p>
        <input style="max-width:100px!important;" class="form-control text-center " disabled type="text"
               value="{{$application->user->name}}">

    </div>
    <div class="text-center">
        <p>შეიქმნა</p>
        <button style="max-width:250px!important;" class="form-control text-center " disabled type="text"
                value="">{{$application->created_at}}</button>
    </div>
    @if( $application->updated_at!==null)
        @if($application->created_at->format('Y-m-d H:i:s') !== $application->updated_at->format('Y-m-d H:i:s'))
            <div class="text-center">
                <p>ბოლო განახლება</p>
                <button style="max-width:250px!important;z-index: -5;color: red!important"
                        class="form-control text-center " disabled type="text"
                        value=""><a style="z-index: 200;color: red!important;" target="_blank"
                                    href="{{route('customlogviewer',['query'=>'განაცხადში No: '.$application->id])}}">{{$application->updated_at}} </a>
                </button>
            </div>
        @endif
    @endif
</div>
<div class="flex justify-center w-full">
    <form style="max-width: 650px!important;background-color: rgb(var(--body-bg));padding: 20px"
{{--          @if($userid==$application->user->id || auth()->user()->hasanyrole('admin|developer'))--}}
{{--              action="{{route('update.htmx')}}"--}}
{{--          @else--}}
{{--              action="{{route('update2.htmx')}}"--}}
{{--          @endif--}}
{{--   target="nohtmx"--}}
          method="post">
        <div id="errors2"></div>
        @csrf
        <input type="hidden" name="id" value="{{$application->id}}">

        <div style="padding: 0!important" class="ti-modal-body">
            <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2">
                <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                    <label class="form-label">პირადი ნომერი</label>
                    <input name="customer_pid" type="text" class="form-control" data-disabled-input
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
                    <select data-disabled-input name="source" class=" sm:mb-0 form-select !py-3"
                            id="inlineFormSelectPref">

                        <option value="{{$application->source->id}}">{{$application->source->name}}</option>
                        @foreach($sources as $index => $source)
                            <option value="{{$source->id}}">{{$source->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class=" md:col-span-6 col-span-12 mb-4">
                    <label class="form-label">სტატუსი</label>
                    <select name="status" class=" sm:mb-0 form-select !py-3" id="inlineFormSelectPref">
                        <option value="{{$application->status->id}}">{{$application->status->name}}</option>
                        @foreach($statuses as $index => $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-6 col-span-12 mb-4">
                    <label class="form-label">პროდუქტი</label>
                    <select data-disabled-input name="product" class=" sm:mb-0 form-select !py-3"
                            id="inlineFormSelectPref">
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
            <template id="companytemplate2">
                <div class="flex justify-center gap-6 w-full mt-2">
                    <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecompany2">წაშლა
                    </button>

                    <select data-disabled-input style="max-width: 200px" name="company[]"
                            class=" sm:mb-0 form-select !py-3"
                            id="inlineFormSelectPref">
                        <option selected="">არ არის არჩეული</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>

                </div>
            </template>
            <div id="companydiv2" class="w-full">
                @foreach($application->companies as $index => $company)

                    <div class="flex justify-center gap-6 w-full mt-2">
                        @if(auth()->user()->id === $application->user_id)
                            <button type="button" class="ti-btn ti-btn-danger ti-btn-wave removecompany2">წაშლა
                            </button>
                        @endif
                        <select style="pointer-events: none;max-width: 200px" data-disabled-input
                                style="max-width: 200px" name="company[]"
                                class=" sm:mb-0 form-select !py-3"
                                id="inlineFormSelectPref">

                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @foreach($companies as $index2 => $company2)
                                <option value="{{$company2->id}}">{{$company2->name}}</option>

                            @endforeach
                        </select>

                    </div>

                @endforeach
            </div>
            @if(auth()->user()->id === $application->user_id || auth()->user()->hasRole('admin|developer') )
                <div class="flex justify-center mt-7  mb-4">
                    <button id="newcompany2" type="button" class="ti-btn ti-btn-primary-full ti-btn-wave">
                        ახალი კომპანიის დამატება
                    </button>
                </div>
            @endif
            {{--                            <p class="mb-4 text-center w-full">ავტომობილი მონაცემები</p>--}}
            <div class="grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 mt-7">
                <div class="md:col-span-3 col-span-12 mb-4">
                    <label class="form-label">მწარმოებელი</label>

                    <select
                            data-disabled-input aria-label="car" name="car" class="ti-form-select rounded-sm !p-0"
                            hx-get="{{route('carsearch')}}"
                            hx-trigger="change"
                            hx-target="#modelsselect2"

                            id="carsselect2"
                            autocomplete="off">
                        @if($application->car_id!==null)
                            <option value="{{$application->car_id}}">{{$application->car->make}}</option>
                        @endif
                        <option></option>
                        @foreach($cars as $car)
                            <option value="{{$car->id}}">{{$car->make}}</option>
                        @endforeach


                    </select>
                </div>
                <div class="md:col-span-3 col-span-12 mb-4">
                    <label class="form-label">მოდელი</label>

                    <select data-disabled-input name="model" class="form-control" id="modelsselect2"
                            autocomplete="off">
                        @if($application->car_id!==null)
                            <option value="{{$application->car_model_id}}">{{$application->model->name}}</option>
                        @endif

                        <option></option>

                    </select>
                </div>
                <div class="md:col-span-3 col-span-12 mb-4">
                    <label class="form-label">წელი</label>
                    <input data-disabled-input name="year" type="text" class="form-control"
                           aria-label="year"
                           @if($application->year!==null)
                               value="{{$application->year}}"
                            @endif
                    >
                </div>
                <div class="md:col-span-3 col-span-12 mb-4">
                    <label class="form-label">ძრავი</label>

                    <input data-disabled-input name="engine" type="text" class="form-control"
                           aria-label="float number"
                           @if($application->engine!==null)
                               value="{{$application->engine}}"
                            @endif
                    >
                </div>
                <div class="md:col-span-10 col-span-12 mb-4">
                    <label class="form-label">ლინკი</label>
                    <input data-disabled-input name="link" type="url" class="form-control"
                           aria-label="url"
                           @if($application->link!==null)
                               value="{{$application->link}}"
                            @endif
                    >

                </div>
                <div class="md:col-span-2 col-span-12 mt-2">
                    <br>
                    <a style="margin:auto!important;cursor: pointer" class="form-control "
                       @if($application->link!==null)
                           href="{{$application->link}}"
                       @endif
                       target="_blank">გადასვლა</a>
                </div>
                @foreach($application->comments as $comment)
                    <div class="md:col-span-12 col-span-12 mb-4">
                        <input  type="hidden" name="commentids[]" value="{{$comment->id}}"  >
                        <label class="form-label" >კომენტარი {{$comment->user->name}} {{$comment->created_at}}</label>
                        <textarea  @readonly($comment->user->id !==auth()->user()->id) style=""   name="oldcomment[]" class="form-control" aria-label="With textarea"
                                  rows="3">{{$comment->comment}}</textarea>
                    </div>
                @endforeach

            </div>
            <template id="commenttemplate">
                <div class="md:col-span-12 col-span-12 mb-4">

                <textarea name="newcomment[]" class="form-control" aria-label="With textarea"
                          rows="3"></textarea>

                    <button style="margin-left: 45%" type="button"
                            class="ti-btn ti-btn-danger ti-btn-wave removecomment ">წაშლა
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
        <button
                @if($userid==$application->user->id || auth()->user()->hasanyrole('admin|developer'))
                    hx-post="{{route('update.htmx')}}"
                @else
                    hx-post="{{route('update2.htmx')}}"
                @endif
{{--                hx-target="#main-content"--}}
                hx-target-error="#errors2"
{{--                hx-indicator="#indicator"--}}
                id="editappsubmit"
                class="ti-btn ti-btn-primary-full ti-btn-wave w-full">შენახვა
        </button>

    </form>

</div>
{{--<iframe name="nohtmx" style="display: none"></iframe>--}}

{{--If app was not created by user, disable inputs--}}
@if($userid!==$application->user->id && auth()->user()->hasanyrole('operator|callcenter'))
    <script>
        document.querySelectorAll('[data-disabled-input]').forEach((input) => {

            input.disabled = true
        })
    </script>
@endif
{{--companies--}}
<script>


    newcompany2 = document.getElementById('newcompany2');

    newcompany2.addEventListener('click', () => {
        console.log('clicked');
        companytemplate2 = document.getElementById('companytemplate2');
        clone2 = document.importNode(companytemplate2.content, true)

        document.getElementById('companydiv2').appendChild(clone2);
    })

    document.getElementById("companydiv2").addEventListener("click", function (e) {
        if (e.target.classList.contains("removecompany2")) {
            // Remove the parent node (the paragraph)
            e.target.parentNode.remove();
        }
    });


</script>

{{--Comments--}}
<script>
    newcomment = document.getElementById('newcomment');

    newcomment.addEventListener('click', () => {

        commenttemplate = document.getElementById('commenttemplate');
        clone2 = document.importNode(commenttemplate.content, true)

        document.getElementById('mydiv2').appendChild(clone2);
    })

    document.getElementById("mydiv2").addEventListener("click", function (e) {
        if (e.target.classList.contains("removecomment")) {
            // Remove the parent node (the paragraph)
            e.target.parentNode.remove();
        }
    });


</script>

<script>

    if (typeof carselectt !== 'undefined') {
        carselectt.destroy();

    }


    carselectt = new TomSelect("#carsselect2", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

</script>
