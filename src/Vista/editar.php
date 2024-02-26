<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Película</title>
    <link rel="stylesheet" href="../css/editar.css">
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
        <h1>Editar Película</h1>
        <form action="crud.php?accion=actualizar&id=<?php echo $pelicula->id; ?>" method="POST">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $pelicula->titulo; ?>" required>
            </div>
            <div class="form-group">
                <label for="sinopsis">Sinopsis:</label>
                <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3" required><?php echo $pelicula->sinopsis; ?></textarea>
            </div>
            <div class="form-group">
                <label for="imagen_principal">URL Imagen:</label>
                <input type="text" class="form-control" id="imagen_principal" name="imagen_principal" value="<?php echo $pelicula->imagen_principal; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
