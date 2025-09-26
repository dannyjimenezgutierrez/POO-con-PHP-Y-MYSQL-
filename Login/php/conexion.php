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
            echo "Conexión exitosa."; 
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

$database = new Database();
$db = $database->getConnection();

?>
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
