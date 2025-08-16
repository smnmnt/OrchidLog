<div class="image-grid">
	<div class="image-grid">
			<div class="image-thumbnail"
				 data-image-preview="{{ asset($flower_img_un->Link) }}"
				 @if($flower_img_un->OriginalLink)
					 data-image-original="{{ asset($flower_img_un->OriginalLink) }}"
				 @endif>
				<img src="{{ asset($flower_img_un->Link) }}" alt="Превью">
			</div>
	</div>
    <div class="card-footer" id="card-footer">
		<p class="text-muted text-center">
			@if($flower_img_un->taken_at)
				Дата съемки: {{ date('d m Y H:i', strtotime($flower_img_un->taken_at)) }}
			@else
				Дата загрузки: {{ date('d m Y H:i', strtotime($flower_img_un->created_at)) }}
			@endif
		</p>
		<div class="card-footer-actions">
			@if($flower_img_un->IsMain == 1)
				<input type="submit" class="btn standart-btn" disabled aria-label="Update" style="background-image: url({{ asset('/storage/img/star-fill.svg') }});" value="">
			@else
				<form action="{{ route('flowers.update_img_main', ['id' => $flower_img_un->ID]) }}"
					  class=""
					  method="post"
					  onsubmit="return;">
					@csrf
					@method('PATCH')
					<input type="submit" class="btn standart-btn" aria-label="Update" style="background-image: url({{ asset('/storage/img/star.svg') }});" value="">
					<!-- /.standart-btn -->
				</form>
			@endif
			<form action="{{ route('flowers.destroy_img', ['id' => $flower_img_un->ID]) }}"
				  class="delete-btn"
				  method="post"
				  onsubmit="return confirm('{{ __('flower.del_img', ['name' => $Unit->Name]) }}');">
				@csrf
				@method('DELETE')
				<input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
				<!-- /.standart-btn -->
			</form>
		</div>
    </div>
</div>
