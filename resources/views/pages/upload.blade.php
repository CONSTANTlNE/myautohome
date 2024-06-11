@extends('layout')


@section('upload')

  @php
//dd($apps)
 @endphp

  <div class="flex flex-col">
  <div class="mb-5 w-1/4">
     <p>Cars</p>
    <form action="{{route('upload.cars')}}" method="post" enctype="multipart/form-data">
      @csrf

    <label for="file-input" class="sr-only">Cars</label>
    <input type="file" name="cars" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">

      <button  class="ti-btn ti-btn-light ti-btn-wave">Upload</button>
    </form>
  </div>



    <div class="mb-5 w-1/4">

      <p>data</p>
      <form action="{{route('upload.data')}}" method="post" enctype="multipart/form-data">
        @csrf
      <label for="file-input" class="sr-only">Type file</label>
      <input type="file" name="data" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">
        <button  class="ti-btn ti-btn-light ti-btn-wave">Upload</button>

      </form>
    </div>

    <div class="mb-5 w-1/4">

      <p>potential</p>
      <form action="{{route('upload.potential')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file-input" class="sr-only">Type file</label>
        <input type="file" name="potential" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">
        <button  class="ti-btn ti-btn-light ti-btn-wave">Upload</button>

      </form>
    </div>
  </div>




@endsection