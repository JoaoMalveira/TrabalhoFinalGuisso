<?php
require_once '../class/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

$usuarios = R::findAll('usuarios');
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #e2e2e2;
        }

        .admin {
            color: #28a745;
            font-weight: bold;
        }

        .comum {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header>
    <?php include '../inc/cabecalho.php'; ?>
</header>

<div>
    <h2>Lista de Usuários</h2>

    <table>
        <tr>
            <th>Nome de Usuário</th>
            <th>Nome Completo</th>
            <th>Status</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario->usuario) ?></td>
                <td><?= htmlspecialchars($usuario->nome) ?></td>
                <td class="<?= $usuario->admin ? 'admin' : 'comum' ?>">
                    <?= $usuario->admin ? 'Administrador' : 'Usuário Comum' ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table><br>

    <a href="controleusuario.php" class="botao">🔙 Voltar</a>
</div>

<footer>
    <?php include '../inc/rodape.php'; ?>
</footer>

</body>
</html>
