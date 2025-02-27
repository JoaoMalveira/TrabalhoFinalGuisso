<?php
include '../inc/validacao.php';
include '../inc/validaadmin.php';

// Função para verificar se o nome de usuário já existe
function nomeUsuarioExiste($nome_usuario, $id = null)
{
    $usuario = R::findOne('usuarios', 'usuario = ?', [$nome_usuario]);
    return $usuario && ($usuario->id != $id);
}

// Atualizar usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $novo_usuario = $_POST['nome_usuario']; // Obtém o novo nome de usuário do formulário
    $nome_completo = $_POST['nome_completo']; // Obtém o novo nome completo do formulário
    $admin = isset($_POST['admin']) ? 1 : 0; // Obtém o valor do checkbox admin

    // Verifica se o nome de usuário já existe (e se não for o mesmo usuário que está sendo editado)
    if (nomeUsuarioExiste($novo_usuario, $id)) {
        echo "<script>alert('O nome de usuário já está em uso.');</script>";
    } else {
        $usuario = R::load('usuarios', $id);
        if ($usuario->id) {
            $usuario->usuario = $novo_usuario; // Atribui o NOVO valor do usuário
            $usuario->nome = $nome_completo;   // Atribui o NOVO valor do nome completo
            $usuario->admin = $admin;         // Atribui o NOVO valor de admin
            R::store($usuario);
            echo "<script>alert('Usuário atualizado com sucesso!');</script>"; // Feedback ao usuário
        } else {
            echo "<script>alert('Usuário não encontrado.');</script>"; // Mensagem de erro se o usuário não for encontrado
        }
    }
}

// Excluir usuário
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $usuario = R::load('usuarios', $id);
    if ($usuario->id) {
        R::trash($usuario);
    }
}

// Buscar usuários
$usuarios = R::findAll('usuarios');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <?php include '../inc/cabecalho.php'; ?>
    </header>
    <main>
        <div class="container">
            <h3>Gerenciar Usuários</h3> <br>
            <a href="controleusuario.php" class="botao">🔙 Voltar</a>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Nome Completo</th>
                    <th>Admin</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario->id ?></td>
                        <td><?= htmlspecialchars($usuario->usuario) ?></td>
                        <td><?= htmlspecialchars($usuario->nome) ?></td>
                        <td><?= $usuario->admin ? 'Sim' : 'Não' ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                <input type="text" name="nome_usuario" value="<?= htmlspecialchars($usuario->usuario) ?>" required>
                                <input type="text" name="nome_completo" value="<?= htmlspecialchars($usuario->nome) ?>" required>
                                <input type="checkbox" name="admin" <?= $usuario->admin ? 'checked' : '' ?>> Admin
                                <button type="submit" name="editar">Salvar</button>
                            </form>
                            <a href="?excluir=<?= $usuario->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a> <br>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
            <br>
            <br>
        </div>
    </main>
    <footer>
        <?php include '../inc/rodape.php'; ?>
    </footer>
</body>

</html>