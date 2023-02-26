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

function DOMFromString(html) {
    const template = document.createElement('template');
    template.innerHTML = html.trim();
    return template.content.firstChild;
}