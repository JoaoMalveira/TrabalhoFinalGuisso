<?php
// session_start(); // Inicia a sessão
// require '../class/rb.php'; // Inclui a configuração do banco de dados

// $mensagem = ''; // Variável para exibir mensagens de erro ou sucesso

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $nome_completo = $_POST['nome_completo'];
//     $usuario = $_POST['usuario'];
//     $senha = $_POST['senha'];
//     $admin = isset($_POST['admin']) ? 1 : 0; // Verifica se o checkbox foi marcado

//     // Verifica se o nome de usuário já existe
//     $userExistente = R::findOne('usuarios', 'usuario = ?', [$usuario]);

//     if ($userExistente) {
//         $mensagem = "Erro: O nome de usuário já está em uso!";
//     } else {
//         // Cria um novo usuário
//         $novoUsuario = R::dispense('usuarios');
//         $novoUsuario->nome_completo = $nome_completo;
//         $novoUsuario->usuario = $usuario;
//         $novoUsuario->senha = password_hash($senha, PASSWORD_BCRYPT); // Criptografa a senha
//         $novoUsuario->admin = $admin;

//         // Salva no banco de dados
//         R::store($novoUsuario);
//         $mensagem = "Usuário cadastrado com sucesso!";
//     }
// }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<header>
 <?php
 include '../inc/cabecalho.php';
 ?>
</header>
<body>
    <div class="container">
        <h1>Cadastro de Usuários</h1>
        <form method="POST" action="">
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" id="nome_completo" name="nome_completo" required>

            <label for="usuario">Nome de Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="admin">
                <input type="checkbox" id="admin" name="admin"> Administrador
            </label>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
<footer>
	<?php
include "../inc/rodape.php"
?>
</footer>
</html>