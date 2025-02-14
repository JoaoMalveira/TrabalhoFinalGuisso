<?php
require '../inc/validacao.php';
require '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

// Inicializa $dataSelecionada para evitar o aviso
$dataSelecionada = null;

// Verifica se há uma data informada, senão redireciona para o calendário
if (isset($_POST["data"]) && !empty($_POST["data"])) {
    $dataSelecionada = $_POST["data"];
} else {
    header("Location: calendario.php");
    exit();
}

$tipoSelecionado = $_POST["tipo"] ?? "";

$tipos = R::getCol('SELECT DISTINCT tipo FROM ambientes ORDER BY tipo ASC');

$ambientes = [];
$ambiente = null;

if (!empty($tipoSelecionado)) {
    $ambientes = R::find('ambientes', 'tipo = ?', [$tipoSelecionado]);
    if (!empty($ambientes)) {
        $ambiente = reset($ambientes);
    }
}

$horaInicio = $_POST["hora_inicio"] ?? "";
$horaFim = $_POST["hora_fim"] ?? "";
?>



<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <style>
        /* ... (Seus estilos CSS) ... */
    </style>
</head>

<body>
    <header>
        <?php include '../inc/cabecalho.php'; ?>
    </header>
    <br>
    <div class="container">
        <h2>Reserva de Ambiente</h2>

        <div class="data-box">Data Selecionada: <?php echo date("d/m/Y", strtotime($dataSelecionada)); ?></div>

        <button class="back-button" onclick="window.location.href='calendario.php'">Voltar</button>

        <form name="form_tipo" action="reserva.php" method="POST">
            <input type="hidden" name="data" value="<?php echo $dataSelecionada; ?>">

            <label for="tipo">Escolha o Tipo de Ambiente:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Selecione um tipo</option>
                <?php foreach ($tipos as $tipo) { ?>
                    <option value="<?php echo $tipo; ?>" <?php echo ($tipo == $tipoSelecionado) ? 'selected' : ''; ?>>
                        <?php echo $tipo; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <?php if (!empty($tipoSelecionado)) { ?>
            <form name="reservateste" action="../bd/reservabd.php" method="POST">
                <input type="hidden" name="data" value="<?php echo $dataSelecionada; ?>">
                <input type="hidden" name="tipo" value="<?php echo $tipoSelecionado; ?>">
                <label for="ambiente">Escolha o Ambiente:</label>
                <select id="ambiente" name="ambiente_id" required>
                    <option value="">Selecione um ambiente</option>
                    <?php foreach ($ambientes as $ambiente_item) { ?> <option value="<?php echo $ambiente_item->id; ?>"> <?php echo $ambiente_item->nome; ?> </option>
                    <?php } ?>
                </select>
                <label for="hora_inicio">Hora de Início:</label>
                <input type="time" id="hora_inicio" name="hora_inicio" required value="<?php echo $horaInicio; ?>">

                <label for="hora_fim">Hora de Término:</label>
                <input type="time" id="hora_fim" name="hora_fim" required value="<?php echo $horaFim; ?>">

                <button type="submit">Reservar</button>
            </form>

        <?php } ?>
    </div>
    <br>
    <br>
    <br>
    
    <footer>
        <?php require '../inc/rodape.php'; ?>
    </footer>
</body>

</html>