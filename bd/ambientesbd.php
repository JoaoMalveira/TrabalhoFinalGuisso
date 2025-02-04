<?php
require '../inc/validacao.php'; // Inclui a validação de login
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		require_once '../class/rb.php';	R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $descricao = trim($_POST["descricao"]);

    if (!empty($_FILES["imagem"]["tmp_name"])) {
        // Pegamos o conteúdo binário da imagem
        $imagemBinaria = file_get_contents($_FILES["imagem"]["tmp_name"]);

        // Criamos um novo ambiente no banco
        $ambiente = R::dispense("ambiente");
        $ambiente->nome = $nome;
        $ambiente->descricao = $descricao;
        $ambiente->imagem = $imagemBinaria; // Armazena o conteúdo da imagem no banco

	$ambiente = R::dispense( "ambientes");
            $ambiente->nome = $_POST['nome'];
            $ambiente->descricao = $_POST['descricao'];
            $ambiente->imagem = $imagemBinaria;
						R::store($ambiente);

						echo "Ambiente cadastrado com sucesso!";
				} else {
						echo "Erro ao processar a imagem!";
				}
		}
		?>
</body>
</html>