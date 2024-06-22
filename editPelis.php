<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM peliculas WHERE id=$id");
$pelicula = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $duracion = $_POST['duracion'];
    $sinopsis = $_POST['sinopsis'];

    if ($_FILES['imagen']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
        $imagen = $target_file;
    } else {
        $imagen = $pelicula['imagen'];
    }

    $sql = "UPDATE peliculas SET titulo='$titulo', genero='$genero', duracion='$duracion', sinopsis='$sinopsis', imagen='$imagen' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Película actualizada con éxito.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>
    <!--favicon-->
    <link rel="icon" type="image/png" href="assets/img/claqanim.png">
    <!--animate-->
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--css-->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <style>
        .header a,
        .footer a {
            color: white;
        }

        .header a:hover,
        .footer a:hover {
            color: #ddd; /* Optional: lighter color on hover */
        }

        .header, .footer {
            background-color: #333; /* Ensure contrast with white text */
        }
    </style>

</head>
<body>
    
        <!-- Your header content -->
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
    <main class="container mt-5">
        <h1 class="mb-4">Editar Película</h1>
        <section>
            <form action="editPelis.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $pelicula['titulo']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $pelicula['genero']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración</label>
                    <input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo $pelicula['duracion']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="sinopsis">Sinopsis</label>
                    <textarea class="form-control" id="sinopsis" name="sinopsis" rows="4" required><?php echo $pelicula['sinopsis']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control-file" id="imagen" name="imagen">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Película</button>
            </form>
        </section>
    </main>
    <footer class="footer mt-5">
        <nav class="nav-footer">
            <ul class="list-footer">
                <li class="list-item-anclas">
                    <a href="#">Términos y Condiciones</a>
                </li>  
                <li class="list-item-anclas">
                    <a href="#">Preguntas Frecuentes</a>  
                </li>
                <li class="list-item-anclas">
                    <a href="#">Ayuda</a>
                </li>
                <li>
                    <a class="icono-arrow-up" href="index.php">
                        <img src="assets/iconos/iconizer-ei--arrow-up.svg" alt="flecha hacia arriba" width="60px"/>
                    </a>
                </li>
            </ul>
        </nav>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
