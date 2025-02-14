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


if (isset($_SESSION['usuarios_id'])) {
    $logado = true;
    $user = R::load('usuarios', $_SESSION['usuarios_id']);
    $usuario = $user->nome;
    $admin = $user->admin == 1; // Define $admin aqui, após carregar os dados do usuário
} else {
    $logado = false;
    $admin = false; // Define $admin como false para usuários não logados
}
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
    <div style="background-color: burlywood;">

        <div class="container-1">
            <?php if ($logado): ?>
                <fieldset>
                    <p>Bem vindo, <?php echo $usuario; ?>!</p>
                </fieldset>
                <a href="calendario.php">Faça sua reserva</a>
                <a href="consulta.php">Consulta de datas e horários</a>
                <a href="listareserva.php">Minhas Reservas</a>
                <?php if ($admin): ?>
                    <a href="controleusuario.php">Controle de Usuários</a>
                    <a href="controleambiente.php">Controle de Ambientes</a>
                    <a href="gerenciarreservas.php">Gerenciar Reservas</a>
                <?php endif; ?>
            <?php else: ?>
               <p><a href="index.php">Faça login para entrar no sistema</a></p>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <div style="background-color: burlywood;">
        <br>
        <br>
        <h2 class="mensagem">Desça a página para visualizar os nossos ambientes de aprendizado</h2>
        <h3>Salas</h3>
        <div class="ambiente-container">
            <?php foreach ($salas as $sala) { ?>
                <div class="card" style="background-color: gray;">
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
                <div class="card" style="background-color: gray">
                    <img src="<?php echo '../bd/imgs/' . $laboratorio->imagem; ?>" alt="Imagem do laboratório">
                    <h3><?php echo $laboratorio->nome; ?></h3>
                    <p><?php echo $laboratorio->descricao; ?></p>
                </div>
            <?php } ?>
        </div>
        <br>
        <br>
        <?php 
        if (isset($_SESSION['negado'])) {
            echo "<div class='alerta erro'>" . $_SESSION['negado'] . "</div>";
            unset($_SESSION['negado']); // Apaga a mensagem após exibir
        }
        ?>
    </div>
</body>
<footer>
    <?php include "../inc/rodape.php"; ?>
</footer>

</html>