<?php
require '../inc/validacao.php';
require '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

// Verifica se há uma data informada, senão redireciona para o calendário
if (!isset($_POST["data"]) || empty($_POST["data"])) {
    header("Location: calendario.php");
    exit();
}
$dataSelecionada = $_POST["data"];
$tipoSelecionado = $_POST["tipo"] ?? "";

// Busca os tipos de ambientes no banco
$tipos = R::getCol('SELECT DISTINCT tipo FROM ambientes ORDER BY tipo ASC');

// Busca os ambientes caso um tipo já tenha sido selecionado
$ambientes = [];
if (!empty($tipoSelecionado)) {
    $ambientes = R::find('ambientes', 'tipo = ?', [$tipoSelecionado]);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .data-box {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        select, button {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #dc3545;
        }

        .back-button:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
	<header>
		<?php include '../inc/cabecalho.php'; ?>
	</header>
<br>
<div class="container">
    <h2>Reserva de Ambiente</h2>

    <!-- Exibir a data selecionada (não editável) -->
    <div class="data-box">Data Selecionada: <?php echo date("d/m/Y", strtotime($dataSelecionada)); ?></div>

    <button class="back-button" onclick="window.location.href='calendario.php'">Voltar</button>

    <!-- Formulário para selecionar tipo e ambiente -->
    <form action="reserva.php" method="POST">
        <input type="hidden" name="data" value="<?php echo $dataSelecionada; ?>">

        <label for="tipo">Escolha o Tipo de Ambiente:</label>
        <select id="tipo" name="tipo" required onchange="this.form.submit()">
            <option value="">Selecione um tipo</option>
            <?php foreach ($tipos as $tipo) { ?>
                <option value="<?php echo $tipo; ?>" <?php echo ($tipo == $tipoSelecionado) ? 'selected' : ''; ?>>
                    <?php echo $tipo; ?>
                </option>
            <?php } ?>
        </select>
    </form>

    <?php if (!empty($tipoSelecionado)) { ?>
        <form action="../bd/reservabd.php" method="POST">
            <input type="hidden" name="data" value="<?php echo $dataSelecionada; ?>">
            <input type="hidden" name="tipo" value="<?php echo $tipoSelecionado; ?>">

            <label for="ambiente">Escolha um Ambiente:</label>
            <select id="ambiente" name="ambiente" required>
                <option value="">Selecione um ambiente</option>
                <?php foreach ($ambientes as $ambiente) { ?>
                    <option value="<?php echo $ambiente->id; ?>"><?php echo $ambiente->nome; ?></option>
                <?php } ?>
            </select>

            <button type="submit">Reservar</button>
        </form>
    <?php } ?>
</div>
<footer>
<?php 
require '../inc/rodape.php';
 ?>
</footer>
</body>
</html>
