<?php
include 'config.php';
session_start();
$message = '';

function lUser($username, $senha){

    global $conn;

    $query = "SELECT * FROM users WHERE nome ='$username'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nome'] = $username;
            header("Location: catalog.php");
            exit();
            }else{
                return "Senha incorreta";
            }
        }else{
            return "Usuario não encontrado";
        }
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nome'];
    $senha = $_POST['senha'];
    $message = lUser($username, $senha);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Do usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="./haha/icone.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h1>Logar conta</h1>
        <form action="login.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required>

        <?php if ($message === "Usuario não encontrado") : ?>
            <div style="margin-top: 5px;"><?= $message ?></div>
            <?php endif; ?>

        <input type="password" name="senha" placeholder="Senha" required>

            <?php if($message === "Senha incorreta") : ?>
                <div style="color: red;"><?= $message ?></div>
                <?php endif; ?>

        <button type="submit" name="login">Logar</button>

        <label>Não possui uma conta? cadastre já</label>
        <a href="register.php">Cadastrar</a>
        </form>
    </div>

</body>
</html>

