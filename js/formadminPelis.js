document.addEventListener('DOMContentLoaded', function () {
    const apiUrl = 'https://peliculasg7cac.000webhostapp.com/api.php';

    // Función para cargar las películas
    function loadPeliculas() {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const peliculasLista = document.getElementById('peliculas-lista');
                peliculasLista.innerHTML = '';
                data.forEach(pelicula => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${pelicula.titulo}</td>
                        <td>${pelicula.genero}</td>
                        <td><img src="${pelicula.imagen}" alt="${pelicula.titulo}" width="50"></td>
                        <td>
                            <button onclick="editarPelicula(${pelicula.id})">Editar</button>
                            <button onclick="eliminarPelicula(${pelicula.id})">Eliminar</button>
                        </td>
                    `;
                    peliculasLista.appendChild(row);
                });
            });
    }

    // Función para redirigir a la página de edición
    window.editarPelicula = function (id) {
        window.location.href = `editPeli.html?id=${id}`;
    }

    // Función para eliminar una película
    window.eliminarPelicula = function (id) {
        const confirmar = confirm("¿Estás seguro de que quieres eliminar esta película?");
        if (confirmar) {
            fetch(apiUrl, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                loadPeliculas();
            })
            .catch(error => {
                console.error('Error al eliminar la película:', error);
            });
        }
    }

    loadPeliculas();
});
