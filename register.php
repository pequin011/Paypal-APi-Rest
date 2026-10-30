<?php
include 'config.php';
function rUser($username, $senha, $email, $cpf, $telefone){
    global $conn;

    $hashePass = password_hash($senha,PASSWORD_DEFAULT);
    $query = "SELECT * FROM users WHERE nome = '$username'";

    $cUser = mysqli_query($conn, "SELECT * FROM users where nome ='$username' ");
    if(mysqli_num_rows($cUser) >= 1){
        return "<h1 id='ixistente'> Já existe um usuario com esse nome.". "</h1>";
    }
    $cEemail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if(mysqli_num_rows($cEemail) >= 1){
        echo "email já cadastrado. Tente novamente.";
    }
// TA ERRADO TEM QUE MUDARRRRR só a header ali em baixo emmmm
    $query = "INSERT INTO users(nome, senha, email, cpf, telefone) VALUES ('$username','$hashePass','$email','$cpf','$telefone')";
    if(mysqli_query($conn,$query)){
        // tem que mudar isso aqui jaja SE DER ERRO ESTÁ NA LINHA DE BAIXO LEEEEEGALLEGAL
        header("location: login.php");
        exit();
    }else{
        echo "Erro ao cadastra usuario. tente novamente";
        return false;
    }
}

if(isset($_POST['register'])){
    $username = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    rUser($username, $senha, $email, $cpf, $telefone);
    header("location: login.php");
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="./haha/icone.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav></nav>
    </header>

    <main>
    <div class="container">
        <form action="register.php" method="post">
            <h1>Cadastre uma conta</h1>
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="text" name="email" placeholder="123@gmail.com" required>
            <input type="text" name="cpf" placeholder="000.000.000-00" required>
            <input type="text" name="telefone" placeholder="Telefone" required>
            <button type="submit" name="register">Cadastrar</button>

            <label>Ja possui uma conta?</label>
            <a href="login.php">Logar</a>

        </form>
    </div>
    </main>
    
    

</body>
</html>