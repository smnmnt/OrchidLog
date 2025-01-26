@if(isset($flowers) && sizeof($flowers))
    @foreach($flowers as $flower)
        {{$flower}}
    @endforeach
@else
    NAnnnn
@endif
