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
            $usuario->usuario = $_POST['username'];
            $usuario->nome = $_POST['fullname'];
            $usuario->senha = $_POST['senha'];
            $usuario->admin = $_POST['admin'];
            $id = R::store($usuario);


            R::close(); 
?>
</body>
</html>