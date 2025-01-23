@csrf
<div class="row mb-3">
    <label for="FertilizerName" class="col-md-4 col-form-label">Название удобрения
        <input class="form-control" type="text" name="FertilizerName" placeholder="Название удобрения" required value="{{ old('FertilizerName') ?? $Fertilizer_un->FertilizerName ?? '' }}">
    </label>
</div>
<div class="row mb-3">
    <label for="FertilizerDesc" class="form-label col-md-4"> Описание удобрения
        <textarea class="form-control" name="FertilizerDesc" id="FertilizerDesc" rows="3" placeholder="Описание удобрения">{{ old('FertilizerDesc') ?? $Fertilizer_un->FertilizerDesc ?? '' }}</textarea>
    </label>
</div>
<!-- /.input-group -->
<input type="submit" class="btn btn-primary form-submit" value="Отправить данные">
