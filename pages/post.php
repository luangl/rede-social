<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conteudo = $_POST['conteudo'];
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $pdo->prepare('INSERT INTO posts (usuario_id, conteudo) VALUES (?, ?)');
    $stmt->execute([$usuario_id, $conteudo]);

    header('Location: feed.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Post</title>
    <link rel="stylesheet" href="feedpo.css">
</head>
<body>
<header>
<h1>LURK</h1>
    <nav>
    <ul>
        <li><a href="feed.php">Feed</a></li>
        <li><a href="/rede_social-main/pages/perfil.php?username=<?php echo $_SESSION['username']; ?>">Meu Perfil</a></li>
        <li><a href="post.php">Novo Post</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
    </header>
    <h1>Criar Nova Postagem</h1>
    <form method="post">
        <label for="conteudo">Conteúdo:</label>
        <textarea id="conteudo" name="conteudo" required></textarea>
        <button type="submit">Postar</button>
    </form>
</body>
</html>
