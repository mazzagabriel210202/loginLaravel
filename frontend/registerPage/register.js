const API_URL = 'http://localhost:8000/api';

const registerForm =
    document.getElementById('register-form');

document.addEventListener('DOMContentLoaded', () => {

    const token = localStorage.getItem('token');

    if (token) {
        window.location.href =
            '../mainPage/index.html';
    }
});

registerForm.addEventListener(
    'submit',
    register
);

async function register(event) {

    event.preventDefault();

    const data = {

        name:
            document.getElementById('name').value,

        email:
            document.getElementById('email').value,

        phone:
            document.getElementById('phone').value,

        cpf:
            document.getElementById('cpf').value,

        birth_date:
            document.getElementById('birth-date').value,

        password:
            document.getElementById('password').value,

        password_confirmation:
            document.getElementById(
                'password-confirmation'
            ).value
    };

    try {

        const response = await axios.post(
            `${API_URL}/auth/register`,
            data
        );

        const token =
            response.data.data.token;

        localStorage.setItem(
            'token',
            token
        );

        alert('Cadastro realizado com sucesso.');

        window.location.href =
            '../mainPage/index.html';

    } catch (error) {

        console.error(error);

        if (
            error.response &&
            error.response.data &&
            error.response.data.message
        ) {

            alert(
                error.response.data.message
            );

            return;
        }

        alert('Erro ao registrar.');
    }
}