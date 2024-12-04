<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $foto = $_FILES['foto'];

    $fotoNombre = time() . '_' . $foto['name'];
    move_uploaded_file($foto['tmp_name'], "uploads/$fotoNombre");

    $stmt = $pdo->prepare("INSERT INTO coches (marca, modelo, precio, foto) VALUES (?, ?, ?, ?)");
    $stmt->execute([$marca, $modelo, $precio, $fotoNombre]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Coche</title>
</head>
<body>
    <h1>Agregar Coche</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="number" name="precio" placeholder="Precio" required>
        <input type="file" name="foto" required>
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
