<div class="row mb-3">
    <label for="Desc" class="form-label">{{ __('basic.desc') }}
        <textarea class="form-control" style="min-height: auto; resize: none;" name="Desc" id="Desc" rows="3" placeholder="{{ __('basic.desc') }}" oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';">{{ old('Desc') ?? $UnitDesc ?? '' }}</textarea>
    </label>
</div>
