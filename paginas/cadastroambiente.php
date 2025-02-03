<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<header>
		<?php
	require '../class/rb.php'; // Inclui a biblioteca RedBeanPHP
	?>
	</header>
	<main>
	// Conectar ao banco de dados usando RedBeanPHP
R::setup('mysql:host=localhost;dbname=cadastro_db', 'root', '');

if (!R::testConnection()) {
    die("Erro na conexão com o banco de dados");
}

// Cadastro de ambientes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_ambiente'])) {
    $ambiente = R::dispense('ambientes');
    $ambiente->nome = $_POST['nome_ambiente'];
    R::store($ambiente);
    header("Location: index.php"); // Redireciona para evitar reenvio de formulário
    exit;
}
	</main>
	
</body>
</html>

<?php

