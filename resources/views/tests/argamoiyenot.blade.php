

@foreach($applications as $application)
    <p>{{$application->status->name}}</p>

@endforeach