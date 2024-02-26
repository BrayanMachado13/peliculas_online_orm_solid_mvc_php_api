<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Peliculas</title>
</head>

<body>
    <header>
        <div class="container">
            <nav>
            <img src="../logo/Free_Sample_By_Wix.jpg" alt="">
                <ul>
                    
                    <li><a href="">Inicio</a></li>
                    <li><a href="indexSeries.php">Series</a></li>
                    <li><a href="/peliculas">Películas</a></li>
                    <form action="index.php" method="post">
                        <button type="submit" name="fetch_data">Obtener Peliculas</button>
                    </form>
                </ul>
            </nav>
        </div>
    </header>
    <div class="main-content">
        <div class="container">
            <h1>Películas</h1>
            <div class="movie">
            <?php foreach ($peliculas as $pelicula): ?>
                    <a href="verpelicula.php?id=<?php echo $pelicula->id; ?>&tipo=pelicula">
                        <div class="movie-card">
                            <img src="<?php echo $pelicula->imagen_principal; ?>" alt="<?php echo $pelicula->titulo; ?>">
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Peliculas Online</p>
    </footer>
</body>

</html>
