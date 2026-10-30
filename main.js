let carrinho = [];

function toggleCarrinho(){
    const carrinhoDiv = document.getElementById('carrinho');
    if (carrinhoDiv.style.display === 'none' || carrinhoDiv.style.display === ''){
        carrinhoDiv.style.display = 'block';
    }else{
        carrinhoDiv.style.display = 'none';
    }
}

function adicionarProduto(nome,preco,imagem){
    carrinho.push({ nome, preco, imagem});
    atualizarCarrinho();
}

function removerProduto(index){
    carrinho.splice(index,1);
    atualizarCarrinho();
}

function atualizarCarrinho(){
    const listaCarrinho = document.getElementById("lista-carrinho");
    listaCarrinho.innerHTML = "";

    carrinho.forEach((produto, index) =>{
        const li = document.createElement("li");
        li.innerHTML = `
        <img src="${produto.imagem}" alt="${produto.nome}" style="width: 50px; height: auto;">
        <span>${produto.nome}</span>
        <span>R$ ${produto.preco.toFixed(2).replace(',','.')}</span>
        <button class="butao" onclick="removerProduto(${index})">Remover</button>
        `;
        listaCarrinho.appendChild(li);
    });

    const totalCarrinho = document.getElementById("total-carrinho");
    const total = carrinho.reduce((total, produto) => total + produto.preco, 0);
    totalCarrinho.innerText = total.toFixed(2).replace(',',',');

    const carrinhoDiv = document.getElementById('carrinho');
    carrinhoDiv.style.display = carrinho.length >0 ? 'block' : 'none';
}

(function (){
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: 'BRL',
                        value: carrinho.reduce((total,produto) => total + produto.preco, 0 ).toFixed(2)
                    }
                }]
            });
        },
        onApprove: function(data,action){
            return actions.order.capture().then(function(details){
                console.log('pagamento realizado com sucesso!');
                console.log(details);
                carrinho = [];
                atualizarCarrinho();
            });
        },
        onError: function(err){
            console.error ('ocorreu um erro durante o pagamento', err);
        }
    }).render('#paypal-button-container');
})();