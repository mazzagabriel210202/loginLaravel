const API_URL = 'http://localhost:8000/api';

const loginForm = document.getElementById('login-form');

document.addEventListener('DOMContentLoaded', () => {

    const token = localStorage.getItem('token');

    if (token) {
        window.location.href = '../mainPage/index.html';
    }
});

loginForm.addEventListener('submit', login);

async function login(event) {

    event.preventDefault();

    const email = document.getElementById('email').value;

    const password = document.getElementById('password').value;

    try {

        const response = await axios.post(
            `${API_URL}/auth/login`,
            {
                email,
                password
            }
        );

        const token = response.data.data.token;

        localStorage.setItem('token', token);

        alert('Login realizado com sucesso.');

        window.location.href =
            '../mainPage/index.html';

    } catch (error) {

        console.error(error);

        if (
            error.response &&
            error.response.data &&
            error.response.data.message
        ) {

            alert(error.response.data.message);

            return;
        }

        alert('Erro ao realizar login.');
    }
}