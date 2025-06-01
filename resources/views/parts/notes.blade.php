<div class="row mb-3">
    <label for="Notes" class="form-label">Заметки
        <textarea class="form-control" name="Notes" id="Notes" rows="3" placeholder="Заметки">{{ old('Notes') ?? $UnitNotes ?? '' }}</textarea>
    </label>
</div>
