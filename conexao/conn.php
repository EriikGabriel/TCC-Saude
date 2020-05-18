<?php
//Iremos solicitar oa PHP que reporte todos os erros quando houver ...
ini_set('display erros', true);// Solicito ao PHP demonstre os erros
error_reporting(E_ALL);

// Criar variáveis para acesso ao banco de dados
$usuario = "";
$senha = "";
$host = "localhost";
$banco = "db_saude";

if($conecta = mysqli_connect($host, $usuario, $senha, $banco)){
   // echo "Conectado ao banco de dados";
    // depois ele arquivou esse echo
}else{
    echo "Deu Merda" .mysqli_connect_error();
}
?>