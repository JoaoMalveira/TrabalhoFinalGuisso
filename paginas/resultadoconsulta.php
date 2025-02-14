<?php
require '../inc/validacao.php';
require '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

if (isset($_POST['data'])) {
    $dataSelecionada = $_POST['data'];
    $dataExibicao = date('d/m/Y', strtotime($dataSelecionada));

    // Busca todas as reservas para a data selecionada
    $reservas = R::find('reservas', 'data = ?', [$dataSelecionada]);

    // Extrai os horários das reservas já feitas
    $horariosReservados = [];
    foreach ($reservas as $reserva) {
        $horariosReservados[] = $reserva->hora_inicio;
    }

    $horariosValidos = R::find('reservas'); // Tabela com horários válidos para reservas
    $horariosDisponiveis = [];
    
    // Extraindo todos os horários válidos
    foreach ($horariosValidos as $horarioValido) {
        $horariosDisponiveis[] = $horarioValido->hora;
    }

    // Filtra os horários disponíveis, removendo os já reservados
    $horariosDisponiveis = array_diff($horariosDisponiveis, $horariosReservados);

} else {
    // Se a data não foi enviada, redireciona para a página de consulta
    header('Location: consulta.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Consulta</title>
    <style>
        .horarios-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
        }

        .horario {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .disponivel {
            background-color: #d4ed9c; /* Verde claro */
        }
    </style>
</head>
<body>
<header>
    <?php include '../inc/cabecalho.php'; ?>
</header>

<div class="container">
    <h2>Resultados da Consulta</h2>

    <?php if (isset($dataSelecionada)): ?>
        <h3>Data Selecionada: <?php echo $dataExibicao; ?></h3>

        <?php if (empty($horariosDisponiveis)): ?>
            <p>Não há horários disponíveis para esta data.</p>
        <?php else: ?>
            <div class="horarios-container">
                <?php foreach ($horariosDisponiveis as $horario): ?>
                    <div class="horario disponivel">
                        <?php echo $horario; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>

<footer>
    <?php include '../inc/rodape.php'; ?>
</footer>

</body>
</html>
