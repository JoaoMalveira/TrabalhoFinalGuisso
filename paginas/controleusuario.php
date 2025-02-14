<?php require '../inc/validacao.php'; 
require '../inc/validaadmin.php'; // Inclui a validação de admin ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Usuários</title>
    <link rel="stylesheet" href="../css/estilo.css"> <!-- Importando seu CSS global -->
</head>

<body>

    <header>
        <?php include '../inc/cabecalho.php'; ?>
    </header>

    <div class="container-2">
        <h2>Controle de Usuários</h2>

        <div>
            <a href="listausuarios.php" class="botao">📋 Lista de Usuários</a><br>
            <a href="editarusuarios.php" class="botao">✏️ Editar/Remover Usuários</a><br>
            <a href="cadastrousuario.php" class="botao">➕ Cadastrar Usuário</a><br>
        </div>
    </div> <br>


    <footer>
        <?php include '../inc/rodape.php'; ?>
    </footer>

</body>

</html>