<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('textarea').forEach(el => {
            el.style.height = 'auto';
            el.style.height = el.scrollHeight / 10 + 'em';
        });
    });
</script>

