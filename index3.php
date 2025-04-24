<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <?php
    session_start();
    // Processamento de Login
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante");
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }
        $sql = "SELECT id, nome, senha, endereco, telefone, is_admin FROM usuarios WHERE cpf = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $cliente = $resultado->fetch_assoc();
            if (password_verify($senha, $cliente['senha'])) {
                $_SESSION['usuarios'] = $cliente['id']; // Adiciona o ID do usuário à sessão

                // Registrar o login na tabela 'logins'
                $sqlLog = "INSERT INTO logins (id_usuario, nome, endereco, telefone) VALUES (?, ?, ?, ?)";
                $stmtLog = $conexao->prepare($sqlLog);
                $stmtLog->bind_param("isss", $cliente['id'], $cliente['nome'], $cliente['endereco'], $cliente['telefone']);
                $stmtLog->execute();
                $_SESSION['id_login'] = $conexao->insert_id; // Armazena o ID do login na sessão
                $stmtLog->close();

                // Verificar se o usuário é administrador e redirecionar
                if ($cliente['is_admin']) {
                    header("Location: admin_dashboard.php"); // Redirecionar para a página de administração
                    exit;
                } else {
                    echo "<script>alert('Login realizado com sucesso para o cliente: " . $cliente['nome'] . "');</script>";
                    header("Location: index1.php"); // Redireciona para a página principal do cliente
                    exit;
                }
            } else {
                echo "<script>alert('Senha incorreta.');</script>";
            }
        } else {
            echo "<script>alert('CPF não encontrado.');</script>";
        }
        $conexao->close();
        echo "<script>window.location.href = 'index3.php';</script>";
        exit;
    }
    ?>
    <div class="container">
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="cpf_login">CPF:</label>
                <input type="text" name="cpf" id="cpf_login" required>
            </div>
            <div class="form-group">
                <label for="senha_login">Senha:</label>
                <input type="password" name="senha" id="senha_login" required>
            </div>
            <div class="form-group">
            <button type="submit" name="login" style="display: inline-block;">Login</button>
                <p>Ainda não possui conta?<a href="index33.php">Cadastrar</a></p>
            </div>
        </form>
    </div>
    <div id="resumoPedidoDetalhado">
    </div>
    <script src="js/script2.js"></script>
</body>
</html>