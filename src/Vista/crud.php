<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../css/crud.css">
    
</head>
<body>
    <header>
        <div class="container2">
            <nav>
            <img src="../logo/Free_Sample_By_Wix.jpg" alt="">
                <ul>  
                    <li><a href="">Inicio</a></li>
                    <li><a href="indexSeries.php">Series</a></li>
                    <li><a href="index.php">Películas</a></li>
                    <li><a href="crud.php">crud</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <a href="?accion=crear" class="btn btn-primary mb-3">Nueva película</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Sinopsis</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula): ?>
                    <tr>
                        <td><?php echo $pelicula->id; ?></td>
                        <td><?php echo $pelicula->titulo; ?></td>
                        <td><?php echo $pelicula->sinopsis; ?></td>
                        <td><img src="<?php echo $pelicula->imagen_principal; ?>" alt="Imagen de la película" style="max-width: 100px; max-height: 100px;"></td>
                        <td>
                            <a href="?accion=editar&id=<?php echo $pelicula->id; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <br><br>
                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?php echo $pelicula->id ?>)">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
    function confirmarEliminar(id) {
        if (confirm('¿Estás seguro de que quieres eliminar esta película?')) {
            window.location.href = 'crud.php?accion=eliminar&id=' + id;
        }
    }
</script>
</body>
</html>
