<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Inicia a sessão apenas se ela não estiver ativa
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarios_id'])) {
  // Redireciona para a página de login com uma mensagem de erro
  header('Location: ../paginas/index.php?erro=' . urlencode("Você precisa fazer login para acessar o sistema."));
  exit();
}
?>
