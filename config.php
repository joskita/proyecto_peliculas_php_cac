<?php
$servername = "localhost";
$username = "id22317902_santiago";
$password = "Santiago65!";
$dbname = "id22317902_peliculasdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
