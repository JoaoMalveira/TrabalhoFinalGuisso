<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <?php
    include '../inc/cabecalho.php';

    ?>
</header>

<body>
    <div class="container-2">
        <h2>Login</h2>
        <form method="POST" action="../inc/login.php">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" name="login">Entrar</button>
        </form>
    </div>
    <?php 
        if (isset($_SESSION['negado'])) {
            echo "<div class='alerta erro'>" . $_SESSION['negado'] . "</div>";
            unset($_SESSION['negado']); // Apaga a mensagem após exibir
        }
        ?>
</body>
<footer>
    <?php
    include '../inc/rodape.php';
    ?>
</footer>

</html>