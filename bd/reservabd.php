<?php
require '../inc/validacao.php';
require '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

$data = $_POST['data'];
$tipo = $_POST['tipo'];
$ambiente_id = $_POST['ambiente_id'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fim = $_POST['hora_fim'];

$reservaExistente = R::findOne('reservas', 'data = ? AND ambiente_id = ? AND hora_inicio = ? AND hora_fim = ?', [$data, $ambiente_id, $hora_inicio, $hora_fim]);

if ($reservaExistente) {
    $_SESSION['erro'] = "Já existe uma reserva agendada para este horário.";
    header("Location: ../paginas/calendario.php");
    exit(); 
}

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
$reserva->nome_usuario = $usuario->usuario;
$reserva->hora_inicio = $hora_inicio;
$reserva->hora_fim = $hora_fim;

$reserva->usuario = $usuario;

R::store($reserva);

// Redirecionamento (com mensagem de sucesso)
$_SESSION['sucesso'] = "Reserva realizada com sucesso!";
header("Location: ../paginas/calendario.php"); // Redireciona para a página home
exit();
