<!DOCTYPE html>
<html>
<head>
    <title>404 Not found</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="/public/styles/style.css" rel="stylesheet">
    <link href="/public/styles/activation.css" rel="stylesheet">
    <script src="/public/scripts/script.js"></script>
</head>
<body>
<header>
    <a id="camagru" href="/">Camagru</a>
    <a id="open_menu" onclick="open_menu();">
        <i class="fas fa-bars"></i>
    </a>
    <a id="close_menu" onclick="close_menu()">
        <i class="fas fa-times"></i>
    </a>
    <ul class="menu">
        <?php if ($_SESSION['user']):?>
            <a href="/"><li>Home</li></a>
            <a href="/profile"><li>Profile</li></a>
            <a href="/add_picture"><li>Add picture</li></a>
            <a href="/edit"><li>Edit profile</li></a>
            <a href="/logout"><li>Log out</li></a>
        <?php else: ?>
            <a href="/"><li>Home</li></a>
            <a href="/enter"><li>Log in / Sign up</li></a>
        <?php endif; ?>
    </ul>
</header>

<main>
    <div id="activation">
        <p>Ooooops! Page not found :(</p>
        <a href="/"><button>Go home</button></a>
    </div>
</main>

<footer>
    <p>anaumenk</p>
</footer>
</body>
</html>