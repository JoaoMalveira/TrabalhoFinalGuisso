<?php
session_start ();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<header>
    <?php
include_once '../inc/cabecalho.php';
?>
</header>

<body>
    <div>
    <?php
    if (!isset($_SESSION['usuario'])) {
        // Se não estiver logado, vai aparecer o link do login
        echo'<a href="index.php">Faça o login para acessar o sistema</a>';
        exit(); // Encerra a execução do script
    } 
    else {
        $usuario = $_SESSION["usuario"] ?? "Visitante"; // Evita erro se a sessão não existir
        $admin = isset($_SESSION["admin"]) ? $_SESSION["admin"] : false;

        $variavel = <<<IDENTIFICADOR
    <h4>Bem vindo, $usuario!</h4>
    <div class="container-1">
        <a href="calendario.php" class="apa">Página de Reservas</a><br>
        <a href="listareserva.php" class="apa">Minhas Reservas</a><br>
        <?php if ($admin): ?>
        <a href="cadastrousuario.php" class="apa">Cadastro de Usuário</a>
        <a href="cadastroambiente.php" class="apa">Cadastro de Ambiente</a>
        <a href="gerenciarreservas.php" class="apa">Gerenciar Reservas</a>
    <?php endif; ?>
    </div>
IDENTIFICADOR;

        echo $variavel;
    }
    ?>
    </div>

</body>
<footer>
    <?php
    include "../inc/rodape.php";
    ?>
</footer>
</html>