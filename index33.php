<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
<?php
    session_start(); // Inicia a sessão (se você for usar $_SESSION['mensagem'])

    // Processamento de Cadastro
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastro'])) {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        //conexao com o banco
        $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante");
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }

        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, cpf, senha, endereco, telefone ) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssss", $nome, $cpf, $senhaCriptografada, $endereco, $telefone); // Alterado para "sssss"

        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Cliente cadastrado com sucesso."; // Define a mensagem na sessão
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar cliente: " . $stmt->error; // Define a mensagem de erro
        }
        $conexao->close();
        header("Location: index3.php");
        exit;
    }
    // Exibição de mensagens
    if (isset($_SESSION['mensagem'])) {
        echo "<p class='message'>" . $_SESSION['mensagem'] . "</p>";
        unset($_SESSION['mensagem']);
    }
?>
<div class="container" id="cadastro">
    <h2>Cadastro</h2>
    <form method="post">
        <div class="form-group">
            <label for="nome_cadastro">Nome:</label>
            <input type="text" name="nome" id="nome_cadastro" required>
        </div>
        <div class="form-group">
            <label for="cpf_cadastro">CPF:</label>
            <input type="text" name="cpf" id="cpf_cadastro" required>
        </div>
        <div class="form-group">
            <label for="senha_cadastro">Senha:</label>
            <input type="password" name="senha" id="senha_cadastro" required>
        </div>
        <div class="form-group">
            <label for="endereco_cadastro">Endereço:</label>
            <input type="text" name="endereco" id="endereco_cadastro" required>
        </div>
        <div class="form-group">
            <label for="telefone_cadastro">Telefone:</label>
            <input type="tel" name="telefone" id="telefone_cadastro" required>
        </div>
        <div class="form-group">
        <button type="submit" name="cadastro" style="display: inline-block;">Cadastrar</button>
        </div>
    </form>
</div>
</body>
</html>