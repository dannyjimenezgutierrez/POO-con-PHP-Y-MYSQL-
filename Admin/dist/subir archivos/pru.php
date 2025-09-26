<?php
require 'Uploader.php';

$message = '';
$uploader = new Uploader();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    try {
        $path = $uploader->upload($_FILES['archivo']);
        $message = "Archivo subido correctamente: $path";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Obtener lista de archivos
$archivos = $uploader->listFiles();

// Extensiones de imagen
$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subir y visualizar archivos</title>
</head>
<body>
    <h1>Subir Archivo</h1>
    <?php if($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="archivo" required>
        <button type="submit">Subir</button>
    </form>

    <h2>Archivos subidos</h2>
    <?php if(count($archivos) > 0): ?>
        <ul>
            <?php foreach($archivos as $archivo): ?>
                <li>
                    <?php
                    $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    if (in_array($ext, $imageExtensions)):
                    ?>
                        <img src="<?= htmlspecialchars($archivo) ?>" alt="Imagen" width="100">
                    <?php endif; ?>
                    <a href="<?= htmlspecialchars($archivo) ?>" target="_blank"><?= basename($archivo) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay archivos subidos aún.</p>
    <?php endif; ?>

    <script>
    document.getElementById('uploadForm').addEventListener('submit', function() {
        setTimeout(() => {
            this.reset();
        }, 100);
    });
    </script>
</body>
</html>
