<?php

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarios_id'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: ../paginas/index.php");
    exit();
}

// Inclui o arquivo de configuração do banco de dados
require_once '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

// Carrega os dados do usuário
$user = R::load('usuarios', $_SESSION['usuarios_id']);

// Verifica se o usuário é administrador
if ($user->admin != 1) { // Assumindo que 'admin' seja 1 para administradores
    // Redireciona para a página home se o usuário não for administrador
		$_SESSION['negado'] = 'Acesso negado. Você não tem permissão';
    header("Location: ../paginas/home.php");
    exit();
}

// Se o usuário for administrador, o código continua e a página é exibida normalmente
?>