<?php
// Elegir zona horaria: 1 = México, 2 = Tokio, 3 = Londres
$opcion = 2; // Cambia este número para probar otras zonas

switch ($opcion) {
    case 1:
        date_default_timezone_set('America/Mexico_City');
        $zona = "Ciudad de México";
        break;
    case 2:
        date_default_timezone_set('Asia/Tokyo');
        $zona = "Tokio";
        break;
    case 3:
        date_default_timezone_set('Europe/Madrid');
        $zona = "Londres";
        break;
    default:
        echo "Opción inválida\n";
        exit;
}

// Obtener hora en la zona seleccionada
$hora = (int)date("H");

// Determinar mensaje según la hora
if ($hora < 12) {
    $mensaje = "Buenos días";
} elseif ($hora >= 19) {
    $mensaje = "Buenas noches";
} else {
    $mensaje = "Buenas tardes";
}

echo "Hora en $zona: " . date("H:i:s") . " → $mensaje\n";
?>
