<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
<?php
include '../inc/cabecalho.php';
?>
</header>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form method="POST" action="../bd/userbd.php">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="fullname">Nome Completo:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="Senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="admin">Admin:
                <input type="checkbox" id="admin" name="admin">
            </label>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
<footer>
    <?php
        include "../inc/rodape.php"

    ?>
    </footer>
</html>
