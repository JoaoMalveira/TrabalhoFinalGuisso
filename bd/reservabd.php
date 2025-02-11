<?php
session_start();
// reservabd.php
include '../inc/validacao.php'; // Inclua o arquivo de validação
require '../class/rb.php'; // Inclui o RedBeanPHP
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', ''); // Configuração do banco de dados

// Recupera os dados do formulário
$data = $_POST['data'];
$tipo = $_POST['tipo'];
$ambiente_id = $_POST['ambiente'];

// Recupera o ID do usuário da sessão
$usuario_id = $_SESSION['usuarios_id'];

// Busca os dados do usuário no banco de dados
$usuario = R::load('usuarios', $usuario_id);

// Busca os dados do ambiente no banco de dados
$ambiente = R::load('ambientes', $ambiente_id);

// Insere os dados na tabela reservas
$reserva = R::dispense('reservas');
$reserva->data = $data;
$reserva->tipo = $tipo;
$reserva->ambiente_id = $ambiente_id;
$reserva->nome_ambiente = $ambiente->nome;
$reserva->imagem_ambiente = $ambiente->imagem;
$reserva->nome = $usuario->nome; // Insere o nome do usuário
$reserva->usuario = $usuario->usuario;

$reserva->usuario = $usuario;

R::store($reserva);

// ... (redirecionamento)
header('../paginas/calendario.php');
exit();
?>