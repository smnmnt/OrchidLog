<div class="row mb-3">
    <label for="Link" class="col-form-label">{{ __('flower.shop') }}
        <div class="input-group mb-3">
            <input class="form-control" type="text" name="Link" placeholder="{{ __('basic.link') }}" disabled aria-describedby="button-addon2" value="{{ old('Link') ?? $UnitShopName ?? '' }}">
            @if(isset($UnitLink))
                <a href="{{$UnitLink}}" class="btn btn-outline-secondary" type="button" id="button-addon2">{{ __('basic.goto') }}</a>
            @endif
        </div>
    </label>
</div>

