<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$admin_nome = $_SESSION['admin_nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>
    <div class="container">
        <h2>Painel de Administração</h2>
        <p>Bem-vindo, <?php echo htmlspecialchars($admin_nome); ?>!</p>

        <h3>Consultar Pedidos</h3>
        <form method="get" action="consultar_pedidos.php">
            <div class="form-group">
                <label for="pedido_id">ID do Pedido:</label>
                <input type="number" name="pedido_id" id="pedido_id">
            </div>
            <div class="form-group">
                <label for="data_inicio">Data de Início:</label>
                <input type="date" name="data_inicio" id="data_inicio">
            </div>
            <div class="form-group">
                <label for="data_fim">Data de Fim:</label>
                <input type="date" name="data_fim" id="data_fim">
            </div>
            <div class="form-group">
                <label for="usuario_id">ID do Usuário:</label>
                <input type="number" name="usuario_id" id="usuario_id">
            </div>
            <button type="submit">Consultar</button>
        </form>

        <p><a href="logout_admin.php">Sair</a></p>
    </div>
</body>
</html>