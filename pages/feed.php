<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->query('SELECT posts.*, usuarios.nome, usuarios.username FROM posts JOIN usuarios ON posts.usuario_id = usuarios.id ORDER BY data_postagem DESC');
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Feed</title>
    <link rel="stylesheet" href="feedpo.css">
</head>
<body>
<h1>Bem-vindo ao LURK</h1>

    <header>
    <nav>
    <ul>
        <li><a href="feed.php">Feed</a></li>
        <li><a href="/rede_social-main/pages/perfil.php?username=<?php echo $_SESSION['username']; ?>">Meu Perfil</a></li>
        <li><a href="post.php">Novo Post</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
    </header>
    <h1 class="feedp">Feed de Postagens</h1>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h2><a href="perfil.php?username=<?php echo $post['username']; ?>"><?php echo htmlspecialchars($post['nome']) . ' @' . htmlspecialchars($post['username']); ?></a></h2>
            <p><?php echo htmlspecialchars($post['conteudo']); ?></p>
            <small><?php echo $post['data_postagem']; ?></small>
            <form method="post" action="comentar.php">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <textarea name="conteudo" required></textarea>
                <button type="submit">Comentar</button>
            </form>
            <h3>Comentários:</h3>
            <?php
            $stmt = $pdo->prepare('SELECT comentarios.*, usuarios.nome, usuarios.username FROM comentarios JOIN usuarios ON comentarios.usuario_id = usuarios.id WHERE post_id = ? ORDER BY data_comentario DESC');
            $stmt->execute([$post['id']]);
            $comentarios = $stmt->fetchAll();
            ?>
            <?php foreach ($comentarios as $comentario): ?>
                <div class="comentario">
                    <strong><a href="perfil.php?username=<?php echo $comentario['username']; ?>"><?php echo htmlspecialchars($comentario['nome']) . ' @' . htmlspecialchars($comentario['username']); ?></a>:</strong>
                    <p><?php echo htmlspecialchars($comentario['conteudo']); ?></p>
                    <small><?php echo $comentario['data_comentario']; ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    <?php include '../includes/footer.php'; ?>
    <script src="../js/scripts.js"></script>
</body>
</html>