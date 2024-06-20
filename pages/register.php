<?php
include '../includes/db.php';

$username_error = '';
$email_error = '';
$nome = '';
$email = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $username = $_POST['username'];

    // Verificação do username
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $username_error = "Nome de usuário já existe. Por favor escolha outro.";
    } else {
        // Verificação do email
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $email_error = "Email já cadastrado. Por favor confira.";
        } else {
            // Inserção do novo usuário
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha, username) VALUES (?, ?, ?, ?)');
            $stmt->execute([$nome, $email, $password, $username]);

            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="register.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php if ($username_error): ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $username_error; ?>',
            });
        </script>
    <?php endif; ?>

    <?php if ($email_error): ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $email_error; ?>',
            });
        </script>
    <?php endif; ?>

    <form method="post">
        <h1>Cadastro</h1>
        <h1 id="lurk">LURK</h1>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <label for="username">Nome de usuário:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
