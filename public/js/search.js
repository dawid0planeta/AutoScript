const search = document.querySelector('input[placeholder="Search..."]');
const snippetContainer = document.querySelector('.snippet-container');


search.addEventListener('keyup', function(event) {
    if(event.key === "Enter") {
        event.preventDefault();


        const data = {search: this.value, path: window.location.pathname};

        fetch('/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }).then(function(response) {
            console.log(response);
            return response.json();
        }).then(function(snippets) {
            snippetContainer.innerHTML = '';
            loadSnippets(snippets)
        })


    }
});


function loadSnippets(snippets) {
    snippets.forEach(function(snippet) {
        console.log(snippet)
        createSnippet(snippet);
    });
}

function createSnippet(snippet) {
    const template = document.querySelector('#snippet-template');

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector('img');
    image.src = `/public/img/${snippet.platform}.svg`;
    const title = clone.querySelector('#title');
    title.innerHTML = snippet.title;
    const description = clone.querySelector('#description');
    description.innerHTML = snippet.description;
    const author_name = clone.querySelector('#author-name');
    author_name.innerHTML = `by ${snippet.name} ${snippet.surname}`;
    const link = clone.querySelector('a');
    link.href = '/snippet/${snippet.id}';

    snippetContainer.appendChild(clone);
}