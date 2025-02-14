<?php
require '../inc/validacao.php'; // Inclui a validação de login
require '../inc/validaadmin.php'; // Inclui a validação de admin

// Processamento da exclusão de ambiente
if (isset($_POST['excluir_ambiente'])) {
	$id_ambiente_excluir = $_POST['id_ambiente'];
	$ambiente_excluir = R::load('ambientes', $id_ambiente_excluir);

	if ($ambiente_excluir) {
		// Exclui o arquivo de imagem do ambiente
		unlink("imgs/" . $ambiente_excluir->imagem);

		R::trash($ambiente_excluir);
		$_SESSION['sucesso'] = "Ambiente excluído com sucesso!";
	} else {
		$_SESSION['erro'] = "Erro ao excluir ambiente.";
	}

	header("Location: ../paginas/gerenciarambientes.php"); // Recarrega a página para atualizar a lista
	exit();
}

// Busca todos os ambientes
$ambientes = R::findAll('ambientes');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gerenciar Ambientes</title>
	<link rel="stylesheet" href="../css/style.css">
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
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

		.ambiente-imagem {
			max-width: 100px;
			height: auto;
		}
	</style>
</head>

<header>
	<?php include '../inc/cabecalho.php'; ?>
</header>

<body>
	<div class="container-1">
		<h2>Gerenciar Ambientes</h2>

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
					<th>Imagem</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($ambientes as $ambiente): ?>
					<tr>
						<td>
							<?php echo $ambiente->id; ?>
						</td>
						<td><img src="../bd/imgs/<?php echo $ambiente->imagem; ?>" alt="Imagem do ambiente"
								class="ambiente-imagem"></td>
						<td>
							<?php echo $ambiente->nome; ?>
						</td>
						<td>
							<?php echo $ambiente->descricao; ?>
						</td>
						<td>
							<form method="post" style="display: inline;">
								<input type="hidden" name="id_ambiente" value="<?php echo $ambiente->id; ?>">
								<button type="submit" name="excluir_ambiente" class="excluir-btn">Excluir</button>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p> <a href="cadastroambiente.php">Cadastrar Ambientes</a> </p>
		<p><a href="controleambiente.php" class="botao">🔙 Voltar</a></p>
	</div>
</body>
<br>
<br>
<br>
<footer>
	<?php include "../inc/rodape.php"; ?>
</footer>

</html>