<?php
class Uploader {
    private string $targetDir;
    private array $allowedTypes;

    public function __construct(string $targetDir = "uploads/", array $allowedTypes = ["image/jpeg", "image/png", "application/pdf"]) {
        $this->targetDir = rtrim($targetDir, '/') . '/';
        $this->allowedTypes = $allowedTypes;

        // Crear carpeta si no existe
        if (!is_dir($this->targetDir)) {
            mkdir($this->targetDir, 0755, true);
        }
    }

    public function upload(array $file): string {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Error al subir el archivo.");
        }

        if (!in_array($file['type'], $this->allowedTypes)) {
            throw new Exception("Tipo de archivo no permitido.");
        }

        $filename = time() . '_' . basename($file['name']);
        $targetFile = $this->targetDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            throw new Exception("No se pudo mover el archivo. Verifica permisos y rutas.");
        }

        return $targetFile;
    }

    // Listar archivos
    public function listFiles(): array {
        $files = array_diff(scandir($this->targetDir), ['.', '..']);
        return array_map(fn($f) => $this->targetDir . $f, $files);
    }
}
