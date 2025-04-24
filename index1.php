<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORNO DI ROMA</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <header>
    <img src="img/FORNO DI ROMA (Site) (1) (1).png" alt="" style="width: 100px; height: 50px;">
        <h1 class="Barra1" >Nosso Cardápio</h1>
    <aside class="Barra">    
        <div class = "Titulo1">
            <a  href="index3.php"><button>Login</button></a>
            <a  href="index33.php"><button>Cadastro</button></a>
            </div>
        </aside>
    </header>
    <main>
        <section id="cardapio">
            <div class="pizza-grid">
                <?php
                $conexao = new mysqli("localhost", "root", "root", "pizzaria_radiante");
                if ($conexao->connect_error) {
                    die("Falha na conexão: " . $conexao->connect_error);
                }
                $resultado = $conexao->query("SELECT * FROM pizzas");
                while ($pizza = $resultado->fetch_assoc()) {
                    echo "<div class='pizza'>";
                    echo "<img class='imgpizza' src=\"img/pizza.png\" alt=\"" . $pizza['nome'] . "\" style=\"border-radius: 100px;\">";
                    echo "<h3>" . $pizza['nome'] . "</h3>";
                    echo "<p>" . $pizza['descricao'] . "</p>";
                    echo "<h3 class='preco'>R$ " . number_format($pizza['preco'], 2, ',', '.') . "</h3>";
                    echo "<button class='adicionar' data-id='" . $pizza['id'] . "'>Adicionar ao Carrinho</button>";
                    echo "</div>";
                }
                $conexao->close();
                ?>
            </div>
        </section>
            <section class="tamanhoCar sticky-carrinho" id="carrinho">
                <h2>Seu Carrinho</h2>
                    <ul id="lista-carrinho"></ul>
                    <div id="itens-carrinho">
                    <div id="total-pagar">
                        <p id="total">Total: R$ 0,00</p>
                        <form action="index2.php" method="post">
                            <button type="submit">Finalizar Pedido</button>
                        </form>
                    </div>
                </div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>
</html>