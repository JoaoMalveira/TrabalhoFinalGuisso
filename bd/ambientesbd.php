<?php
// Inicia a sessão para armazenar mensagens de feedback
session_start();

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
        // Verifica se o arquivo foi enviado corretamente
        if ($imagem['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Problema ao enviar o arquivo.');
        }

        // Gera um nome único para o arquivo
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

        // Armazena uma mensagem de sucesso na sessão
        $_SESSION['feedback'] = [
            'mensagem' => 'Item cadastrado com sucesso!',
            'status' => 'ok'
        ];
    } catch (Exception $e) {
        // Armazena uma mensagem de erro na sessão
        $_SESSION['feedback'] = [
            'mensagem' => 'Erro ao cadastrar item: ' . $e->getMessage(),
            'status' => 'erro'
        ];
    }
} else {
    // Armazena uma mensagem de erro se algum campo estiver faltando
    $_SESSION['feedback'] = [
        'mensagem' => 'Todos os campos são obrigatórios.',
        'status' => 'erro'
    ];
}

// Redireciona de volta para a página de cadastro
header('Location: ../paginas/cadastroambiente.php');
exit();
?>