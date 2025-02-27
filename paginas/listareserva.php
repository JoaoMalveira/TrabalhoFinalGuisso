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

if (isset($_POST['excluir_reserva'])) {
	$id_reserva_excluir = $_POST['id_reserva'];
	$reserva_excluir = R::load('reservas', $id_reserva_excluir);

	if ($reserva_excluir) {
		R::trash($reserva_excluir);
		$_SESSION['sucesso'] = "Reserva excluída com sucesso!";
	} else {
		$_SESSION['erro'] = "Erro ao excluir reserva.";
	}

	header("Location: listareserva.php"); // Recarrega a página para atualizar a lista
	exit();
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
                        <th>Ações</th>
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
								<button type="submit" name="excluir_reserva" class="excluir-btn">Excluir</button>
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
    <?php
		if (isset($_SESSION['erro'])) {
			echo "<div class='alerta erro'>" . $_SESSION['erro'] . "</div>";
			unset($_SESSION['erro']);
		} elseif (isset($_SESSION['sucesso'])) {
			echo "<div class='alerta sucesso'>" . $_SESSION['sucesso'] . "</div>";
			unset($_SESSION['sucesso']);
		}
		?>
</body>
<br>

<br>
<footer>
    <?php include "../inc/rodape.php"; ?>
</footer>

</html>