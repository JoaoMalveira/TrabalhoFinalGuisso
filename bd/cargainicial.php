<body>
	<?php
require 'rb.php'; // Inclui o RedBeanPHP
R::setup('mysql:host=localhost;dbname=reservas', 'root', ''); // Configuração do banco de dados

// Verifica se a tabela 'usuario' existe e está vazia
if (R::count('usuario') == 0) {
    // Cria um usuário padrão (administrador)
    $usuarioPadrao = R::dispense('usuario');
    $usuarioPadrao->nome = 'Administrador Padrão';
    $usuarioPadrao->usuario = 'root';
    $usuarioPadrao->senha = password_hash('toor', PASSWORD_BCRYPT); // Senha criptografada
    $usuarioPadrao->admin = true; // 1 para administrador

    // Salva o usuário no banco de dados
    R::store($usuarioPadrao);

    echo "Usuário padrão criado com sucesso!";
} else {
    echo "Já existem usuários cadastrados.";
}
?>