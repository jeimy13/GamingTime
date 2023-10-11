<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamerTime - News</title>
    <link rel="stylesheet" href="news.css">
</head>
<body>
<body>
    <header>
        <h1>Comentarios</h1>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="./GamerTime.php">Inicio</a></li>
                    <li><a href="./Gamer/Arcade.php">Juegos</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="comentario-form">
        <div class="container">
            <h2>Deja un Comentario</h2>
            <form id="commentForm">
                <input type="text" id="nombre" placeholder="Nombre / Apodo" required>
                <textarea id="comentario" placeholder="Escribe tu comentario" required></textarea>
                <button type="submit">Publicar</button>
            </form>
        </div>
    </section>
    <section class="comentarios">
        <div class="container">
            <h2>Comentarios Recientes</h2>
            <ul id="commentList">
                <!-- Los comentarios se cargarán aquí dinámicamente -->
            </ul>
        </div>
    </section>
    <script src="scriptNews.js"></script>
</body>
</html>