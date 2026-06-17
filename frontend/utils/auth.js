export function saveToken(token) {

    localStorage.setItem(
        'token',
        token
    );
}

export function getToken() {

    return localStorage.getItem(
        'token'
    );
}

export function removeToken() {

    localStorage.removeItem(
        'token'
    );
}

export function isAuthenticated() {

    return !!getToken();
}

export function logout() {

    removeToken();

    window.location.href =
        '../loginPage/login.html';
}

export function redirectIfAuthenticated() {

    if (isAuthenticated()) {

        window.location.href =
            '../mainPage/index.html';
    }
}

export function redirectIfNotAuthenticated() {

    if (!isAuthenticated()) {

        window.location.href =
            '../loginPage/login.html';
    }
}