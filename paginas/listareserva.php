<?php
require '../inc/validacao.php'; // Inclui a validação de login
require_once '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

$usuario_id = $_SESSION['usuarios_id'];

// Busca as reservas do usuário logado.  Usando findAll para garantir um array
$reservas = R::findAll('reservas', 'usuario_id = ?', [$usuario_id]);

// Se não houver reservas, inicializa $reservas como um array vazio para evitar o erro "Invalid argument supplied for foreach()"
if (empty($reservas)) {
    $reservas = [];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<header>
    <?php include_once '../inc/cabecalho.php'; ?>
</header>

<body>
    <div class="container">
        <h2>Minhas Reservas</h2>
        <?php if (empty($reservas)): ?>
            <p>Você ainda não fez nenhuma reserva.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Ambiente</th>
                        <th>Hora de Início</th>
                        <th>Hora de Término</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva):
                        $usuario = R::load('usuarios', $reserva->usuario_id);
                        if ($usuario): // Verifica se o usuário foi encontrado antes de exibir o nome
                    ?>
                        <tr>
                            <td><?php echo $reserva->id; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($reserva->data)); ?></td>
                            <td><?php echo $reserva->tipo; ?></td>
                            <td><?php echo $reserva->nome_ambiente; ?></td>
                            <td><?php echo $reserva->hora_inicio; ?></td>
                            <td><?php echo $reserva->hora_fim; ?></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva->id; ?>">
                                </form>
                            </td>
                        </tr>
                    <?php 
                        endif; // Fim do if ($usuario)
                    endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
<br>

<br>
<footer>
    <?php include "../inc/rodape.php"; ?>
</footer>

</html>