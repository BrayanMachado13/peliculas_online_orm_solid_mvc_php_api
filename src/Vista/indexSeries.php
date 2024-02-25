<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Series</title>
</head>

<body>
    <header>
        <div class="container">
            <nav>
            <img src="../logo/Free_Sample_By_Wix.jpg" alt="">
                <ul>
                    <li><a href="index.php">Peliculas</a></li>
                    <li><a href="#">Series</a></li>
                    <form action="indexSeries.php" method="post">
                        <button type="submit" name="fetch_data_Series">Obtener Series</button>
                    </form>
                </ul>
            </nav>
        </div>
    </header>
    <div class="main-content">
        <div class="container">
            <h1>Series</h1>
            <div class="movie">
            <?php foreach ($series as $serie): ?>
                    <a href="detalle_peliculas.php?id=<?php echo $serie->id; ?>">
                        <div class="movie-card">
                            <img src="<?php echo $serie->imagen_principal; ?>" alt="<?php echo $serie->nombre; ?>">
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Series Online</p>
    </footer>
</body>

</html>
