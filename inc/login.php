<?php
session_start();
require '../class/rb.php'; // Inclui a configuração do banco de dados
$mensagem = ''; // Variável para exibir mensagens de erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe no banco de dados
    $user = R::findOne('usuarios', 'usuario = ?', [$usuario]);

    if ($user && password_verify($senha, $user->senha)) {
        // Login bem-sucedido
        $_SESSION['usuario'] = $user->usuario;
        header('Location: ../paginas/home.php'); // Redireciona para a página home
        exit();
    } else {
        // Login falhou
				header('Location: ../paginas/index.php'); // Redireciona para a pág Index
        echo "<script>alert('Usuário ou senha incorretos!');</script>";
    }
}
?>