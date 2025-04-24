<?php
// Define o tipo de conteúdo da resposta HTTP como JSON. Isso informa ao cliente que a resposta será um objeto JSON.
header('Content-Type: application/json');

try {
    // Tenta executar o código dentro deste bloco. Se ocorrer alguma exceção, o controle será passado para o bloco catch.

    // Decodifica os dados JSON enviados na requisição HTTP.
    // 'php://input' é um stream que permite ler os dados brutos do corpo da requisição.
    // O segundo parâmetro 'true' converte o objeto JSON em um array associativo PHP.
    $dados = json_decode(file_get_contents('php://input'), true);

    // Verifica se os dados foram decodificados corretamente e se a chave 'usuarioId' existe no array de dados.
    // Se $dados for falso (erro na decodificação) ou 'usuarioId' não estiver presente, lança uma nova exceção.
    if (!$dados || !isset($dados['usuarioId'])) {
        throw new Exception("ID do usuário não fornecido.");
    }

    // Obtém o ID do usuário do array de dados decodificado.
    $usuarioId = $dados['usuarioId'];

    // Cria uma nova conexão com o banco de dados MySQL.
    // Os parâmetros são: servidor (localhost), usuário (root), senha (root), nome do banco de dados (pizzaria_radiante).
    $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante");

    // Verifica se houve algum erro na conexão com o banco de dados.
    // Se $conexao->connect_error não for nulo, significa que a conexão falhou e uma exceção é lançada.
    if ($conexao->connect_error) {
        throw new Exception("Erro de conexão: " . $conexao->connect_error);
    }

    // Prepara uma declaração SQL para selecionar o nome, endereço e telefone de um usuário com base no seu ID.
    // O '?' é um marcador de parâmetro que será substituído pelo valor de $usuarioId.
    $stmt = $conexao->prepare("SELECT nome, endereco, telefone FROM usuario WHERE id = ?");
    // Verifica se a preparação da declaração SQL foi bem-sucedida.
    // Se $stmt for falso, significa que houve um erro na sintaxe SQL ou outro problema, e uma exceção é lançada.
    if (!$stmt) {
        throw new Exception("Erro ao preparar a declaração: " . $conexao->error);
    }

    // Vincula o valor da variável $usuarioId ao marcador de parâmetro na declaração SQL.
    // O primeiro parâmetro "i" indica que o tipo de dado de $usuarioId é um inteiro.
    $stmt->bind_param("i", $usuarioId);
    // Executa a declaração SQL preparada.
    // Se a execução falhar, lança uma nova exceção com a mensagem de erro do statement.
    if (!$stmt->execute()) {
        throw new Exception("Erro ao executar a declaração: " . $stmt->error);
    }

    // Vincula as colunas resultantes da consulta às variáveis $nome, $endereco e $telefone.
    $stmt->bind_result($nome, $endereco, $telefone);
    // Busca a primeira (e provavelmente única) linha de resultado da consulta.
    // Se houver um resultado correspondente ao $usuarioId, os valores serão atribuídos às variáveis vinculadas.
    $stmt->fetch();
    // Fecha a declaração preparada para liberar recursos.
    $stmt->close();

    // Verifica se os dados do cliente (nome, endereço ou telefone) foram encontrados.
    // Se alguma dessas variáveis estiver vazia (falsa), significa que o usuário com o ID fornecido não foi encontrado ou não possui esses dados.
    if (!$nome || !$endereco || !$telefone) {
        throw new Exception("Dados do cliente não encontrados.");
    }

    // Se tudo ocorreu bem até aqui, codifica um array associativo PHP em formato JSON e o envia como resposta.
    // O array contém uma chave 'sucesso' com valor true e as informações do cliente ('nome', 'endereco', 'telefone').
    echo json_encode(['sucesso' => true, 'nome' => $nome, 'endereco' => $endereco, 'telefone' => $telefone]);
} catch (Exception $e) {
    // Bloco de tratamento de exceções. Se alguma exceção for lançada no bloco try, ela será capturada aqui.

    // Codifica um array associativo PHP em formato JSON indicando falha.
    // O array contém uma chave 'sucesso' com valor false e uma chave 'erro' com a mensagem da exceção.
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
} finally {
    // Bloco finally que sempre é executado, independentemente de ter ocorrido uma exceção ou não.

    // Verifica se a conexão com o banco de dados foi estabelecida ($conexao está definida).
    if (isset($conexao)) {
        // Fecha a conexão com o banco de dados para liberar recursos.
        $conexao->close();
    }
}
?>