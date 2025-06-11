<div class="row mb-3">
    <label for="Desc" class="form-label">{{ __('basic.name') }}
        <textarea class="form-control" style="min-height: auto; resize: none;" name="Name" id="Name" rows="3" placeholder="{{ __('basic.name') }}" oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';">{{ old('Name') ?? $UnitName ?? '' }}</textarea>
    </label>
</div>
