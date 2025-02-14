<?php
// Inicia a sessão para armazenar mensagens de feedback
session_start();
require '../inc/validacao.php';
require '../inc/validaadmin.php'; // Inclui a validação de admin

// Verifica se todos os dados necessários foram enviados
if (isset($_POST['tipo'], $_POST['nome'], $_POST['descricao'], $_FILES['imagem'])) {
    // Captura os dados do formulário
    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $imagem = $_FILES['imagem'];

    // Inclui a biblioteca de banco de dados
    require_once '../class/rb.php';
    R::setup('mysql:host=127.0.0.1;dbname=reservas', 'root', '');

    try {
        // Verifica se já existe um ambiente com o mesmo nome
        $ambienteExistente = R::findOne('ambientes', 'nome = ?', [$nome]);
        if ($ambienteExistente) {
            throw new Exception('Já existe um ambiente cadastrado com este nome.');
        }

        // Verifica se o arquivo foi enviado corretamente
        if ($imagem['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Problema ao enviar o arquivo.');
        }
        $nomeArquivo = uniqid('item_', true) . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);

        // Define o diretório onde o arquivo será salvo
        $pastaDestino = 'imgs/';

        // Cria o diretório se ele não existir
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        // Define o caminho completo do arquivo
        $caminhoArquivo = $pastaDestino . $nomeArquivo;

        // Move o arquivo para o diretório de destino
        if (!move_uploaded_file($imagem['tmp_name'], $caminhoArquivo)) {
            throw new Exception('Falha ao salvar o arquivo.');
        }

        // Prepara os dados para salvar no banco de dados
        $ambientes = R::dispense('ambientes');
        $ambientes->tipo = $tipo;
        $ambientes->nome = $nome;
        $ambientes->descricao = $descricao;
        $ambientes->imagem = $nomeArquivo;

        // Salva os dados no banco de dados
        $id = R::store($ambientes);

        // Fecha a conexão com o banco de dados
        R::close();
        $_SESSION['sucesso'] = "Ambiente cadastrado com sucesso!";
        header("Location: ../paginas/cadastroambiente.php"); // Redireciona para a página home
        exit();
    } catch (Exception $e) {
        // Armazena uma mensagem de erro na sessão
        $_SESSION['erro'] = $e->getMessage(); // Exibe a mensagem de erro específica
        header("Location: ../paginas/cadastroambiente.php"); // Redireciona para a página home
        exit();
    }
} else {
    // Armazena uma mensagem de erro se algum campo estiver faltando
    $_SESSION['erro'] = 'Todos os campos são obrigatórios.'; // Mensagem de erro mais concisa
    header("Location: ../paginas/cadastroambiente.php"); // Redireciona para a página home
    exit();
}
