<?php

// Incluir el archivo de la clase de conexión a la base de datos
include_once 'conexion.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $usuario;
    public $clave;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validarCredenciales() {
        // Sanear los datos para evitar inyección SQL
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->clave = htmlspecialchars(strip_tags($this->clave));

        // Modifica la consulta para seleccionar también la columna 'estado'
        $query = "SELECT clave, estado FROM " . $this->table_name . " WHERE usuario = ? LIMIT 0,1";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular el valor del usuario
        $stmt->bindParam(1, $this->usuario);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el registro
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validar si el usuario existe
        if (!$fila) {
            return -1; // Retorna -1 si el usuario no existe
        }

        // Verifica si el usuario está inactivo basándose en el valor de la columna 'estado'
        if ($fila['estado'] === 'Inactivo') {
            return -2; // Retorna -2 si el usuario está inactivo
        }

        // Si el usuario existe y está activo, se verifica la clave
        // Usa password_verify si las claves están hasheadas (RECOMENDADO)
        // if (password_verify($this->clave, $fila['clave'])) {
        //     return 1; // Retorna 1 si la clave es correcta
        // }

        // MANTÉN ESTA LÍNEA SOLO SI TUS CLAVES ESTÁN EN TEXTO PLANO
        if ($this->clave === $fila['clave']) {
            return 1; // Retorna 1 si la clave es correcta
        } else {
            return 0; // Retorna 0 si la clave es incorrecta
        }
    }
}

// ------ Lógica de validación ------

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);
$usuario->usuario = $_POST['usuario'];
$usuario->clave = $_POST['clave'];

$resultado = $usuario->validarCredenciales();

// Manejar los diferentes resultados
if ($resultado == 1) {
    // Caso 1: Credenciales correctas
    header("Location: http://localhost/POO/Admin/dist/index.php");
    exit();
} elseif ($resultado == -1) {
    // Caso 2: El usuario no existe
    header("Location: index.html?error=usuario_no_encontrado");
    exit();
} elseif ($resultado == -2) {
    // Nuevo caso: El usuario está inactivo
    header("Location: index.html?error=usuario_inactivo");
    exit();
} elseif ($resultado == 0) {
    // Caso 3: La clave es incorrecta
    header("Location: index.html?error=clave_incorrecta");
    exit();
} else {
    // Si ambas son incorrectas o hay un error genérico
    header("Location: index.html?error=credenciales_invalidas");
    exit();
}
?>