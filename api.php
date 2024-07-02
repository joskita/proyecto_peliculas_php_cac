<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$servername = "localhost";
$username = "root";  // Cambiar si es necesario
$password = "";  // Cambiar si es necesario
$dbname = "peliculas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM peliculas WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $pelicula = $result->fetch_assoc();
            echo json_encode($pelicula);
            $stmt->close();
        } else {
            $sql = "SELECT * FROM peliculas";
            $result = $conn->query($sql);
            $peliculas = [];
            while ($row = $result->fetch_assoc()) {
                $peliculas[] = $row;
            }
            echo json_encode($peliculas);
        }
        break;

    case 'POST':
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen']['name'];
            $temp_name = $_FILES['imagen']['tmp_name'];
            $upload_dir = __DIR__ . '/uploads/';  // Ruta del directorio de subida en el servidor

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            if (move_uploaded_file($temp_name, $upload_dir . $imagen)) {
                $titulo = $_POST['titulo'];
                $genero = $_POST['genero'];
                $duracion = $_POST['duracion'];
                $sinopsis = $_POST['sinopsis'];
                $imagen = 'uploads/' . $imagen;  // Ruta relativa para almacenar en la base de datos

                $sql = "INSERT INTO peliculas (titulo, genero, duracion, sinopsis, imagen) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $titulo, $genero, $duracion, $sinopsis, $imagen);
                if ($stmt->execute()) {
                    echo json_encode(["message" => "Película agregada exitosamente"]);
                } else {
                    echo json_encode(["error" => "Error al agregar película: " . $stmt->error]);
                }
                $stmt->close();
            } else {
                echo json_encode(["error" => "Error al subir la imagen"]);
            }
        } else {
            echo json_encode(["error" => "Error al recibir la imagen"]);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        $id = intval($data['id']);
        $titulo = $data['titulo'];
        $genero = $data['genero'];
        $duracion = $data['duracion'];
        $sinopsis = $data['sinopsis'];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen']['name'];
            $temp_name = $_FILES['imagen']['tmp_name'];
            $upload_dir = __DIR__ . '/uploads/';  // Ruta del directorio de subida en el servidor

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            if (move_uploaded_file($temp_name, $upload_dir . $imagen)) {
                $imagen = 'uploads/' . $imagen;  // Ruta relativa para almacenar en la base de datos
                $sql = "UPDATE peliculas SET titulo=?, genero=?, duracion=?, sinopsis=?, imagen=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssi", $titulo, $genero, $duracion, $sinopsis, $imagen, $id);
            } else {
                echo json_encode(["error" => "Error al subir la imagen"]);
                exit;
            }
        } else {
            $sql = "UPDATE peliculas SET titulo=?, genero=?, duracion=?, sinopsis=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $titulo, $genero, $duracion, $sinopsis, $id);
        }

        if ($stmt->execute()) {
            echo json_encode(["message" => "Película actualizada exitosamente"]);
        } else {
            echo json_encode(["error" => "Error al actualizar película: " . $stmt->error]);
        }
        $stmt->close();
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        $id = intval($data['id']);
        $sql = "DELETE FROM peliculas WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Película eliminada exitosamente"]);
        } else {
            echo json_encode(["error" => "Error al eliminar película: " . $stmt->error]);
        }
        $stmt->close();
        break;

    default:
        echo json_encode(["error" => "Método no soportado"]);
        break;
}

$conn->close();
?>
