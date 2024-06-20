document.addEventListener('DOMContentLoaded', () => {
    const commentsForms = document.querySelectorAll('form');

    commentsForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const postData = new FormData(form);
            fetch('comentar.php', {
                method: 'POST',
                body: postData
            })
            .then(response => response.text())
            .then(data => {
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
