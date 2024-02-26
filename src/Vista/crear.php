<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Película</title>
    <link rel="stylesheet" href="../css/crear.css">
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
        <h1>Nueva Película</h1>
        <form method="POST" action="crud.php?accion=guardar">
            <div class="form-group">
                <label for="idpelicula">ID Pelicula:</label>
                <input type="text" class="form-control" id="idpelicula" name="idpelicula" required>
            </div>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="sinopsis">Sinopsis:</label>
                <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagen_principal">URL Imagen:</label>
                <input type="text" class="form-control" id="imagen_principal" name="imagen_principal" required>
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div>
</body>
</html>
