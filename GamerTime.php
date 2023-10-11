<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>GamerTime</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container_nav">
            <h1>GAMER TIME</h1></br>
            <nav>
                <ul>
                    <li><a href="./Gamer/Arcade.php">Juegos</a></li>
                    <li><a href="News.php">Comentarios</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="banner">
        <div class="container">
            <h2>Sumergete en el </br>mundo de los juegos</h2>
            <a href="./Gamer/Arcade.php" class="btn-primary">Ver Juegos</a>
        </div>
    </section>
    
    <footer>
        <div class="container_foot">
            <p>&copy; <?php echo date('Y'); ?> Gamer Time</p>
            <p>CodigoJP</p>
        </div>
    </footer>
</body>
</html>