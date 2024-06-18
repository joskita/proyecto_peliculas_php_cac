<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM peliculas WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $pelicula = $result->fetch_assoc();
    } else {
        // Si no se encuentra la película, redirigir a la página principal
        header('Location: index.php');
        exit();
    }
} else {
    // Si no hay un ID en la URL, redirigir a la página principal
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($pelicula['titulo']); ?> - CodoMovies</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./assets/img/claqanim.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="css/styles.css" />
    <style>
        .detalle-pelicula {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin: 40px 0; /* Añadir margen superior e inferior */
        }
        .detalle-pelicula img {
            width: 356px;
            height: 512px;
            object-fit: cover;
        }
        .detalle-pelicula .info {
            max-width: 600px;
        }
    </style>
</head>
<body class="container">
    <header class="header">
        <nav class="nav">
            <ul class="list-nav">
                <li class="animate__animated animate__wobble animate__repeat-2 icono-peliculas list-item-anclas">  
                    <a href="index.php">
                        <img src="assets/iconos/clapperboard-solid (1).svg" width="17px" alt="icono de codomovies" loading="lazy">
                        <span>CAC-Movies</span>
                    </a>
                </li>
                <li class="list-item-anclas">
                    <a href="apiClima.html">Clima</a>
                </li>
                <li class="list-item-anclas">
                    <a href="#tendencias">Tendencias</a>
                </li>
                <li class="list-item-anclas">
                    <a href="registrarse.html" target="_blank">Registrarse</a>
                </li>
                <li class="list-item-anclas">
                    <a href="login.html" target="_blank">Iniciar Sesion</a>
                </li>
            </ul>
        </nav>
    </header>
    
    <main class="main-container">
        <section class="detalle-pelicula">
            <img src="<?php echo htmlspecialchars($pelicula['imagen']); ?>" alt="<?php echo htmlspecialchars($pelicula['titulo']); ?>">
            <div class="info">
                <h1><?php echo htmlspecialchars($pelicula['titulo']); ?></h1>
                <p><strong>Género:</strong> <?php echo htmlspecialchars($pelicula['genero']); ?></p>
                <p><strong>Duración:</strong> <?php echo htmlspecialchars($pelicula['duracion']); ?></p>
                <p><strong>Sinopsis:</strong> <?php echo htmlspecialchars($pelicula['sinopsis']); ?></p>
            </div>
        </section>
    </main>
    
    <footer class="footer">
        <nav class="nav-footer">
            <ul class="list-footer">
                <li class="list-item-anclas">
                    <a href="">Términos y Condiciones</a>
                </li>  
                <li class="list-item-anclas">
                    <a href="">Preguntas Frecuentes</a>  
                </li>
                <li class="list-item-anclas">
                    <a href="">Ayuda</a>
                </li>
                <li class="list-item-anclas">
                    <a href="adminPelis.php">Administrador de Películas</a>
                </li>
                <li>
                    <a class="icono-arrow-up" href="index.php">
                        <img src="assets/iconos/iconizer-ei--arrow-up.svg" alt="flecha hacia arriba" width="60px"/>
                    </a>
                </li>
            </ul>
        </nav>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>


