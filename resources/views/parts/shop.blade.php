<div class="row mb-3">
    <label for="ShopID" class="form-label"> Магазин
        <select class="form-select" name="ShopID" aria-label="Выбор магазина">
            @if(empty($old_shop))
                <option selected disabled>Выберите магазин</option>
            @else
                @foreach($old_shop as $old_el)
                    <option value="{{ $old_el->ID }}" name="{{ $old_el->Name }}" id="{{ $old_el->Name }}">{{ $old_el->Name }}</option>
                    @break
                @endforeach
            @endif
            @if(isset($shops) && sizeof($shops))
                    @foreach($shops as $shop)
                        <option value="{{ $shop->ID }}" name="{{ $shop->Name }}" id="{{ $shop->Name }}">{{ $shop->Name }}</option>
                    @endforeach
                @endif
        </select>
    </label>
</div>
