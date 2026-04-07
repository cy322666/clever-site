<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-slug-generator]').forEach((scope) => {
            const titleInput = scope.querySelector('[data-slug-source]');
            const slugInput = scope.querySelector('[data-slug-target]');

            if (!titleInput || !slugInput) {
                return;
            }

            let slugTouched = slugInput.value.trim() !== '';

            const slugify = (value) => value
                .toString()
                .toLowerCase()
                .trim()
                .replace(/[^a-zа-я0-9\s-]/gi, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            titleInput.addEventListener('input', () => {
                if (!slugTouched) {
                    slugInput.value = slugify(titleInput.value);
                }
            });

            slugInput.addEventListener('input', () => {
                slugTouched = slugInput.value.trim() !== '';
            });
        });
    });
</script>
