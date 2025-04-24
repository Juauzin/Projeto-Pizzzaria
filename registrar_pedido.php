<?php
header('Content-Type: application/json'); // Define o tipo de conteúdo da resposta como JSON
session_start(); // Inicia a sessão para acessar $_SESSION['usuarios']

try {
    $dados = json_decode(file_get_contents('php://input'), true); // Decodifica os dados JSON enviados na requisição

    if (!$dados) {
        throw new Exception("Dados de pedido inválidos: " . file_get_contents('php://input')); // Lança uma exceção se os dados forem inválidos
    }

    $carrinho = $dados['carrinho']; // Obtém os itens do carrinho dos dados decodificados
    $total = $dados['total']; // Obtém o total do pedido dos dados decodificados

    $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante"); // Cria uma conexão com o banco de dados

    if ($conexao->connect_error) {
        throw new Exception("Erro de conexão: " . $conexao->connect_error); // Lança uma exceção se a conexão falhar
    }

    $conexao->begin_transaction(); // Inicia uma transação no banco de dados

    // Verifica se o ID do usuário está na sessão
    if (!isset($_SESSION['usuarios'])) {
        throw new Exception("ID do usuário não encontrado na sessão. O usuário precisa estar logado para fazer um pedido.");
    }
    $usuarioId = $_SESSION['usuarios']; // Obtém o ID do usuário da sessão

    $stmtPedido = $conexao->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)"); // Prepara uma declaração SQL para inserir um novo pedido, incluindo o usuario_id
    if (!$stmtPedido) {
        throw new Exception("Erro ao preparar a declaração de pedido: " . $conexao->error); // Lança uma exceção se a preparação da declaração falhar
    }

    $stmtPedido->bind_param("id", $usuarioId, $total); // Vincula o ID do usuário e o total à declaração SQL
    if (!$stmtPedido->execute()) {
        throw new Exception("Erro ao executar a declaração de pedido: " . $stmtPedido->error); // Lança uma exceção se a execução da declaração falhar
    }

    $pedidoId = $conexao->insert_id; // Obtém o ID do pedido inserido
    $stmtPedido->close(); // Fecha a declaração do pedido

    $stmtItemPedido = $conexao->prepare("INSERT INTO itens_pedido (pedido_id, pizza_id, quantidade) VALUES (?, ?, ?)"); // Prepara uma declaração SQL para inserir os itens do pedido
    if (!$stmtItemPedido) {
        throw new Exception("Erro ao preparar a declaração de item de pedido: " . $conexao->error); // Lança uma exceção se a preparação da declaração falhar
    }

    foreach ($carrinho as $item) {
        $quantidade = 1; // Define a quantidade como 1 (pode ser ajustado se necessário)
        $stmtItemPedido->bind_param("iii", $pedidoId, $item['id'], $quantidade); // Vincula os parâmetros à declaração SQL
        if (!$stmtItemPedido->execute()) {
            throw new Exception("Erro ao executar a declaração de item de pedido: " . $stmtItemPedido->error); // Lança uma exceção se a execução da declaração falhar
        }
    }
    $stmtItemPedido->close(); // Fecha a declaração do item do pedido

    $conexao->commit(); // Confirma a transação
    echo json_encode(['sucesso' => true, 'pedido_id' => $pedidoId, 'usuario_id' => $usuarioId]); // Retorna uma resposta JSON com sucesso, o ID do pedido e o ID do usuário
} catch (Exception $e) {
    $conexao->rollback(); // Desfaz a transação em caso de erro
    error_log("Erro: " . $e->getMessage()); // Registra o erro no log do servidor
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]); // Retorna uma resposta JSON com erro
} finally {
    if (isset($conexao)) {
        $conexao->close(); // Fecha a conexão com o banco de dados
    }
}
?>