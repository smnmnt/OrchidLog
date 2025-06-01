<fieldset disabled>
    @include('parts.name')
    <div class="album">
        @foreach($flower_img_main as $flower_img_un)
            @include('parts.image_view')
            @break
        @endforeach
    </div>
    @include('parts.dob')
    @include('parts.size')
    @include('parts.notes')
    <style>
        .form-select {
            background-image: none;}
    </style>
</fieldset>
@if(!sizeof($old_shop))
    @include('parts.link_shop')
@else
    @foreach($old_shop as $Unit)
        @php
            $UnitLink   = $Unit->Link;
            $UnitShopName   = $Unit->Name;
        @endphp
        @include('parts.link_shop')
    @endforeach
@endif
<fieldset disabled>
    @include('parts.wrid')
    @include('parts.placement')
</fieldset>
