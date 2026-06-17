export function showSuccess(message) {

    alert(message);
}

export function showError(message) {

    alert(message);
}

export function showApiError(error) {

    console.error(error);

    if (
        error.response &&
        error.response.data &&
        error.response.data.message
    ) {

        showError(
            error.response.data.message
        );

        return;
    }

    showError(
        'Erro interno da aplicação.'
    );
}