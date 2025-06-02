<div class="row mb-3">
    <label for="WRID" class="form-label"> Условия полива
        <select class="form-select" name="WRID" aria-label="Условия полива">
            @if(empty($old_wrs))
                <option selected disabled>Условия полива</option>
            @else
                @foreach($old_wrs as $old_el)
                    <option value="{{ $old_el->ID }}" name="{{ $old_el->Name }}" id="{{ $old_el->Name }}">{{ $old_el->Name }}</option>
                    @break
                @endforeach
            @endif
            @if(isset($wrs) && sizeof($wrs))
                    @foreach($wrs as $wr)
                        <option value="{{ $wr->ID }}" name="{{ $wr->Name }}" id="{{ $wr->Name }}">{{ $wr->Name }}</option>
                    @endforeach
            @endif
        </select>
    </label>
</div>
