document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (id) {
        fetch(`https://peliculasg7cac.000webhostapp.com/api.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.id) {
                    document.getElementById('id').value = data.id;
                    document.getElementById('titulo').value = data.titulo;
                    document.getElementById('genero').value = data.genero;
                    document.getElementById('duracion').value = data.duracion;
                    document.getElementById('sinopsis').value = data.sinopsis;
                    // No cargamos la imagen aquí porque no podemos llenar un input de tipo file
                } else {
                    console.error('Error al obtener los datos de la película:', data);
                }
            })
            .catch(error => {
                console.error('Error al obtener los datos de la película:', error);
            });
    } else {
        console.error('No se proporcionó un ID de película.');
    }

    document.getElementById('editar-formulario').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        // Asegurarse de que el ID esté presente en el formData
        formData.append('id', document.getElementById('id').value);

        fetch('https://peliculasg7cac.000webhostapp.com/api.php', {
            method: 'PUT',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                window.location.href = 'adminPelis.html';
            } else {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error al actualizar los datos de la película:', error);
        });
    });
});
