<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <div class="col">
        <div class="card shadow-sm">
            @foreach($flower_img_main as $flower_img_m)
                <img src="{{$flower_img_m->Link}}" alt="{{ $Unit->Name }}">
            @endforeach
        </div>
        <a class="card shadow-sm">
            @foreach($flower_imgs as $flower_img_un)
                <img src="{{$flower_img_un->Link}}" alt="{{ $Unit->Name }}">
            @endforeach
            @for($i = 1; $i <= 4; $i++)
            @endfor
        </a>
    </div>
</div>
