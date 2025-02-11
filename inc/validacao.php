<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Inicia a sessão apenas se ela não estiver ativa
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarios_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: ../paginas/home.php?erro=' . urlencode("Você precisa fazer login para acessar o sistema."));
    exit(); // Encerra a execução do script
}
?>
