@extends('layout')


@section('other')

   <div class="grid grid-cols-12 gap-4">
      <div class="xl:col-span-3 col-span-12">
         <div class="box">
            <div class="box-header justify-between">
               <div class="box-title">
                  კომპანიის დამატება
               </div>

            </div>
            <form action="{{route('company.create')}}" method="post">
               @csrf
               <div class="box-body">

                  <div class="mb-4">
                     <label for="form-password" class="form-label text-[.875rem] text-black">
                        დასახელება</label>
                     <input type="text" name="name" class="form-control" id="form-password" >
                  </div>

                  <button class="ti-btn ti-btn-primary-full" type="submit">დამატება</button>
               </div>
            </form>
            <div class="box-footer hidden border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>
      </div>
      <div class="xl:col-span-3 col-span-12">
         <div class="box">
            <div class="box-header justify-between">
               <div class="box-title">
                  პროდუქტის დამატება
               </div>

            </div>
            <form action="{{route('product.create')}}" method="post">
               @csrf
               <div class="box-body">

                  <div class="mb-4">
                     <label for="form-password" class="form-label text-[.875rem] text-black">
                        დასახელება</label>
                     <input type="text" name="name" class="form-control" id="form-password" >
                  </div>

                  <button class="ti-btn ti-btn-primary-full" type="submit">დამატება</button>
               </div>
            </form>
            <div class="box-footer hidden border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>
      </div>
      <div class="xl:col-span-3 col-span-12">
         <div class="box">
            <div class="box-header justify-between">
               <div class="box-title">
                  სტატუსის დამატება
               </div>

            </div>
            <form action="{{route('status.create')}}" method="post">
               @csrf
               <div class="box-body">

                  <div class="mb-4">
                     <label for="form-password" class="form-label text-[.875rem] text-black">
                        დასახელება</label>
                     <input type="text" name="name" class="form-control" id="form-password" >
                  </div>

                  <button class="ti-btn ti-btn-primary-full" type="submit">დამატება</button>
               </div>
            </form>
            <div class="box-footer hidden border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>
      </div>
      <div class="xl:col-span-3 col-span-12">
         <div class="box">
            <div class="box-header justify-between">
               <div class="box-title">
                  წყაროს დამატება
               </div>

            </div>
            <form action="{{route('source.create')}}" method="post">
               @csrf
               <div class="box-body">

                  <div class="mb-4">
                     <label for="form-password" class="form-label text-[.875rem] text-black">
                        დასახელება</label>
                     <input type="text" name="name" class="form-control" id="form-password" >
                  </div>

                  <button class="ti-btn ti-btn-primary-full" type="submit">დამატება</button>
               </div>
            </form>
            <div class="box-footer hidden border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>
      </div>
   </div>

   <div class="grid grid-cols-12  gap-6">
      <div class="xl:col-span-3 col-span-12">
         <div class="box custom-box">
            <div class="box-header justify-between">
               <div class="box-title">
                  კომპანიები
               </div>
            </div>
            <div class="box-body ">
               <div class="table-responsive">
                  <table class="text-center table whitespace-nowrap min-w-full">
                     <thead class="bg-primary/10 text-center">
                     <tr class="border-b border-primary/10 text-center">
                        <th style="text-align: center!important"  class="text-center">დასახელება</th>
                        <th style="text-align: center!important;width: 20px!important" class="text-center">მოქმედება</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($companies as $index => $company)
                     <tr class="border-b border-primary/10 text-center">
                        <td style="white-space:normal;max-width: 100px; word-wrap: break-word; overflow-wrap: break-word;" class="text-center">{{$company->name}}</td>
                        <td style="width: 15px!important">
                           <div class="hstack flex justify-center gap-3 text-[.9375rem]">
{{--                              <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-info !rounded-full"></a>--}}
                              <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-sm ti-btn-info !rounded-full" data-hs-overlay="#todo-compose{{$index}}"><i class="ri-edit-line"></i>
                              </a>
                              <div id="todo-compose{{$index}}" class="hs-overlay hidden ti-modal">
                                 <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                    <div class="ti-modal-content">
                                       <div class="ti-modal-header">
                                          <h6 class="modal-title text-[1rem] font-semibold" id="company{{$index}}">კომპანიის რედაქტირება</h6>
                                          <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#todo-compose{{$index}}">
                                             <span class="sr-only">Close</span>
                                             <i class="ri-close-line"></i>
                                          </button>
                                       </div>
                                       <form action="{{route('company.update')}}" method="post">
                                          <input type="hidden"  name="id" value="{{$company->id}}">
                                       <div class="ti-modal-body px-4">

                                                @csrf
                                                <div class="box-body">

                                                   <div class="mb-4">
                                                      <label for="form-password" class="form-label text-[.875rem] text-black">
                                                         დასახელება</label> <br>
                                                      <input type="text" name="name" class="form-control" value="{{$company->name}}" id="form-password" >
                                                   </div>
                                                </div>


                                       </div>
                                       <div class="ti-modal-footer">
                                          <button type="button"
                                                  class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                  data-hs-overlay="#todo-compose{{$index}}">
                                             გაუქმება
                                          </button>
                                          <button type="submit" class="ti-btn bg-primary text-white !font-medium">განახლება</button>
                                       </div>

                                       </form>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="box-footer border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>

      </div>
      <div class="xl:col-span-3 col-span-12">
         <div class="box custom-box">
            <div class="box-header justify-between">
               <div class="box-title">
                  პროდუქტები
               </div>
            </div>
            <div class="box-body ">
               <div class="table-responsive">
                  <table class="text-center table whitespace-nowrap min-w-full">
                     <thead class="bg-primary/10 text-center">
                     <tr class="border-b border-primary/10 text-center">
                        <th style="text-align: center!important"  class="text-center">დასახელება</th>
                        <th style="text-align: center!important;width: 20px!important" class="text-center">მოქმედება</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($products as $index => $product)
                        <tr class="border-b border-primary/10 text-center">
                           <td style="white-space:normal;max-width: 100px; word-wrap: break-word; overflow-wrap: break-word;" class="text-center">{{$product->name}}</td>
                           <td style="width: 15px!important">
                              <div class="hstack flex justify-center gap-3 text-[.9375rem]">
                                 {{--                              <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-info !rounded-full"></a>--}}
                                 <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-sm ti-btn-info !rounded-full" data-hs-overlay="#product{{$index}}"><i class="ri-edit-line"></i>
                                 </a>
                                 <div id="product{{$index}}" class="hs-overlay hidden ti-modal">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                       <div class="ti-modal-content">
                                          <div class="ti-modal-header">
                                             <h6 class="modal-title text-[1rem] font-semibold">კომპანიის რედაქტირება</h6>
                                             <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#product{{$index}}">
                                                <span class="sr-only">Close</span>
                                                <i class="ri-close-line"></i>
                                             </button>
                                          </div>
                                          <form action="{{route('product.update')}}" method="post">
                                             <input type="hidden"  name="id" value="{{$product->id}}">
                                             <div class="ti-modal-body px-4">

                                                @csrf
                                                <div class="box-body">

                                                   <div class="mb-4">
                                                      <label for="form-password" class="form-label text-[.875rem] text-black">
                                                         დასახელება</label> <br>
                                                      <input type="text" name="name" class="form-control" value="{{$product->name}}" id="form-password" >
                                                   </div>
                                                </div>


                                             </div>
                                             <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#product{{$index}}">
                                                   გაუქმება
                                                </button>
                                                <button type="submit" class="ti-btn bg-primary text-white !font-medium">განახლება</button>
                                             </div>

                                          </form>

                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="box-footer border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>

      </div>
      <div class="xl:col-span-3 col-span-12">
         <div class="box custom-box">
            <div class="box-header justify-between">
               <div class="box-title">
                  სტატუსი
               </div>
            </div>
            <div class="box-body ">
               <div class="table-responsive">
                  <table class="text-center table whitespace-nowrap min-w-full">
                     <thead class="bg-primary/10 text-center">
                     <tr class="border-b border-primary/10 text-center">
                        <th style="text-align: center!important"  class="text-center">დასახელება</th>
                        <th style="text-align: center!important;width: 20px!important" class="text-center">მოქმედება</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($statuses as $index => $status)
                        <tr class="border-b border-primary/10 text-center">
                           <td style="white-space:normal;max-width: 100px; word-wrap: break-word; overflow-wrap: break-word;" class="text-center">{{$status->name}}</td>
                           <td style="width: 15px!important">
                              <div class="hstack flex justify-center gap-3 text-[.9375rem]">
                                 {{--                              <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-info !rounded-full"></a>--}}
                                 <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-sm ti-btn-info !rounded-full" data-hs-overlay="#status{{$index}}"><i class="ri-edit-line"></i>
                                 </a>
                                 <div id="status{{$index}}" class="hs-overlay hidden ti-modal">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                       <div class="ti-modal-content">
                                          <div class="ti-modal-header">
                                             <h6 class="modal-title text-[1rem] font-semibold">კომპანიის რედაქტირება</h6>
                                             <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#status{{$index}}">
                                                <span class="sr-only">Close</span>
                                                <i class="ri-close-line"></i>
                                             </button>
                                          </div>
                                          <form action="{{route('status.update')}}" method="post">
                                             <input type="hidden"  name="id" value="{{$status->id}}">
                                             <div class="ti-modal-body px-4">

                                                @csrf
                                                <div class="box-body">

                                                   <div class="mb-4">
                                                      <label for="form-password2" class="form-label text-[.875rem] text-black">
                                                         დასახელება</label> <br>
                                                      <input type="text" name="name" class="form-control" value="{{$status->name}}" id="form-password2" >
                                                   </div>
                                                </div>


                                             </div>
                                             <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#status{{$index}}">
                                                   გაუქმება
                                                </button>
                                                <button type="submit" class="ti-btn bg-primary text-white !font-medium">განახლება</button>
                                             </div>

                                          </form>

                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="box-footer border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>

      </div>
      <div class="xl:col-span-3 col-span-12">
         <div class="box custom-box">
            <div class="box-header justify-between">
               <div class="box-title">
                  წყარო
               </div>
            </div>
            <div class="box-body ">
               <div class="table-responsive">
                  <table class="text-center table whitespace-nowrap min-w-full">
                     <thead class="bg-primary/10 text-center">
                     <tr class="border-b border-primary/10 text-center">
                        <th style="text-align: center!important"  class="text-center">დასახელება</th>
                        <th style="text-align: center!important;width: 20px!important" class="text-center">მოქმედება</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($sources as $index => $source)
                        <tr class="border-b border-primary/10 text-center">
                           <td style="white-space:normal;max-width: 100px; word-wrap: break-word; overflow-wrap: break-word;" class="text-center">{{$source->name}}</td>
                           <td style="width: 15px!important">
                              <div class="hstack flex justify-center gap-3 text-[.9375rem]">
                                 {{--                              <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-info !rounded-full"></a>--}}
                                 <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-sm ti-btn-info !rounded-full" data-hs-overlay="#source{{$index}}"><i class="ri-edit-line"></i>
                                 </a>
                                 <div id="source{{$index}}" class="hs-overlay hidden ti-modal">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                       <div class="ti-modal-content">
                                          <div class="ti-modal-header">
                                             <h6 class="modal-title text-[1rem] font-semibold" id="source{{$index}}">კომპანიის რედაქტირება</h6>
                                             <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#source{{$index}}">
                                                <span class="sr-only">Close</span>
                                                <i class="ri-close-line"></i>
                                             </button>
                                          </div>
                                          <form action="{{route('source.update')}}" method="post">
                                             <input type="hidden"  name="id" value="{{$source->id}}">
                                             <div class="ti-modal-body px-4">

                                                @csrf
                                                <div class="box-body">

                                                   <div class="mb-4">
                                                      <label for="form-password3" class="form-label text-[.875rem] text-black">
                                                         დასახელება</label> <br>
                                                      <input type="text" name="name" class="form-control" value="{{$source->name}}" id="form-password3" >
                                                   </div>
                                                </div>


                                             </div>
                                             <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#source{{$index}}">
                                                   გაუქმება
                                                </button>
                                                <button type="submit" class="ti-btn bg-primary text-white !font-medium">განახლება</button>
                                             </div>

                                          </form>

                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="box-footer border-t-0">
               <!-- Prism Code -->

               <!-- Prism Code -->
            </div>
         </div>

      </div>

@endsection