<?php
require '../inc/validacao.php'; // Inclui a validação de login
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
	require_once '../class/rb.php';
	R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');
	$usuario = R::dispense( "usuario");
            $usuario->usuario = $_POST['usuario'];
            $usuario->nome = $_POST['nome'];
            $usuario->senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);
            $usuario->admin = $_POST['admin'];
            $id = R::store($usuario);


            R::close(); 
?>
</body>
</html>