<?php

// URL de tu página
$url = 'http://localhost/peliculas-online/public/index.php';

// Número de usuarios simulados
$numUsers = 1000;

// Función para realizar la petición cURL
function makeRequest($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}

// Iniciar múltiples procesos para simular usuarios
$mh = curl_multi_init();
$curlHandlers = [];
for ($i = 0; $i < $numUsers; $i++) {
    $curlHandlers[$i] = curl_init();
    curl_setopt($curlHandlers[$i], CURLOPT_URL, $url);
    curl_setopt($curlHandlers[$i], CURLOPT_RETURNTRANSFER, true);
    curl_multi_add_handle($mh, $curlHandlers[$i]);
}

// Ejecutar las solicitudes simultáneamente
$active = null;
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

// Esperar a que todos los procesos terminen
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) == -1) {
        usleep(1);
    }
    do {
        $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
}

// Cerrar los manejadores
foreach ($curlHandlers as $ch) {
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
}
curl_multi_close($mh);

echo "Simulación completada.";
