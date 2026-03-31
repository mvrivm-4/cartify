import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    if (window.AOS) {
        window.AOS.init({
            duration: 700,
            once: true,
            easing: 'ease-out-cubic',
        });
    }

    const forms = document.querySelectorAll('.js-add-to-cart-form');
    const cartCountEl = document.querySelector('.js-cart-count');

    forms.forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
            }

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        Accept: 'application/json',
                    },
                    body: new FormData(form),
                });

                if (!response.ok) {
                    window.location.href = '/login';
                    return;
                }

                const data = await response.json();
                if (cartCountEl && typeof data.cart_count === 'number') {
                    cartCountEl.textContent = String(data.cart_count);
                }
            } catch (_error) {
                // Fallback to normal submit if fetch fails.
                form.submit();
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                }
            }
        });
    });
});
