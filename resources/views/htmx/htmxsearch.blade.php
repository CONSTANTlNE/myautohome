
 <div class="mt-3 grid grid-cols-12 text-center sm:gap-x-6 sm:gap-y-2 border-[2px] border-primary rounded-[0.25rem]">
                    <div class="md:col-span-3 mt-3  col-start-2 col-span-12 mb-4">
                        <label class="form-label">ნომერი</label>
                    </div>

                    <div class="md:col-span-3  mt-3 col-start-2 col-span-12 mb-4">
                        <label class="form-label">სტატუსი</label>
                    </div>
                    <div class="md:col-span-3 mt-3 col-start-2 col-span-12 mb-4">
                        <label class="form-label">კლიენტი</label>
                    </div>
                    <div class="md:col-span-3 mt-3 col-start-2 col-span-12 mb-4">
                        <label class="form-label">დეტალურად</label>
                    </div>
                @foreach($applications->applications as $index => $application)

                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4 ">

                            <input disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->id}}">
                        </div>
                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4">

                            <input disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->status->name}}">
                        </div>
                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4">

                            <input style="white-space: normal!important" disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->client->name}}">
                            <input style="white-space: normal!important" disabled name="customer_pid" type="text" class="form-control"
                                   aria-label="ninedigitnumber" value="{{$application->client->pid}}">
                        </div>
                        <div class="md:col-span-3  col-start-2 col-span-12 mb-4">
                            <a style="margin:auto!important;"
                               data-hs-overlay="#editmodal"
                               hx-get="{{route('edit.htmx', $application->id)}}"
                               hx-target="#edittarget"
                               hx-indicator="#indicator"
                               class="form-control "
                               href="javascript:void(0)"
{{--                               href="{{route('app.details',$application->id)}}" --}}
                               >დეტალურად</a>
                        </div>

                    @endforeach

                    </div>
