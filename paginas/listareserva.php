<?php
require '../inc/validacao.php'; // Inclui a validação de login
require_once '../class/rb.php';
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

		<?php if (empty($reservas)) { ?>
			<p>Você ainda não fez nenhuma reserva.</p>
		<?php } else { ?>
			<table>
				<thead>
					<tr>
						<th>Imagem</th>
						<th>Data</th>
						<th>Tipo</th>
						<th>Ambiente</th>
						<th>Nome Ambiente</th>
						<th>Nome </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($reservas as $reserva) { ?>
						<tr>
							<td>
								<img src="<?php echo '../bd/imgs/' . $reserva->imagem_ambiente; ?>" alt="Imagem do ambiente">
							</td>
							<td><?php echo date('d/m/Y', strtotime($reserva->data)); ?></td>
							<td><?php echo $reserva->tipo; ?></td>
							<td><?php echo $reserva->ambiente_id; ?></td>
							<td><?php echo $reserva->nome_ambiente; ?></td>
							<td><?php echo $reserva->nome; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>

		<button onclick="window.location.href='home.php'">Voltar</button>
	</div>
</body>
<br>

<br>
<footer>
	<?php include "../inc/rodape.php"; ?>
</footer>

</html>