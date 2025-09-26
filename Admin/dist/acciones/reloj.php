
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
class Reloj
{
    private DateTime $hora;

    public function __construct(string $zonaHoraria)
    {
        try {
            
            $tz = new DateTimeZone($zonaHoraria);
            
    
            $this->hora = new DateTime('now', $tz);
        } catch (Exception $e) {
        
            echo "Aviso: Zona horaria '$zonaHoraria' no válida. Usando hora local del servidor.\n";
            $this->hora = new DateTime(); 
        }
    }

   
    public function mostrarHora(string $formato = 'H:i:s'): string
    {
       
        return $this->hora->format($formato);
    }

   
    public function obtenerZonaHoraria(): string
    {
        return $this->hora->getTimezone()->getName();
    }
}


$zona_horaria = 'America/Caracas'; 


$miReloj = new Reloj($zona_horaria);


$hora_12h = $miReloj->mostrarHora('h:i:s A');
echo "Hora :" .$hora_12h. "<br>";

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