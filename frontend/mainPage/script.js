import api from '../services/api.js';

import {
    getToken,
    removeToken
} from '../utils/auth.js';

import {
    showSuccess,
    showApiError
} from '../utils/messages.js';

const token = getToken();

const clientsContainer =
    document.getElementById('clients-container');

const logoutButton =
    document.getElementById('logout-button');

if (!token) {

    window.location.href =
        '../loginPage/login.html';
}

document.addEventListener(
    'DOMContentLoaded',
    () => {

        loadClients();
    }
);

logoutButton.addEventListener(
    'click',
    logout
);

async function loadClients() {

    try {

        const response =
            await api.get('/clients');

        const clients =
            response.data.data;

        renderClients(clients);

    } catch (error) {

        console.error(error);

        showApiError(error);
    }
}

function renderClients(clients) {

    clientsContainer.innerHTML = '';

    clients.forEach(client => {

        const div =
            document.createElement('div');

        div.classList.add('client-card');

        div.innerHTML = `
            <p>
                <strong>ID:</strong>
                ${client.id}
            </p>

            <p>
                <strong>Nome:</strong>
                ${client.name}
            </p>

            <p>
                <strong>Email:</strong>
                ${client.email}
            </p>

            <p>
                <strong>Telefone:</strong>
                ${client.phone}
            </p>

            <p>
                <strong>CPF:</strong>
                ${client.cpf}
            </p>
        `;

        clientsContainer.appendChild(div);
    });
}

async function logout() {

    try {

        await api.post(
            '/auth/logout'
        );

    } catch (error) {

        console.error(error);
    }

    removeToken();

    showSuccess(
        'Logout realizado.'
    );

    window.location.href =
        '../loginPage/login.html';
}