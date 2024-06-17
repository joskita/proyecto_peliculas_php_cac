<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $duracion = $_POST['duracion'];
    $sinopsis = $_POST['sinopsis'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);

    $sql = "INSERT INTO peliculas (titulo, genero, duracion, sinopsis, imagen) VALUES ('$titulo', '$genero', '$duracion', '$sinopsis', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva película agregada con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM peliculas WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Película eliminada con éxito.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$peliculas = $conn->query("SELECT * FROM peliculas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Titulo-->
    <title>Administrador de Películas</title>
    <!--aos-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--favicon-->
    <link rel="icon" type="image/png" href="../assets/img/claqanim.png">
    <!--animate-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--css-->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!--inicio de header-->
    <header class="header">
        <nav class="nav">
            <ul class="list-nav">
                <li class="animate__animated animate__wobble animate__repeat-2 icono-peliculas list-item-anclas">  
                    <a href="index.php">
                        <img src="../assets/iconos/clapperboard-solid (1).svg" width="17px" alt="icono de codomovies" loading="lazy">
                        <span>CAC-Movies</span>
                    </a>
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
    <!--fin de header-->  
    <main>
        <h1 class="title-login">Administrador de Películas</h1>
        <section class="formulario-gestor-de-peliculas">
            <form action="adminPelis.php" method="POST" enctype="multipart/form-data">
                <div class="container-gestor">
                    <input class="input-gestor" type="text" name="titulo" placeholder="Título:" required>
                </div> 
                <div class="container-gestor">
                    <input class="input-gestor" type="text" name="genero" placeholder="Género:" required>
                    <input class="input-gestor" type="text" name="duracion" placeholder="Duración:" required>
                </div>  
                <div class="container-textarea">
                    <textarea class="textarea" name="sinopsis" cols="" rows="" placeholder="Sinopsis:" required></textarea>
                </div>
                <div class="container-gestor" id="file">
                    <input class="input-gestor" type="file" name="imagen" required>
                </div>
                <div>
                    <input class="input-submit" type="submit" value="Agregar Películas">
                </div>   
            </form>
        </section>
        <hr>
        <section>
            <h2>Listado de Películas</h2>
            <p class="listado-de-pelis">Para ver todos los datos de las películas, elija una y toque modificar.</p>
        </section>
        <section>
            <table class="tabla-modificadora">
                <tr>
                    <th>Título</th>
                    <th>Género</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($row = $peliculas->fetch_assoc()): ?>
                <tr>
                    <td class="titulo"><?php echo $row['titulo']; ?></td>
                    <td class="genero"><?php echo $row['genero']; ?></td>
                    <td>
                        <img class="img-listado-peliculas" src="<?php echo $row['imagen']; ?>" width="100">
                    </td>
                    <td>
                        <a href="editPelis.php?id=<?php echo $row['id']; ?>"><input class="input-modificar" type="button" value="Modificar"></a><br><br>
                        <a href="adminPelis.php?delete=<?php echo $row['id']; ?>"><input class="input-eliminar" type="button" value="Eliminar"></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>
    </main>  
    <!--inicio de footer-->
    <footer class="footer">
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
    <!--fin de footer-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
