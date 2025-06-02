<div class="row mb-3">
    <label for="TypeID" class="form-label"> Тип
        <select class="form-select" name="TypeID" aria-label="Тип">
            @if(empty($old_type))
                <option selected disabled>Выберите тип</option>
            @else
                    <option value="{{ $old_type->ID }}" name="{{ $old_type->WateringName }}" id="{{ $old_type->WateringName }}">{{ $old_type->WateringName }}</option>
            @endif
            @if(isset($types) && sizeof($types))
                @foreach($types as $type)
                    <option value="{{ $type->ID }}" name="{{ $type->WateringName }}" id="{{ $type->WateringName }}">{{ $type->WateringName }}</option>
                @endforeach
            @endif
        </select>
    </label>
</div>
