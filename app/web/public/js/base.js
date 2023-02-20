const spinner = () => {
    let html = `
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
             </div>
        </div>
    `;
    return DOMFromString(html)
}

const alert = (id, message) => {
    let html = `
        <div id="${id}" class="alert-warning fade show alert alert-dismissible" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    return DOMFromString(html)
}

function DOMFromString(html) {
    const template = document.createElement('template');
    template.innerHTML = html.trim();
    return template.content.firstChild;
}