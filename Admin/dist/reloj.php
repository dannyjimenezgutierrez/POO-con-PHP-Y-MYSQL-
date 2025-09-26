<?php


class Reloj
{
    /**
     * @var DateTime El objeto principal para manejar la fecha y hora.
     */
    private DateTime $hora;

    /**
     * Constructor de la clase.
     * Inicializa la hora actual basándose en la zona horaria provista.
     *
     * @param string $zonaHoraria El identificador de la zona horaria (ej: 'America/Santiago').
     */
    public function __construct(string $zonaHoraria)
    {
        try {
            // Crea un objeto DateTimeZone para configurar la zona horaria
            $tz = new DateTimeZone($zonaHoraria);
            
            // Crea el objeto DateTime con la hora actual y la zona horaria.
            $this->hora = new DateTime('now', $tz);
        } catch (Exception $e) {
            // Manejo de error: si la zona horaria no es válida, usa la hora por defecto.
            echo "Aviso: Zona horaria '$zonaHoraria' no válida. Usando hora local del servidor.\n";
            $this->hora = new DateTime(); 
        }
    }

    /**
     * Obtiene la hora actual formateada.
     *
     * @param string $formato El formato deseado (ej: 'H:i:s', 'h:i A').
     * @return string La cadena de texto con la hora formateada.
     */
    public function mostrarHora(string $formato = 'H:i:s'): string
    {
        // El método format() de DateTime se encarga de convertir el objeto
        // en la cadena de texto con el formato especificado.
        return $this->hora->format($formato);
    }

    /**
     * Obtiene la zona horaria actual de este objeto.
     *
     * @return string El nombre de la zona horaria.
     */
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
