/**
 * Główny plik JavaScript motywu.
 */
document.addEventListener('DOMContentLoaded', function() {

    // --- Logika dla menu mobilnego ---
    const menuButton = document.querySelector('[data-js="mobile-menu-button"]');
    const mobileMenu = document.querySelector('[data-js="mobile-menu"]');
    const menuIcon = document.querySelector('[data-js="menu-icon"]');
    const closeIcon = document.querySelector('[data-js="close-icon"]');

    if (menuButton && mobileMenu && menuIcon && closeIcon) {
        menuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }

    // --- Logika dla formularza kontaktowego (poprawiona i ze stylami) ---
    document.addEventListener('wpcf7submit', function(event) {
        const form = event.target;
        const targetH3 = form.querySelector('h3.text-xl');

        // Pobieramy status wysyłki bezpośrednio z danych zdarzenia
        const status = event.detail.apiResponse.status;

        setTimeout(function() {
            const responseOutput = form.querySelector('.wpcf7-response-output');

            if (responseOutput && targetH3) {
                // Przenosimy komunikat pod nagłówek h3
                targetH3.insertAdjacentElement('afterend', responseOutput);

                // Upewniamy się, że komunikat jest widoczny
                responseOutput.style.display = 'block';

                // --- POPRAWIONA LOGIKA: Sprawdzamy status zamiast klasy ---
                responseOutput.classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800');

                // Sprawdzamy, czy status to 'mail_sent' (sukces)
                if (status === 'mail_sent') {
                    // Dodajemy klasy dla komunikatu o sukcesie (zielony)
                    responseOutput.classList.add('bg-green-100', 'text-green-800', 'p-4', 'mb-4', 'text-sm', 'rounded-lg');
                } else {
                    // W każdym innym przypadku (np. błąd walidacji) dodajemy klasy błędu (czerwony)
                    responseOutput.classList.add('bg-red-100', 'text-red-800', 'p-4', 'mb-4', 'text-sm', 'rounded-lg');
                }
            }
        }, 100);

    }, false);

});
