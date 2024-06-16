<?php
include 'config.php';

$peliculas = $conn->query("SELECT * FROM peliculas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--titulo-->
    <title>CodoMovies</title>
    <!--aos-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--favicon-->
    <link rel="icon" type="image/png" href="./assets/img/claqanim.png">
    <!--animate-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--css-->
    <link rel="stylesheet" href="css/styles.css" />
    
   
</head>
<body class="container">
    <!--inicio de header-->
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
         <section data-aos="fade-down"  data-aos-easing="linear" 
      data-aos-duration="1500" class="seccion-primaria">
        <section class="seccion-primaria">
            <h1>Películas y Series ilimitadas en un solo lugar</h1>
            <p>Disfrutá donde quieras.</p>
            <p>Cancelá en cualquier momento.</p>
            <input class="input_registrarse" type="button" value="Registrarse" />
        </section>
        <section class="seccion-secundaria">
            <h2>¿Qué estás buscando para ver?</h2>
            <form class="miniform-seccion-secundaria">
                <input class="input_textarea" type="text" placeholder="Buscar..."/>
                <input class="input_buscar" type="button" value="Buscar" />
            </form>
        </section>
        <hr />
        <section id="tendencias" class="seccion-tendencias">
             <section data-aos="fade-down"  data-aos-easing="linear" 
      data-aos-duration="1500" class="seccion-aclamadas">
            <h2 class="tend">Las Tendencias de Hoy</h2>
            <div class="container-peliculas" id="contenedor">
                <?php while ($row = $peliculas->fetch_assoc()): ?>
                <div class="pelicula">
                    <img src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['titulo']; ?>">
                    <h4 class="tend"><?php echo $row['titulo']; ?></h4>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="botones">
                <button id="btn-anterior" class="boton">Anterior</button>
                <button id="btn-siguiente" class="boton">Siguiente</button>
            </div>
        </section>
        <hr>
        <section class="seccion-aclamadas">
             <section data-aos="fade-down"  data-aos-easing="linear" 
      data-aos-duration="1500" class="seccion-aclamadas">
            <h2>Las Pelis más aclamadas</h2>
            <ul class="list-peliculas-aclamadas">
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/spiderman.webp" alt="Spiderman la pelicula" width="190"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/moana.webp" alt="moana la pelicula" width="190"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/raya-ultimo-dragon.webp" alt="raya y el ultimo dragon la pelicula" width="180"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/wish.webp" alt="whish la pelicula" width="190"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/increibles2.jpeg" alt="los increibles la pelicula" width="182"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/La-Dama-Y-El-Vagabundo.jpg" alt="la dama y el vagabundo la pelicula" width="190"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/reyleon.jpg" alt="rey leon la pelicula" width="190"/>
                </a>
                <a href="detalle.html">
                    <img class="imagen-galeria" src="assets/img/up.jpg" alt="up la pelicula" width="200"/>
                </a>
            </ul>
        </section>
    </main>

    <!--inicio de footer-->
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