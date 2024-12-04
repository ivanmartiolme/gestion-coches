document.getElementById('libroForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const libroData = {
        titulo: document.getElementById('titulo').value,
        autor: document.getElementById('autor').value,
        precio: document.getElementById('precio').value,
        isbn: document.getElementById('isbn').value
    };

    fetch('agregar_libro.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(libroData)
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('resultado').innerText = data.mensaje;
        document.getElementById('libroForm').reset();
    })
    .catch(error => console.error('Error:', error));
});