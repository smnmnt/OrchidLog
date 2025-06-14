<div class="album_el">
    <div class="card card_gallery_item shadow-sm pop" style="background-image: url(' {{$flower_img_un->Link}} '); background-size:cover;">
        <div class="card-body">
            <img src="{{$flower_img_un->Link}}" alt="{{ $Unit->Name }}" style="display: none;">
        </div>
    </div>
    <div class="card-footer">
        @if($flower_img_un->IsMain == 1)
            <input type="submit" class="btn standart-btn" disabled aria-label="Update" style="background-image: url({{ asset('/storage/img/star-fill.svg') }});" value="">
        @else
            <form action="{{ route('flowers.update_img_main', ['id' => $flower_img_un->ID]) }}"
                  class=""
                  method="post"
                  onsubmit="return;">
                @csrf
                @method('PATCH')
                <input type="submit" class="btn standart-btn" aria-label="Update" style="background-image: url({{ asset('/storage/img/star.svg') }});" value="">
                <!-- /.standart-btn -->
            </form>
        @endif
        <form action="{{ route('flowers.destroy_img', ['id' => $flower_img_un->ID]) }}"
              class="delete-btn"
              method="post"
              onsubmit="return confirm('{{ __('flower.del_img', ['name' => $Unit->Name]) }}');">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
            <!-- /.standart-btn -->
        </form>
    </div>
</div>
