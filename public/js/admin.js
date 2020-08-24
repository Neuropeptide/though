document.addEventListener('DOMContentLoaded', function() {

    const $checkboxes = document.querySelectorAll('input[name="is_published"]');

    for (const $checkbox of $checkboxes) {

        const $form = $checkbox.closest('form');

        $form.querySelector('[type="submit"]').style.display = "none";

        $checkbox.addEventListener('change', function() {
            $form.submit();
        });
    }
});
