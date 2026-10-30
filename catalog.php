<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="main2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="./haha/icone.png" type="image/x-icon">
    <link rel="stylesheet" href="catalog.css">
</head>
<body>
    <header>
        <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
            <img class="fodinha" src="./haha/icone.png" alt="Bootstrap" width="30" height="30"> LojaTec
          </a>
        <h1>Bem-vindo de volta, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
        <a class="deslogar" href="logout.php">Deslogar</a>
        </div>
        </div>
        </nav>
    </header>

    <main>
        
        <div class="container text-center" id="produtos">
        <h2>Produtos</h2>
            <div class="row gx-5">
                <?php
                
                $produtos = include 'produtos.php';
                if (is_array($produtos)) {
                    foreach ($produtos as $produto) {
                        echo '<div class="col-md-4 mb-4" for="foda">';
                        echo '<img class="img-fluid" src="' . $produto['imagem'] . '" alt="' . $produto['nome'] . '">';
                        echo '<span>' . $produto['nome'] . '</span>';
                        echo '<span>R$ ' . number_format($produto['preco'], 2, ',', '.') . '</span>';
                        echo '<div class="btn-container">';
                        echo '<button class="butao" onclick="adicionarProduto(\'' . $produto['nome'] . '\', ' . $produto['preco'] . ', \'' . $produto['imagem'] . '\')">Adicionar ao Carrinho</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Erro: Não foi possível carregar os produtos.</p>";
                }
                ?>
            </div>
        </div>
        <div id="carrinho-tab" onclick="toggleCarrinho()"></div>
        <div id="carrinho">
        
            <ul id="lista-carrinho"></ul>
            <p>Total: R$ <span id="total-carrinho">0</span></p>
            <div id="paypal-button-container"></div>
        </div>
    </main>
    
    <footer>
      &copy 2024 LojaTec com todos os direitos reservados
    </footer>

    <script src="https://www.paypal.com/sdk/js?client-id=AXVnoDauJh5h_cvCRlvFQD-O5U_M6ZuzJ5Fd4VBBS3IvaqTUMh8y-Ty4KOfLti6bCQKjRaQ4cFI3SX2-&currency=BRL"></script>
    <script src="main.js"></script>
</body>
</html>
