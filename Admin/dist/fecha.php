<?php
class FechaActual {
    // Método para obtener la fecha actual formateada
    public function imprimirFecha() {
        // Obtener la fecha actual en formato dd/mm/YYYY
        $fecha = date('d/m/Y');
        echo "Fecha: " . $fecha;
    }
}

// Crear una instancia de la clase
$fechaActual = new FechaActual();
// Llamar al método para imprimir la fecha
$fechaActual->imprimirFecha();
?>