<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav></nav>
    </header>

    <main>
        <h1>Produtos</h1>
        <div id="produtos">
            <div class="produtos-container">
                <?php

                $produtos = include 'produtos.php';
                if(is_array($produtos)){
                    foreach($produtos as $produto){
                        echo '<div class="produto-card">';
                        echo '<img src="' . $produto['imagem'] . '" alt="' . $produto['nome'] . '">';
                        echo '<span>' . $produto['nome'] . '</span>';
                        echo '<span>R$ ' . number_format($produto['preco'], 2, ',', '.') . '</span>';
                        echo '<div class="btn-container">';
                        echo '<button onclick="adicionarProduto(\'' . $produto['nome'] . '\', ' . $produto['preco'] . ', \'' . $produto['imagem'] . '\')">Adicionar ao Carrinho</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                }else{
                    echo "<p>Erro: Não foi possivel carregar os produtos. </p>";
                }
                ?>
            </div>
        </div>
                <div id="carrinho-tab" onclick="toggleCarrinho()"></div>
                <div id="carrinho">
                    <h2>Carrinho de compras</h2>
                    <ul id="lista-carrinho"></ul>
                    <p>Total: R$ <span id="total-carrinho">0</span></p>
                    <div id="paypal-button-container"></div>
                </div>
    </main>


    <script src="main.js"></script>
</body>
</html>