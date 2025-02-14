<?php
require '../inc/validacao.php';
require '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

// Recupera os dados do formulário
$data = $_POST['data'];
$tipo = $_POST['tipo'];
$ambiente_id = $_POST['ambiente_id'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fim = $_POST['hora_fim'];

// Inicia uma transação
R::begin();

try {
    // Verifica se há reservas conflitantes no mesmo ambiente e data
    $reservasConflitantes = R::find('reservas', '
        ambiente_id = ? AND data = ? AND (
            (hora_inicio < ? AND hora_fim > ?) OR  -- Reserva que começa antes e termina durante
            (hora_inicio < ? AND hora_fim > ?) OR  -- Reserva que começa durante e termina depois
            (hora_inicio >= ? AND hora_fim <= ?)   -- Reserva que está completamente dentro do horário
        )
    ', [
        $ambiente_id,
        $data,
        $hora_fim,
        $hora_inicio,   // Verifica se há reservas que terminam durante o horário solicitado
        $hora_inicio,
        $hora_fim,   // Verifica se há reservas que começam durante o horário solicitado
        $hora_inicio,
        $hora_fim    // Verifica se há reservas completamente dentro do horário solicitado
    ]);

    // Se houver reservas conflitantes, lança uma exceção
    if (!empty($reservasConflitantes)) {
        throw new Exception("Já existe uma reserva agendada para este horário ou há sobreposição de horários.");
    }

    $usuario_id = $_SESSION['usuarios_id'];

    $usuario = R::load('usuarios', $usuario_id);

    // Busca os dados do ambiente no banco de dados
    $ambiente = R::load('ambientes', $ambiente_id);

    // Cria a nova reserva
    $reserva = R::dispense('reservas');
    $reserva->data = $data;
    $reserva->tipo = $tipo;
    $reserva->ambiente_id = $ambiente_id;
    $reserva->nome_ambiente = $ambiente->nome;
    $reserva->imagem_ambiente = $ambiente->imagem;
    $reserva->hora_inicio = $hora_inicio;
    $reserva->hora_fim = $hora_fim;
    $reserva->nome = $usuario->nome;
    $reserva->nome_usuario = $usuario->usuario;
    $reserva->usuario = $usuario;

    // Salva a reserva no banco de dados
    R::store($reserva);

    // Finaliza a transação
    R::commit();

    // Redireciona com mensagem de sucesso
    $_SESSION['sucesso'] = "Reserva realizada com sucesso!";
    header("Location: ../paginas/calendario.php");
    exit();
} catch (Exception $e) {
    // Desfaz a transação em caso de erro
    R::rollback();

    // Redireciona com mensagem de erro
    $_SESSION['erro'] = $e->getMessage();
    header("Location: ../paginas/calendario.php");
    exit();
}
