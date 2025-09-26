<!-----------------------------------------------------------------------------------------------------------|
|------------------------------------------------------------------------------------------------------------|
| NOMBRE    :  DANNY JOSE JIMENEZ GUTIERREZ                                                                  |
| CEDULA    :  16.029.567                                                                                    |
| TELEFONO  :  0424-281-44-55                                                                                |
| CORREO    :  DENNALY88@GMAIL.COM                                                                           |
|------------------------------------------------------------------------------------------------------------|
|  SISTEMA    : PHP , POO , MYSQL                                                                            |
|  DESARROLLADOR WEB                                                                                         |
|  MIRANDA , CUA  2025                                                                                       |
-------------------------------------------------------------------------------------------------------------|
------------------------------------------------------------------------------------------------------------->
<?php

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
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->clave = htmlspecialchars(strip_tags($this->clave));

        
        $query = "SELECT clave, estado FROM " . $this->table_name . " WHERE usuario = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->usuario);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) {
            return -1; 
        }
        if ($fila['estado'] === 'Inactivo') {
            return -2; 
        }

        if ($this->clave === $fila['clave']) {
            return 1; 
        } else {
            return 0; 
        }
    }
}


$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);
$usuario->usuario = $_POST['usuario'];
$usuario->clave = $_POST['clave'];
$resultado = $usuario->validarCredenciales();


if ($resultado == 1) {
   
    header("Location: http://localhost/POO/Admin/dist/index.php");
    exit();
} elseif ($resultado == -1) {
    
    header("Location: ../index.html?error=usuario_no_encontrado");
    exit();
} elseif ($resultado == -2) {
    
    header("Location: ../index.html?error=usuario_inactivo");
    exit();
} elseif ($resultado == 0) {
   
    header("Location: ../index.html?error=clave_incorrecta");
    exit();
} else {
    
    header("Location: ../index.html?error=credenciales_invalidas");
    exit();
}
?>
