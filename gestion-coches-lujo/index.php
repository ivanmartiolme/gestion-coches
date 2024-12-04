<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'config.php';

$stmt = $pdo->query("SELECT * FROM coches");
$coches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Coches</title>
</head>
<body>
    <h1>Gestión de Coches</h1>
    <a href="agregar_coche.php">Agregar Coche</a>
    <a href="autenticacion.php?logout=1">Cerrar Sesión</a>
    <table>
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coches as $coche): ?>
                <tr>
                    <td><?= htmlspecialchars($coche['marca']) ?></td>
                    <td><?= htmlspecialchars($coche['modelo']) ?></td>
                    <td><?= htmlspecialchars($coche['precio']) ?></td>
                    <td><img src="uploads/<?= htmlspecialchars($coche['foto']) ?>" alt="Foto"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
