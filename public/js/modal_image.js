document.addEventListener('DOMContentLoaded', function() {
	const imageModal = new bootstrap.Modal('#imageModal');

	document.querySelectorAll('[data-image-preview]').forEach(item => {
		item.addEventListener('click', function() {
			const previewUrl = this.dataset.imagePreview;
			const originalUrl = this.dataset.imageOriginal;
			const modalFooter = document.querySelector('#imageModal .modal-footer');

			// Очищаем предыдущие кнопки
			modalFooter.querySelectorAll('.original-link').forEach(btn => btn.remove());

			// Устанавливаем превью
			document.querySelector('.modal-preview-image').src = previewUrl;

			// Добавляем кнопку "Оригинал" только если есть ссылка
			if (originalUrl && originalUrl !== '#' && originalUrl !== 'undefined') {
				const originalBtn = document.createElement('a');
				originalBtn.href = originalUrl;
				originalBtn.className = 'btn btn-primary original-link me-auto';
				originalBtn.textContent = 'Открыть оригинал';
				originalBtn.target = '_blank';
				modalFooter.prepend(originalBtn);
			}

			imageModal.show();
		});
	});
});
