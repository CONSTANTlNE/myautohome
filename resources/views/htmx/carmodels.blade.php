@foreach($models as $index => $model)
    <option value="{{$model->id}}">{{$model->name}}</option>
@endforeach
