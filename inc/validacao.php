<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Inicia a sessão apenas se ela não estiver ativa
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarios_id'])) {
  // Redireciona para a página de login 
  header('Location: ../paginas/index.php?erro=');
  exit();
}
?>
