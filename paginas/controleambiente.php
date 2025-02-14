<?php require '../inc/validacao.php'; 
require '../inc/validaadmin.php'; // Inclui a validação de admin
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Ambientes</title>
    <link rel="stylesheet" href="../css/estilo.css"> <!-- Importando seu CSS global -->
</head>

<body>

    <header>
        <?php include '../inc/cabecalho.php'; ?>
    </header>

    <div class="container-2">
        <h2>Controle de Ambientes</h2>

        <div>
            <a href="gerenciarambiente.php" class="botao">✏️ Remover Ambientes</a><br>
            <a href="cadastroambiente.php" class="botao">➕ Cadastrar Ambientes</a><br>
        </div>
        <a href="home.php" class="botao">🔙 Voltar</a>
    </div> <br>


    <footer>
        <?php include '../inc/rodape.php'; ?>
    </footer>

</body>

</html>