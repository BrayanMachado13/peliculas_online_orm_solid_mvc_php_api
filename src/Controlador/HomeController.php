<?php
namespace Controlador;

class HomeController
{
    public function index()
    {
        // Registro de una métrica de tiempo
        $start_time = microtime(true);
        // Realizar alguna operación
        sleep(2); // Simular una operación que tarda 2 segundos
        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;

        // Almacenar la métrica en un archivo de texto
        $file = 'metrics.txt';
        $data = "Tiempo de ejecución de la acción index(): $execution_time segundos\n";
        file_put_contents($file, $data, FILE_APPEND);

        // Lógica adicional del controlador
        // ...
    }
}

// Ejemplo de uso
$controller = new HomeController();
$controller->index();
