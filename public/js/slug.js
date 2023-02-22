const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
    
        title.addEventListener('change', function() {
            fetch('/post/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    
    
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })