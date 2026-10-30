<?php
include 'config.php';
session_start();

function lUser($username, $senha, $email){

    global $conn;

    $query = "SELECT * FROM users WHERE nome ='$username' AND email = '$email'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)){
        $user = mysqli_fetch_assoc($result);

        if($user['email'] === $email){
            if(password_verify($senha, $user['senha'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nome'] = $username;
                header("Location: catalog.php");
                exit();
            }else{
                echo"Senha incorreta";
                return false;
            }
        }else{
            echo "Usuário não encontrado";
            return false;
        }
    }else{
        echo "Email não encontrado/errado";
        return false;
    }


}if(isset($_POST['login'])){
    $username =$_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    #$cpf = $_POST['cpf'];
    #$telefone = $_POST['telefone'];

    lUser($username, $senha, $email);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login De usuario</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="text" name="email" placeholder="Email" required> 
        <input type="text" name="cpf" placeholder="000.000.000-00" required>
        <input type="text" name="telefone" required>
        <button type="submit" name="login">Logar</button>

        <label id="slakkkkkkkkkkkkkkkkkkkkkkk">Não possui uma conta? cadastre já</label>
        <a href="register.php">Cadastrar</a>
        </form>
    </div>
</body>
</html>

