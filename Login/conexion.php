<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'Curso_php';
    private $username = 'danny';
    private $password = 'Danny16029567*';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            echo "Conexión exitosa."; // Mensaje para verificar la conexión
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// ------ Código adicional para ejecutar la conexión ------

// Crea una instancia de la clase Database
$database = new Database();

// Llama al método getConnection() para intentar la conexión
$db = $database->getConnection();

?>

