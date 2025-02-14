<?php
require '../inc/validacao.php'; // Inclui a validação de login
require '../class/rb.php'; // Inclui o RedBeanPHP
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', ''); // Configuração do banco de dados

// Processamento da pesquisa por data
if (isset($_POST['data_pesquisa'])) {
	$data_pesquisa = $_POST['data_pesquisa'];
	$reservas = R::find('reservas', 'data = ?', [$data_pesquisa]);
} else {
	$reservas = R::findAll('reservas'); // Busca todas as reservas
}

// Processamento da exclusão de reserva
if (isset($_POST['excluir_reserva'])) {
	$id_reserva_excluir = $_POST['id_reserva'];
	$reserva_excluir = R::load('reservas', $id_reserva_excluir);

	if ($reserva_excluir) {
		R::trash($reserva_excluir);
		$_SESSION['sucesso'] = "Reserva excluída com sucesso!";
	} else {
		$_SESSION['erro'] = "Erro ao excluir reserva.";
	}

	header("Location: gerenciarreservas.php"); // Recarrega a página para atualizar a lista
	exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gerenciar Reservas</title>
	<link rel="stylesheet" href="../css/style.css">
	<style>
		table {
			width: 100%;
			max-width: 100%;
			border-collapse: collapse;
			overflow-x: auto;
			display: block;
		}

		th,
		td {
			padding: 8px;
			border: 1px solid #ddd;
			text-align: left;
		}

		th {
			background-color: #f2f2f2;
		}

		.excluir-btn {
			background-color: #f44336;
			color: white;
			padding: 6px 10px;
			border: none;
			cursor: pointer;
		}

		.excluir-btn:hover {
			background-color: #d32f2f;
		}
	</style>
</head>

<header>
	<?php include '../inc/cabecalho.php'; ?>
</header>

<body>
	<div class="container-1">
		<h2>Gerenciar Reservas</h2>

		<form method="post">
			<label for="data_pesquisa">Pesquisar por data:</label>
			<input type="date" name="data_pesquisa" id="data_pesquisa">
			<button type="submit">Pesquisar</button>
		</form>

		<?php
		if (isset($_SESSION['erro'])) {
			echo "<div class='alerta erro'>" . $_SESSION['erro'] . "</div>";
			unset($_SESSION['erro']);
		} elseif (isset($_SESSION['sucesso'])) {
			echo "<div class='alerta sucesso'>" . $_SESSION['sucesso'] . "</div>";
			unset($_SESSION['sucesso']);
		}
		?>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Data</th>
					<th>Tipo</th>
					<th>Ambiente</th>
					<th>Usuário</th>
					<th>Hora de Início</th>
					<th>Hora de Término</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($reservas as $reserva):
					$usuario = R::load('usuarios', $reserva->usuario_id);
				?>
					<tr>
						<td><?php echo $reserva->id; ?></td>
						<td><?php echo date('d/m/Y', strtotime($reserva->data)); ?></td>
						<td><?php echo $reserva->tipo; ?></td>
						<td><?php echo $reserva->nome_ambiente; ?></td>
						<td><?php echo $usuario->nome; ?></td>
						<td><?php echo $reserva->hora_inicio; ?></td>
						<td><?php echo $reserva->hora_fim; ?></td>
						<td>
							<form method="post" style="display: inline;">
								<input type="hidden" name="id_reserva" value="<?php echo $reserva->id; ?>">
								<button type="submit" name="excluir_reserva" class="excluir-btn">Excluir</button>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>

<footer>
	<?php include "../inc/rodape.php"; ?>
</footer>

</html>