<form action="{{ route('flowers.store_img', ['id' => $Unit->ID]) }}" method="post" class="form-box mb-5 mt-1" enctype="multipart/form-data">
    @csrf
    @include('parts.image_input')
    @include('parts.submit')
</form>
{{--                        <li class="list-group-item mb-1 mt-1"><a href="{{route('flowers.create')}}" class="link-primary">Добавить</a></li>--}}
<div class="album">
    @foreach($flower_imgs as $flower_img_un)
        @include('parts.image_view')
    @endforeach
</div>
