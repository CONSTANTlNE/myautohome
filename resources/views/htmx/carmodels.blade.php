@foreach($models as $index => $model)
    <option value="{{$model->id}}">{{$model->name}}</option>
@endforeach
{{--<script>--}}

{{--if(typeof modelsselect{{$counter2-1}} !== 'undefined'){--}}
{{--    console.log({{$counter2}});--}}

{{--console.log( modelsselect{{$counter2-1}});--}}
{{--    modelsselect{{$counter2-1}}.destroy(modelsselect{{$counter2-1}});--}}
{{--}--}}
{{--    let modelsselect{{$counter2}};--}}
{{--    modelsselect{{$counter2}} = new TomSelect("#modelsselect", {--}}
{{--        create: true,--}}
{{--        sortField: {--}}
{{--            field: "text",--}}
{{--            direction: "asc"--}}
{{--        }--}}
{{--    })--}}
</script>