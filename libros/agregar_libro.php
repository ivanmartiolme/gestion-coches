<?php
$conexion = new mysqli('localhost', 'libros_db', '1234', 'libros_db');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$datos = json_decode(file_get_contents('php://input'), true);

$titulo = $conexion->real_escape_string($datos['titulo']);
$autor = $conexion->real_escape_string($datos['autor']);
$precio = $conexion->real_escape_string($datos['precio']);
$isbn = $conexion->real_escape_string($datos['isbn']);

$sql = "INSERT INTO libros (titulo, autor, precio, isbn) VALUES ('$titulo', '$autor', '$precio', '$isbn')";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Libro agregado exitosamente."]);
} else {
    echo json_encode(["mensaje" => "Error al agregar el libro: " . $conexion->error]);
}

$conexion->close();
?>