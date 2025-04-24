// checkout.js

// Obtém a referência para a lista de itens do carrinho na página de checkout.
const listaCarrinhoCheckout = document.getElementById('lista-carrinho-checkout');
// Obtém a referência para o elemento que exibirá o total do pedido na página de checkout.
const totalCheckout = document.getElementById('total-checkout');
// Obtém a referência para o botão de finalizar o pedido.
const finalizarPedido = document.getElementById('finalizar');

// Recupera o carrinho de compras do localStorage.
// Se não houver carrinho salvo, inicializa como um array vazio.
const carrinhoString = localStorage.getItem('carrinho');
const carrinho = JSON.parse(carrinhoString) || [];

// Inicializa a variável para armazenar o total do pedido.
let total = 0;

// Itera sobre cada item no array 'carrinho'.
carrinho.forEach(item => {
    // Cria um novo elemento de lista (<li>) para cada item do carrinho.
    const li = document.createElement('li');
    // Define o texto do item da lista para mostrar o nome e o preço do produto.
    li.textContent = `${item.nome} - R$ ${item.preco.toFixed(2)}`;
    // Adiciona o elemento de lista à lista de itens do carrinho na página de checkout.
    listaCarrinhoCheckout.appendChild(li);
    // Adiciona o preço do item ao total do pedido.
    total += item.preco;
});

// Atualiza o texto do elemento de total na página de checkout com o valor total formatado.
totalCheckout.textContent = `Total: R$ ${total.toFixed(2)}`;

// Função para verificar qual a forma de entrega selecionada pelo cliente.
function obterFormaEntregaSelecionada() {
    // Obtém as referências para os checkboxes de entrega e retirada.
    const entregaCheckbox = document.getElementById('entregaCheckbox');
    const retiradaCheckbox = document.getElementById('retiradaCheckbox');
    // Declara uma variável para armazenar o HTML do resultado da seleção.
    let resultadoHTML;

    // Verifica se o checkbox de entrega está marcado.
    if (entregaCheckbox.checked) {
        // Se estiver marcado, cria um span com o valor e o texto do label de entrega.
        resultadoHTML = `<span>${entregaCheckbox.value} - ${document.getElementById('entregaLabel').textContent}</span>`;
    }
    // Senão, verifica se o checkbox de retirada está marcado.
    else if (retiradaCheckbox.checked) {
        // Se estiver marcado, cria um span com o valor e o texto do label de retirada.
        resultadoHTML = `<span>${retiradaCheckbox.value} - ${document.getElementById('retiradaLabel').textContent}</span>`;
    }
    // Se nenhum dos checkboxes estiver marcado.
    else {
        // Define o HTML do resultado para indicar que nenhuma forma de entrega foi selecionada.
        resultadoHTML = `<span>Nenhuma forma de entrega selecionada</span>`;
    }

    // Salva o resultado da forma de entrega no localStorage para persistência.
    localStorage.setItem('formaEntrega', resultadoHTML);
    // Retorna o HTML do resultado da forma de entrega selecionada.
    return resultadoHTML;
}

// Função para obter a opção de pagamento selecionada pelo cliente.
function obterOpcaoPagamentoSelecionada() {
    // Obtém as referências para os checkboxes de PIX, débito e crédito.
    const pixCheckbox = document.getElementById('pixCheckbox');
    const debitoCheckbox = document.getElementById('debitoCheckbox');
    const creditoCheckbox = document.getElementById('creditoCheckbox');
    // Declara uma variável para armazenar o HTML do resultado da seleção.
    let resultadoHTML;

    // Verifica se o checkbox de PIX está marcado.
    if (pixCheckbox.checked) {
        // Se estiver marcado, cria um span com o valor e o texto do label de PIX.
        resultadoHTML = `<span>${pixCheckbox.value} - ${document.getElementById('pixLabel').textContent}</span>`;
    }
    // Senão, verifica se o checkbox de débito está marcado.
    else if (debitoCheckbox.checked) {
        // Se estiver marcado, cria um span com o valor e o texto do label de débito.
        resultadoHTML = `<span>${debitoCheckbox.value} - ${document.getElementById('debitoLabel').textContent}</span>`;
    }
    // Senão, verifica se o checkbox de crédito está marcado.
    else if (creditoCheckbox.checked) {
        // Se estiver marcado, cria um span com o valor e o texto do label de crédito.
        resultadoHTML = `<span>${creditoCheckbox.value} - ${document.getElementById('creditoLabel').textContent}</span>`;
    }
    // Se nenhum dos checkboxes estiver marcado.
    else {
        // Define o HTML do resultado para indicar que nenhuma opção de pagamento foi selecionada.
        resultadoHTML = `<span>Nenhuma opção selecionada</span>`;
    }

    // Salva o resultado da opção de pagamento no localStorage para persistência.
    localStorage.setItem('opcaoPagamento', resultadoHTML);
    // Retorna o HTML do resultado da opção de pagamento selecionada.
    return resultadoHTML;
}

// Adiciona um listener de evento de clique ao botão "Finalizar Pedido" (se ele existir na página).
if (finalizarPedido) {
    finalizarPedido.addEventListener('click', () => {
        // Salva a forma de entrega selecionada ao clicar no botão de finalizar.
        const resultadoEntrega = obterFormaEntregaSelecionada();
        console.log(`Forma de entrega salva: ${resultadoEntrega}`);

        // Salva a opção de pagamento selecionada ao clicar no botão de finalizar.
        const resultadoPagamento = obterOpcaoPagamentoSelecionada();
        console.log(`Opção de pagamento salva: ${resultadoPagamento}`);

        // Coleta os dados dos itens do pedido do carrinho.
        const itensPedido = carrinho.map(item => ({
            id: item.id, // Assumindo que cada item no carrinho tem um 'id' para identificar o produto.
            nome: item.nome,
            preco: item.preco
        }));
        // Obtém o valor total do pedido da variável 'total' calculada anteriormente.
        const totalPedido = total;

        // Envia os dados do pedido para o servidor usando a API fetch.
        fetch('registrar_pedido.php', {
            method: 'POST', // Utiliza o método POST para enviar dados.
            headers: {
                'Content-Type': 'application/json' // Indica que o corpo da requisição está no formato JSON.
            },
            body: JSON.stringify({ // Converte o objeto com os dados do pedido para uma string JSON.
                carrinho: itensPedido,
                total: totalPedido
            })
        })
        .then(response => response.json()) // Processa a resposta do servidor como JSON.
        .then(data => {
            // Verifica se o pedido foi salvo com sucesso no servidor.
            if (data.sucesso) {
                console.log('Pedido salvo com sucesso! ID do pedido:', data.pedido_id);
                // Abre a página 'index4.php' (presumivelmente a página de confirmação do pedido) em uma nova aba ou janela.
                window.open('index4.php', '_blank');
            } else {
                // Se houver um erro ao salvar o pedido, exibe uma mensagem de erro no console e um alerta para o usuário.
                console.error('Erro ao salvar o pedido:', data.erro);
                alert('Ocorreu um erro ao salvar o pedido. Por favor, tente novamente.');
            }
        })
        .catch(error => {
            // Captura erros que ocorreram durante a comunicação com o servidor.
            console.error('Erro ao enviar o pedido:', error);
            alert('Ocorreu um erro ao enviar o pedido. Por favor, tente novamente.');
        });
    });
} else {
    // Se o botão de finalizar pedido não for encontrado na página, exibe uma mensagem no console.
    console.log('Usuário não logado, não pode finalizar o pedido.');
}