<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<header>
		<?php include_once "./inc/cabecalho.php"; ?>
	</header>

	<body>
		<form action="home.php" method="post">
			<fieldset>
				<legend>Login</legend>
				<label for="name">Nome de usuário:</label>
				<input type="text" name="name" id="name"> <br>
				<label for=""></label>
				<label for="senha">Senha:</label>
				<input type="password" name="senha" id="senha"> <br>
				<input type="submit" value="Enviar">
			</fieldset>
		</form>
	</body>
	<footer>
		<?php include_once "./inc/rodape.php"; ?>
	</footer>

</body>

</html>