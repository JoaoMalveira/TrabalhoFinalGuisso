<?php
require '../inc/validacao.php'; // Verifica se o usuário está autenticado

require_once '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

// Verifica se o nome de usuário já existe
$usuario_existente = R::findOne('usuarios', 'usuario = ?', [$_POST['usuario']]);

if ($usuario_existente) {
    $_SESSION['erro'] = "Este nome de usuário já está sendo utilizado.";
    header("Location: ../paginas/cadastrousuario.php"); // Redireciona de volta ao formulário
    exit;
} else {
    $usuario = R::dispense("usuarios");
    $usuario->usuario = $_POST['usuario'];
    $usuario->nome = $_POST['nome'];
    $usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $admin = isset($_POST["admin"]) ? 1 : 0;
    $usuario->admin = $admin;
    R::store($usuario);

    $_SESSION['sucesso'] = "Usuário cadastrado com sucesso!";
    header("Location: ../paginas/cadastrousuario.php");
    exit;
}
?>