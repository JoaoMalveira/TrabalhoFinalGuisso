<?php
session_start();
require_once '../class/rb.php';
$mensagem = '';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $user = R::findOne('usuarios', 'usuario = ?', [$usuario]); // Nome da tabela corrigido

    if ($user && password_verify($senha, $user->senha)) {
        // Login bem-sucedido
        $_SESSION['usuarios_id'] = $user->id; // Define o ID do usuário na sessão
        header('Location: home.php');
        exit();
    } else {
        // Login falhou
        $mensagem = "Usuário ou senha incorretos."; // Mensagem de erro
        // Redireciona de volta para index.php com a mensagem de erro
        header('Location: index.php?erro=' . urlencode($mensagem)); 
        exit();
    }
}
?>