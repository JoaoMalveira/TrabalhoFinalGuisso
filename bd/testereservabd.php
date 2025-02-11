<?php
include '../inc/validacao.php';
require '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

if (!isset($_SESSION['usuario'])) {
    die("Erro: Usuário não autenticado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario'];
    $ambiente_id = $_POST['ambiente_id'];
    $data_reserva = $_POST['data_reserva'];

    // Verifica se já existe reserva no mesmo dia para o mesmo ambiente
    $reserva_existente = R::findOne('reservas', 'ambiente_id = ? AND data_reserva = ?', [$ambiente_id, $data_reserva]);

    if ($reserva_existente) {
        echo "Este ambiente já está reservado nesta data.";
    } else {
        $reserva = R::dispense('reservas');
        $reserva->usuario_id = $usuario_id;
        $reserva->ambiente_id = $ambiente_id;
        $reserva->data_reserva = $data_reserva;
        R::store($reserva);
        
        echo "Reserva realizada com sucesso!";
        header("Location: calendario.php");
        exit;
    }
}
?>
