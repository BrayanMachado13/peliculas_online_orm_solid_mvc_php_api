<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ver_pelicula.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ver Película</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php"><i class="bi bi-backspace-fill"></i> Atras</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-content">
        <div class="container">
            <h1>Ver Película</h1>
            <?php if ($videoUrl): ?>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/<?php echo $videoUrl; ?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
                </div>
            <?php else: ?>
                <p>El video no está disponible.</p>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Peliculas Online</p>
    </footer>
</body>

</html>