<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: pages/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #ccc;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 200px; 
        }

        .menu-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 300px;
            height: 100px;
            margin: 20px;
            padding: 10px;
            font-size: 24px;
            text-align: center;
            cursor: pointer;
            background-color: #022641; 
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .menu-button:hover {
            background-color: #022630;
        }

        .lurk {
            font-size: 50px;
            margin: 20px;
            font-style: italic;
        }

        .slurk {
            font-size: 80px;
            margin: 20px;
            font-style: italic;
            color: #022641;
        }

        .menu-button i {
            margin-right: 10px;
            font-size: 28px;
        }
    </style>
    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
</head>
<body>
    <h1 class="lurk" style="text-align: center;">Bem-vindo ao</h1>
    <hr>
    <h1 class="slurk">LURK</h1>
    <div class="button-container">
        <button class="menu-button" onclick="navigateTo('pages/feed.php')">
            <i class="fas fa-rss"></i> Feed
        </button>
        <button class="menu-button" onclick="navigateTo('pages/perfil.php?username=<?php echo $_SESSION['username']; ?>')">
            <i class="fas fa-user"></i> Meu Perfil
        </button>
        <button class="menu-button" onclick="navigateTo('pages/post.php')">
            <i class="fas fa-edit"></i> Novo Post
        </button>
        <button class="menu-button" onclick="navigateTo('pages/logout.php')">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </div>
</body>
</html>
