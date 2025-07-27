document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contact_form');
    const fullName = document.getElementById('full_name');
    const email = document.getElementById('email');
    const message = document.getElementById('message');
    const submitButton = document.getElementById('submit_button');

    const fullNameError = document.getElementById('full_name_error');
    const emailError = document.getElementById('email-error');
    const messageError = document.getElementById('message-error');

    const alert = document.getElementById('alert');

    function validateFullName() {
        if (fullName.value.trim() === '' || fullName.value.length <= 3) {
            fullName.classList.remove('is-valid');
            fullName.classList.add('is-invalid');
            fullNameError.textContent = 'El nombre completo es obligatorio.';
            return false;
        } else {
            fullName.classList.remove('is-invalid');
            fullName.classList.add('is-valid');
            fullNameError.textContent = '';
            return true;
        }
    }

    function validateEmail() {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === '') {
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            emailError.textContent = 'El correo es obligatorio.';
            return false;
        } else if (!emailPattern.test(email.value.trim())) {
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            emailError.textContent = 'El correo no es válido.';
            return false;
        } else {
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
            emailError.textContent = '';
            return true;
        }
    }

    function validateMessage() {
        if (message.value.trim() === '') {
            message.classList.remove('is-valid');
            message.classList.add('is-invalid');
            messageError.textContent = 'El mensaje es obligatorio.';
            return false;
        } else {
            message.classList.remove('is-invalid');
            message.classList.add('is-valid');
            messageError.textContent = '';
            return true;
        }
    }

    function checkFormValidity() {
        submitButton.disabled = !(validateFullName() && validateEmail() && validateMessage());
    }

    fullName.addEventListener('input', () => {
        validateFullName();
        checkFormValidity();
    });
    email.addEventListener('input', () => {
        validateEmail();
        checkFormValidity();
    });
    message.addEventListener('input', () => {
        validateMessage();
        checkFormValidity();
    });

    // TODO: Capture the base url from the fetch request for the contact form

    form.addEventListener('submit', function (event) {
        if (!validateFullName() || !validateEmail() || !validateMessage()) {
            event.preventDefault();
        } else {
            startLoading();
            event.preventDefault();
            const body = {};
            const formElements = [...event.target.elements].filter((el) =>
                el.hasAttribute('name')
            );

            for (const el of formElements) {
                body[el.getAttribute('name')] = el.value;
            }

            fetch('./v1/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(body),
            }
        ).
            then((response) => {
                return response.json();
            }).then((data) => {
                stopLoading();
                if (data.errors) {
                    alert.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>¡Ups!</strong> Por favor, verifica los campos.
                            </div>
                        `;
                } else {
                    alert.innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>¡Gracias!</strong> ${data.message}
                            </div>
                        `;
                    setTimeout(() => {
                        alert.innerHTML = '';
                    }, 5000);
                    form.reset();
                    fullName.classList.remove('is-valid');
                    email.classList.remove('is-valid');
                    message.classList.remove('is-valid');
                }
            });
        }
    });
});