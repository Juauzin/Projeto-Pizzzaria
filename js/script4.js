// Este trecho de código JavaScript é parte de um script chamado 'checkout.js', 
// A primeira parte do código configura um listener de eventos para mensagens recebidas pela janela do navegador.
window.addEventListener('message', function(event) {
    // Esta função anônima será executada sempre que a janela receber uma mensagem de outra origem (outro domínio ou iframe).

    // A linha abaixo verifica se a origem da mensagem (o domínio que enviou a mensagem) é a mesma da janela atual.
    // Isso é uma medida de segurança importante para evitar que scripts maliciosos de outros sites interfiram com a página.
    if (event.origin === window.location.origin) {
        // Se a origem da mensagem for a mesma da página atual, o código dentro deste bloco será executado.

        // A linha abaixo assume que os dados do pedido foram enviados como uma string JSON dentro da propriedade 'data' do objeto 'event'.
        // 'JSON.parse()' converte essa string JSON de volta para um objeto JavaScript.
        const dadosPedido = JSON.parse(event.data);

        // Esta linha chama uma função chamada 'exibirDadosPedido', passando o objeto 'dadosPedido' como argumento.
        // Acredita-se que esta função seja responsável por exibir os detalhes do pedido na interface do usuário.
        exibirDadosPedido(dadosPedido);
    }
});

// Esta função recebe um objeto 'dadosPedido' como entrada e é responsável por exibir as informações do pedido na página.
function exibirDadosPedido(dadosPedido) {
    // Esta linha obtém uma referência ao elemento HTML com o ID 'dados-pedido'.
    // Presume-se que exista um elemento <div> ou similar no HTML com este ID, onde os detalhes do pedido serão exibidos.
    const dadosPedidoDiv = document.getElementById('dados-pedido');

    // A variável 'html' é inicializada com uma string de template literal (template string) que contém a estrutura HTML para exibir os dados do pedido.
    // Ela inclui parágrafos para o total, método de pagamento e tipo de entrega.
    let html = `
        <p><strong>Total:</strong> R$ ${dadosPedido.total}</p>
        <p><strong>Pagamento:</strong> ${dadosPedido.pagamento}</p>
        <p><strong>Entrega:</strong> ${dadosPedido.entrega}</p>
        <ul>
    `;

    // Esta linha itera sobre a propriedade 'carrinho' do objeto 'dadosPedido'.
    // Assume-se que 'dadosPedido.carrinho' seja um array de objetos, onde cada objeto representa um item no carrinho de compras.
    dadosPedido.carrinho.forEach(item => {
        // Para cada 'item' no carrinho, esta linha adiciona um item de lista (<li>) à string 'html'.
        // O item de lista exibe o nome e o preço do produto.
        html += `<li>${item.nome} - R$ ${item.preco}</li>`;
    });

    // Esta linha fecha a tag de lista não ordenada (</ul>) na string 'html'.
    html += `</ul>`;

    // Finalmente, esta linha define o conteúdo HTML do elemento 'dadosPedidoDiv' com a string 'html' construída.
    // Isso fará com que os detalhes do pedido sejam exibidos na página dentro deste elemento.
    dadosPedidoDiv.innerHTML = html;
}

// Esta segunda parte do código também configura um listener de eventos para mensagens recebidas pela janela.
// Assim como a primeira parte, ele verifica a origem da mensagem por segurança.
window.addEventListener('message', function(event) {
    if (event.origin === window.location.origin) {
        // Se a origem for a mesma, os dados do pedido são parseados do JSON.
        const dadosPedido = JSON.parse(event.data);
        // E uma função chamada 'preencherNotaFiscal' é chamada com esses dados.
        preencherNotaFiscal(dadosPedido);
    }
});
// Este comentário indica o propósito da função 'preencherNotaFiscal': buscar e exibir os dados do pedido para a nota fiscal.
function preencherNotaFiscal(dadosPedido) {
    // Esta linha define o conteúdo de texto do elemento com o ID 'data-pedido' para a data atual formatada localmente.
    document.getElementById('data-pedido').textContent = new Date().toLocaleDateString();
    // Estas duas linhas definem o conteúdo de texto dos elementos com os IDs 'nome-cliente' e 'endereco-cliente' com valores fixos.
    // É importante notar que estes valores ('Nome do Cliente' e 'Endereço do Cliente') são placeholders e precisariam ser substituídos pelos dados reais do cliente.
    document.getElementById('nome-cliente').textContent = 'Nome do Cliente'; // Substitua pelo nome real
    document.getElementById('endereco-cliente').textContent = 'Endereço do Cliente'; // Substitua pelo endereço real

    // Esta linha obtém uma referência ao elemento HTML com o ID 'lista-itens', que presumivelmente é uma tabela (<tbody>) onde os itens do pedido serão listados.
    const listaItens = document.getElementById('lista-itens');

    // Esta linha itera sobre o array 'carrinho' dentro do objeto 'dadosPedido', fornecendo tanto o item quanto seu índice.
    dadosPedido.carrinho.forEach((item, index) => {
        // Para cada item no carrinho, um novo elemento de linha de tabela (<tr>) é criado.
        const tr = document.createElement('tr');
        // O conteúdo HTML desta linha é definido usando template literals.
        // Ele cria células de tabela (<td>) para o número do item (índice + 1), nome do item e preço (formatado para duas casas decimais).
        tr.innerHTML = `
            <td>${index + 1}</td>
            <td>${item.nome}</td>
            <td>R$ ${item.preco.toFixed(2)}</td>
            <td>R$ ${item.preco.toFixed(2)}</td>
        `;
        // A linha de tabela criada é então adicionada como um filho ao elemento 'listaItens' (o <tbody> da tabela).
        listaItens.appendChild(tr);
    });

    // Finalmente, esta linha define o conteúdo de texto do elemento com o ID 'total-pedido' para o valor total do pedido, formatado para duas casas decimais.
    document.getElementById('total-pedido').textContent = dadosPedido.total.toFixed(2);
}