<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Inicia a sessão apenas se ela não estiver ativa
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: ../paginas/home.php');
    exit(); // Encerra a execução do script
}
?>