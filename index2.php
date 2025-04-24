<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/style2.css">
<head>
    <title>Checkout</title>
</head>
<body>
    <div class="container">
        <?php
            session_start();
            if (isset($_SESSION['mensagem'])) { // Verifica se o usuário está logado
        ?>
            <div class="dados-pessoais">
                <div class="resumo-pedido">
            <h2>Resumo do Pedido</h2>
            <ul id="lista-carrinho-checkout"></ul>
            <p id="total-checkout"></p>

            <div class="pagamento-opcao">
            <input type="radio" id="entregaCheckbox" name="entrega" value="Entrega">
                    <label id="entregaLabel" for="entregaCheckbox">Entrega dentro de 45 minutos <hr>Acréscimo de R$8.00.</label>
                </div>
            <div class="pagamento-opcao">
            <input type="radio" id="retiradaCheckbox" name="entrega" value="Retirada">
                    <label id="retiradaLabel" for="retiradaCheckbox">Retirada dentro de 20 minutos</label>
                </div>
        </div>
                <button type="submit" id="finalizar">Finalizar Pedido</button>
            </div>
        <?php
            } else {
                echo "<script>
                        alert('Por favor, faça login para finalizar o pedido');
                        setTimeout(function() {
                            window.location.href = 'index3.php'; // Redireciona para index1.php após 2 segundos
                        }, 1000);
                      </script>";
                exit; // Importante para interromper a execução do restante do PHP
            }
        ?>
        <div class="pagamento">
            <h2>Pagamento</h2>
            <p>Escolha uma forma de pagamento</p>
            <div class="pagamento-opcao">
                <input type="radio" id="pixCheckbox" name="pagamento" value="pix">
                <label id="pixLabel" for="pixCheckbox">Pix</label>
            </div>
            <div class="pagamento-opcao">
                <input type="radio" id="debitoCheckbox" name="pagamento" value="cartaoDebito">
                <label id="debitoLabel" for="debitoCheckbox">Cartão de Débito</label>
            </div>
            <div class="pagamento-opcao">
                <input type="radio" id="creditoCheckbox" name="pagamento" value="cartaoCredito">
                <label id="creditoLabel" for="creditoCheckbox">Cartão de Crédito</label>
            </div>
        </div>
    </div>
    <script src="js/script2.js"></script>
</body>
</html> 