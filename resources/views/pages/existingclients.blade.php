@extends('layout')

@php

//dd($application);


@endphp
@section('existing-clients')
    <table id="clientstable" class="display nowrap" style="width:100%">
        <thead>
        <tr style="text-align: center!important;">
            <td style="text-align: center!important;">შექმნის თარიღი</td>
            <td style="text-align: center!important;">პირადი ნომერი</td>
            <td style="text-align: center!important;">სახელი გვარი</td>
            <td style="text-align: center!important;">მობილური</td>
            <td style="text-align: center!important;">განაცხადი</td>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $index => $client)
        <tr style="text-align: center!important;" >
            <td style="text-align: center!important;">{{$client->created_at}}</td>
            <td style="text-align: center!important;">{{$client->pid}}</td>
            <td style="text-align: center!important;">{{$client->name}}</td>
            <td style="text-align: center!important;">{{$client->mobile1}}</td>
            <td style="text-align: center!important;">
                @if($client->applications_count>0)
                    {{$client->applications_count}}
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td style="text-align: center!important;">შექმნის თარიღი</td>
            <td style="text-align: center!important;">პირადი ნომერი</td>
            <td style="text-align: center!important;">სახელი გვარი</td>
            <td style="text-align: center!important;">მობილური</td>
            <td style="text-align: center!important;">განაცხადი</td>
        </tr>
        </tfoot>
    </table>


    <script>

    </script>

@endsection