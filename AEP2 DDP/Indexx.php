<?php
include_once 'Classes/Pessoa.php';

$nome = $_POST['nome'];
$Data_Nasc = $_POST['data'];
$CPF = $_POST['CPF'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];


if(strpos($altura, ".")){
    //print_R("TEM PONTO!");
    
}else {
    die("Altura não contem Ponto");
}

if(is_numeric($nome)){
    die("Nome não pode ser numero");
}

$pessoa = new pessoa($nome, $Data_Nasc, $CPF, $altura, $peso);
$Imc = $pessoa->calculaImc();
$Idade = $pessoa->calculaIdade();

$bool = $pessoa->validaCPF($CPF);

if ($bool){
    echo "Seu nome é: $nome <br>";
    echo "Sua idade é: $Idade <br>";
    echo "Seu Imc é: $Imc[0] e sua classificação é $Imc[1] <br>";
}else{
    echo 'CPF INVALIDO!!!';
}
