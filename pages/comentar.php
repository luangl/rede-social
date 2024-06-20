<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conteudo = $_POST['conteudo'];
    $post_id = $_POST['post_id'];
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $pdo->prepare('INSERT INTO comentarios (post_id, usuario_id, conteudo) VALUES (?, ?, ?)');
    $stmt->execute([$post_id, $usuario_id, $conteudo]);

    $stmt = $pdo->prepare('SELECT usuario_id FROM posts WHERE id = ?');
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();
    
    header('Location: perfil.php?id=' . $post['usuario_id']);
    exit();
}
?>
