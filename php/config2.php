<?php 
$host = 'localhost: 3306';
$user = 'root';
$pass = 'Senac@2024';
$db = 'lojatec';

$conn = new mysqli($host,$user,$pass,$db);
/*
if ($conn->connect_error){
    die("erro na conexão:" . $conn->connect_error);
}else{
    echo ("conexão ok!");
}*/

?>