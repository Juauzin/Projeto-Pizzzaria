<!DOCTYPE html>
<html>
<head>
    <title>Nota Fiscal</title>
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
    <div class="nota-fiscal">
    <img src="img/FORNO DI ROMA (Site) (1) (1).png" alt="" style="width: 350px; height: 200px;">
    <?php
            session_start(); // Inicie a sessão para acessar $_SESSION['usuarios']

            $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante");
            if ($conexao->connect_error) {
                die("Falha na conexão: " . $conexao->connect_error);
            }
            $resultadoPedido = $conexao->query("SELECT id, data_pedido FROM pedidos ORDER BY id DESC LIMIT 1");
            while ($pedidos = $resultadoPedido-> fetch_assoc()){
                echo "<h3> Número do pedido:" . $pedidos['id'] . "</h3>";
            }
            ?>
        <p id="lista-carrinho-checkout"></p>
        <hp id="obterFormaEntregaSelecionada"></hp>
        <p id="obterOpcaoPagamentoSelecionada"></p>
        <h2 id="total-checkout"></h2>

    <?php
        $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante");
        $resultadoDataPedido = $conexao->query("SELECT data_pedido FROM pedidos ORDER BY id DESC LIMIT 1");
        while ($pedidosData = $resultadoDataPedido-> fetch_assoc()){
            echo "<p>" . $pedidosData['data_pedido'] . "</p>";
        }

        // Buscar o nome do usuário do último login
        if (isset($_SESSION['usuarios'])) {
            $idUsuarioLogado = $_SESSION['usuarios'];
            $sqlUltimoLogin = "SELECT nome FROM logins WHERE id_usuario = ? ORDER BY data_login DESC LIMIT 1";
            $stmtUltimoLogin = $conexao->prepare($sqlUltimoLogin);
            $stmtUltimoLogin->bind_param("i", $idUsuarioLogado);
            $stmtUltimoLogin->execute();
            $resultadoUltimoLogin = $stmtUltimoLogin->get_result();

            if ($resultadoUltimoLogin->num_rows > 0) {
                $ultimoLogin = $resultadoUltimoLogin->fetch_assoc();
                echo "<p>Obrigado: " . $ultimoLogin['nome'] . "</p>";
            } else {
                echo "<p>Informações de login não encontradas.</p>";
            }
            $stmtUltimoLogin->close();
        } else {
            echo "<p>Usuário não logado.</p>";
        }

        $conexao->close();
        ?>
    </div>

    <script>
        // Recuperar valores do localStorage e mostrar nos parágrafos
        document.addEventListener('DOMContentLoaded', () => {
            // Recuperar a forma de pagamento
            const opcaoPagamento = localStorage.getItem('opcaoPagamento');
            if (opcaoPagamento) {
                document.getElementById('obterOpcaoPagamentoSelecionada').innerHTML = opcaoPagamento;
            } else {
                document.getElementById('obterOpcaoPagamentoSelecionada').innerHTML = '<span>Dados indisponíveis</span>';
            }
            // Recuperar a forma de entrega
            const formaEntrega = localStorage.getItem('formaEntrega');
            if (formaEntrega) {
                document.getElementById('obterFormaEntregaSelecionada').innerHTML = formaEntrega;
            } else {
                document.getElementById('obterFormaEntregaSelecionada').innerHTML = '<span>Dados indisponíveis</span>';
            }
        });
    </script>
    <script src="js/script2.js"></script>
    <script src="js/script4.js"></script>
</body>
</html>