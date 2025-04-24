const carrinho = []; // Array para armazenar os itens do carrinho de compras.
const listaCarrinho = document.getElementById('lista-carrinho'); // Elemento HTML (<ul> ou <ol>) onde os itens do carrinho serão exibidos.
const totalElement = document.getElementById('total'); // Elemento HTML (<span>, <p>, etc.) onde o valor total do carrinho será mostrado.
const finalizarButton = document.getElementById('finalizar'); // Botão HTML que o usuário clica para finalizar o pedido.

// Seleciona todos os botões com a classe 'adicionar' (presumivelmente nos cards de cada pizza).
document.querySelectorAll('.adicionar').forEach(button => {
    // Adiciona um listener de evento de clique a cada botão 'adicionar'.
    button.addEventListener('click', () => {
        // Ao clicar, extrai informações da pizza do elemento pai do botão.
        const pizzaId = parseInt(button.dataset.id); // Obtém o ID da pizza do atributo 'data-id' do botão e converte para um número inteiro.
        const pizzaNome = button.parentElement.querySelector('h3').textContent; // Obtém o nome da pizza do elemento <h3> dentro do elemento pai.
        const pizzaPreco = parseFloat(button.parentElement.querySelector('.preco').textContent.replace('R$ ', '').replace(',', '.')); // Obtém o preço da pizza do elemento com a classe 'preco', remove 'R$', substitui vírgula por ponto e converte para um número de ponto flutuante.
        carrinho.push({ id: pizzaId, nome: pizzaNome, preco: pizzaPreco }); // Adiciona um objeto representando a pizza ao array 'carrinho'.
        atualizarCarrinho(); // Chama a função para atualizar a exibição do carrinho e o total.
    });
});

// Adiciona um listener de evento de clique a todo o documento para lidar com a remoção de itens do carrinho.
// Isso é usado porque os botões de remover são criados dinamicamente.
document.addEventListener('click', function(event) {
    // Verifica se o elemento clicado possui a classe 'remover-item'.
    if (event.target.classList.contains('remover-item')) {
        const pizzaIdParaRemover = parseInt(event.target.dataset.id); // Obtém o ID da pizza a ser removida do atributo 'data-id' do botão de remover.
        const indiceParaRemover = carrinho.findIndex(item => item.id === pizzaIdParaRemover); // Encontra o índice do item no array 'carrinho' com o ID correspondente.

        // Verifica se o item foi encontrado no carrinho (findIndex retorna -1 se não encontrado).
        if (indiceParaRemover !== -1) {
            carrinho.splice(indiceParaRemover, 1); // Remove o item do array 'carrinho' no índice encontrado.
            atualizarCarrinho(); // Chama a função para atualizar a exibição do carrinho e o total.
        }
    }
});

// Função para atualizar a exibição do carrinho na página.
function atualizarCarrinho() {
    listaCarrinho.innerHTML = ''; // Limpa o conteúdo da lista do carrinho na página.
    let total = 0; // Inicializa a variável para calcular o total do carrinho.
    carrinho.forEach(item => {
        // Para cada item no array 'carrinho', cria um novo elemento <li>.
        const li = document.createElement('li');
        // Define o conteúdo HTML do <li> para exibir o nome e o preço do item, junto com um botão de remover.
        li.innerHTML = `
            <span>${item.nome} - R$ ${item.preco.toFixed(2)}</span>
            <div class="RemoverItem">
                <button class="remover-item" data-id="${item.id}"style="width: 100px; height: 25px;">excluir
                </button>
            </div>
        `;
        listaCarrinho.appendChild(li); // Adiciona o <li> à lista do carrinho na página.
        total += item.preco; // Adiciona o preço do item ao total.
    });
    totalElement.textContent = `Total: R$ ${total.toFixed(2)}`; // Atualiza o texto do elemento de total na página, formatando o valor para duas casas decimais.
    localStorage.setItem('carrinho', JSON.stringify(carrinho)); // Salva o estado atual do carrinho no localStorage para que persista entre as sessões.
}

// Adiciona um listener de evento de clique ao botão de finalizar pedido.
finalizarButton.addEventListener('click', () => {
    // Cria um objeto com os dados do pedido a serem enviados para o servidor.
    const dadosPedido = {
        carrinho: carrinho, // Array de itens no carrinho.
        total: parseFloat(totalElement.textContent.replace('Total: R$ ', '').replace(',', '.')) // Obtém o total do carrinho da página e converte para um número.
    };
    // Envia uma requisição POST para o script 'registrar_pedido.php' no servidor para registrar o pedido.
    fetch('registrar_pedido.php', {
        method: 'POST', // Método HTTP POST para enviar dados.
        headers: {
            'Content-Type': 'application/json' // Indica que os dados enviados estão no formato JSON.
        },
        body: JSON.stringify(dadosPedido) // Converte o objeto 'dadosPedido' para uma string JSON para enviar no corpo da requisição.
    })
    .then(response => response.json()) // Recebe a resposta do servidor e a parseia como JSON.
    .then(data => {
        // Processa os dados recebidos do servidor.
        if (data.sucesso) {
            alert('Pedido finalizado com sucesso! Número do pedido: ' + data.pedido_id); // Exibe um alerta de sucesso com o número do pedido.
            carrinho.length = 0; // Limpa o array 'carrinho'.
            atualizarCarrinho(); // Atualiza a exibição do carrinho na página para mostrar que está vazio.
        } else {
            alert('Erro ao finalizar o pedido.'); // Exibe um alerta de erro se a finalização do pedido falhar.
        }
    })
    .catch(error => {
        // Captura erros que ocorreram durante a requisição ou no processamento da resposta.
        console.error('Erro:', error); // Exibe o erro no console do navegador.
        alert('Erro ao finalizar o pedido.'); // Exibe um alerta de erro genérico para o usuário.
    });
});

// Função para redirecionar o usuário para a tela inicial.
function redirecionar() {
    // Altera a localização da janela do navegador para a URL especificada.
    window.location.href = "index1.php";
}

// Inicializa o carrinho ao carregar a página.
const carrinhoSalvo = localStorage.getItem('carrinho'); // Tenta obter o carrinho salvo do localStorage.
if (carrinhoSalvo) {
    // Se houver um carrinho salvo no localStorage, parseia a string JSON de volta para um array e adiciona seus itens ao array 'carrinho'.
    carrinho.push(...JSON.parse(carrinhoSalvo));
    atualizarCarrinho(); // Chama a função para atualizar a exibição do carrinho com os itens salvos.
}