<?php
session_start();
require_once '../class/rb.php'; // Inclui a configuração do banco de dados
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', ''); // Configuração do banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarios_id'])) {
    // Redireciona para a página de login com uma mensagem de erro
    header('Location: index.php?erro=' . urlencode("Você precisa fazer login para acessar o sistema."));
    exit();
}

if (isset($_GET['erro'])) {
    $mensagem = urldecode($_GET['erro']);
    echo "<p style='color: red;'>$mensagem</p>";
}


// Busca o nome do usuário no banco de dados
$user = R::load('usuarios', $_SESSION['usuarios_id']);
$usuario = $user->nome; // Ou $user->usuario, se preferir o nome de usuário

$admin = isset($_SESSION["admin"]) ? $_SESSION["admin"] : false; // Mantém a verificação de admin

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
    <?php include_once '../inc/cabecalho.php'; ?>
</header>
<body>
    <div>
        <h4>Bem vindo, <?php echo $usuario; ?>!</h4>
        <div class="container-1">
            <a href="calendario.php" class="apa">Página de Reservas</a>
            <a href="listareserva.php" class="apa">Minhas Reservas</a>
            <a href="controleusuario.php" class="apa">Controle de Usuários</a>
            <a href="cadastroambiente.php" class="apa">Cadastro de Ambiente</a>
            <a href="gerenciarreservas.php">Gerenciar Reservas</a>
        </div>
    </div>
</body>
<footer>
    <?php include "../inc/rodape.php"; ?>
</footer>
</html>