<?php
require '../inc/validacao.php'; // Inclui a validação de login
require '../inc/validaadmin.php'; // Inclui a validação de admin
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Ambiente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <?php
    include '../inc/cabecalho.php';
    ?>
</header>

<body>
    <div class="container-1">
        <h2>Cadastro de Ambiente</h2>
        <form method="POST" enctype="multipart/form-data" action="../bd/ambientesbd.php">
            <label for="nome">Nome do Ambiente:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>

            <label for="tipo">Escolha um Tipo:</label>
            <select id="tipo" name="tipo">
                <option value="Laboratorio">Laboratório</option>
                <option value="Sala">Sala</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
        <p><a href="controleambiente.php" class="botao">🔙 Voltar</a></p>
    </div>

    <?php
    if (isset($_SESSION['erro'])) {
        echo "<div class='alerta erro'>" . $_SESSION['erro'] . "</div>";
        unset($_SESSION['erro']); // Apaga a mensagem após exibir
    } elseif (isset($_SESSION['sucesso'])) {
        echo "<div class='alerta sucesso'>" . $_SESSION['sucesso'] . "</div>";
        unset($_SESSION['sucesso']); // Apaga a mensagem após exibir
    }
    ?>
</body>
<br>
<br>
<br>
<footer>
    <?php
    include "../inc/rodape.php"

    ?>
</footer>

</html>