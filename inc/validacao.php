<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: ../paginas/home.php');
    exit(); // Encerra a execução do script
}
?>