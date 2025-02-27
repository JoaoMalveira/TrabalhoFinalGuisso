<?php
session_start();
require '../class/rb.php'; // Inclui o RedBeanPHP
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', ''); // Configuração do banco de dados


// Verifica se a tabela 'usuario' existe e está vazia
if (R::count('usuarios') == 0) {
    // Cria um usuário padrão (administrador)
    $usuarioPadrao = R::dispense('usuarios');
    $usuarioPadrao->nome = 'Administrador Padrão';
    $usuarioPadrao->usuario = 'root';
    $usuarioPadrao->senha = password_hash('toor', PASSWORD_BCRYPT); // Senha criptografada
    $usuarioPadrao->admin = true; // 1 para administrador

    // Salva o usuário no banco de dados
    R::store($usuarioPadrao);

    echo "Usuário padrão criado com sucesso!";
    echo "<a href='../paginas/index.php'> Voltar</a>";
} else {
    echo "Já existem usuários cadastrados.";
    echo "<a href='../paginas/index.php'> Voltar</a>";
}
