<div class="row mb-3">
    <label for="Desc" class="form-label"> Описание
        <textarea class="form-control" name="Desc" id="Desc" rows="3" placeholder="Описание">{{ old('Desc') ?? $UnitDesc ?? '' }}</textarea>
    </label>
</div>
