//Script de démarrage pour désactiver les soumissions de formulaire en cas de champs invalides

    (() => {
        'use strict';

        // Récupérez tous les formulaires pour appliquer des styles de validation Bootstrap personnalisés.
        const forms = document.querySelectorAll('.needs-validation');

        // Bouclez sur tous les formulaires et empêchez la soumission
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
