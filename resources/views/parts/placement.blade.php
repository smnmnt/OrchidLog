<div class="row mb-3">
    <label for="PlacementID" class="form-label"> Место
        <select class="form-select" name="PlacementID" aria-label="Место">
            @if(empty($old_placements))
                <option selected disabled>Выберите место</option>
            @else
                @foreach($old_placements as $old_el)
                    <option value="{{ $old_el->ID }}" name="{{ $old_el->Name }}" id="{{ $old_el->Name }}">{{ $old_el->Name }}</option>
                    @break
                @endforeach
            @endif
            @if(isset($placements) && sizeof($placements))
                    @foreach($placements as $placement)
                        <option value="{{ $placement->ID }}" name="{{ $placement->Name }}" id="{{ $placement->Name }}">{{ $placement->Name }}</option>
                    @endforeach
            @endif
        </select>
    </label>
</div>
