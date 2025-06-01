<div class="row mb-3">
    <label for="FertilizerID" class="form-label"> Удобрение
        <select class="form-select" name="FertilizerID" aria-label="Удобрение">
            @if(empty($old_fertilizer))
                <option selected disabled>Выберете удобрение</option>
            @else
                <option value="{{ $old_fertilizer->ID }}" name="{{ $old_fertilizer->Name }}" id="{{ $old_fertilizer->Name }}">{{ $old_fertilizer->Name }}</option>
            @endif
            @if(isset($fertilizers) && sizeof($fertilizers))
                @foreach($fertilizers as $fertilizer)
                    <option value="{{ $fertilizer->ID }}" name="{{ $fertilizer->Name }}" id="{{ $fertilizer->Name }}">{{ $fertilizer->Name }}</option>
                @endforeach
            @endif
        </select>
    </label>
</div>
