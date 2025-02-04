<?php
session_start();
require_once '../class/rb.php'; // Inclui a configuração do banco de dados
$mensagem = ''; // Variável para exibir mensagens de erro
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', ''); // Configuração do banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe no banco de dados
    $user = R::findOne('usuario', 'usuario = ?', [$usuario]);

    if ($user && password_verify($senha, $user->senha)) {
        // Login bem-sucedido
        $_SESSION['usuario'] = $user->usuario;
        header('Location: home.php'); // Redireciona para a página home
        exit();
    } else {
        // Login falhou
				header('Location: index.php'); // Redireciona para a pág Index
    }
}
?>