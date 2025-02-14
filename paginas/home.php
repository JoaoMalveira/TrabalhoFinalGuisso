<?php
session_start();
require_once '../class/rb.php'; // Inclui a configuração do banco de dados
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', ''); // Configuração do banco de dados


if (isset($_GET['erro'])) {
    $mensagem = urldecode($_GET['erro']);
    echo "<p style='color: red;'>$mensagem</p>";
}

$salas = R::find('ambientes', 'tipo = ?', ['Sala']);
$laboratorios = R::find('ambientes', 'tipo = ?', ['Laboratório']);




if (isset($_SESSION['usuarios_id'])) {
    $logado = true;

    $user = R::load('usuarios', $_SESSION['usuarios_id']);
    $usuario = $user->nome; // Ou $user->usuario, se preferir o nome de usuário
} else {
    $logado = false;
}



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

        <div class="container-1">
            <?php if ($logado): ?>
                <fieldset>
                    <p>Bem vindo, <?php echo $usuario; ?>!</p>
                </fieldset>
                <a href="Página de Reservas">Página de Reservas</a><br>
                <a href="Minhas Reservas">Minhas Reservas</a><br>
                <a href="Controle de Usuários">Controle de Usuários</a><br>
                <a href="Cadastro de Ambiente">Cadastro de Ambiente</a><br>
                <a href="Gerenciar Reservas">Gerenciar Reservas</a><br>
            <?php else: ?>
                Faça<a href="index.php"> Login </a>para entrar no sistema.
            <?php endif; ?>
        </div>
    </div>
    </div>
    <h2 class="mensagem">Desça a página para visualizar os nossos ambientes de aprendizado</h2>
    <h3>Salas</h3>
    <div class="ambiente-container">
        <?php foreach ($salas as $sala) { ?>
            <div class="card">
                <img src="<?php echo '../bd/imgs/' . $sala->imagem; ?>" alt="Imagem da sala">
                <h3><?php echo $sala->nome; ?></h3>
                <p><?php echo $sala->descricao; ?></p>
            </div>
        <?php } ?>
    </div>
    <br>
    <br>
    <h3>Laboratórios</h3>
    <div class="ambiente-container">
        <?php foreach ($laboratorios as $laboratorio) { ?>
            <div class="card">
                <img src="<?php echo '../bd/imgs/' . $laboratorio->imagem; ?>" alt="Imagem do laboratório">
                <h3><?php echo $laboratorio->nome; ?></h3>
                <p><?php echo $laboratorio->descricao; ?></p>
            </div>
        <?php } ?>
    </div>
</body>
<footer>
    <?php include "../inc/rodape.php"; ?>
</footer>

</html>