<?php

class Pessoa
{
    private $nome;
    private $Data_Nasc;
    private $CPF;
    private $altura;
    private $peso;


    public function __construct($nome, $Data_Nasc, $CPF, $altura, $peso)
    {
        $this->nome = $nome;
        $this->Data_Nasc = $Data_Nasc;
        
        if($this->validaCPF($CPF))
        {
            $this->CPF = $CPF;
        }
        
        $this->altura = $altura;
        $this->peso = $peso;
    }

    public function calculaImc()
    {
        $altura = $this->altura;
        $peso = $this->peso;
        
        $altura = $altura * $altura;
        $Imc = $peso / $altura;
        
        if ($Imc < 18.5)
        {
            $msg = "MAGREZA";
        }else if ($Imc > 18.5 && $Imc < 24.9)
        {
            $msg = "NORMAL";
        }else if ($Imc > 25.0 && $Imc < 29.9)
        {
            $msg = "SOBREPESO";
        }else if ($Imc > 30.0 && $Imc < 39.9)
        {
            $msg = "OBESIDADE";
        }else if ($Imc > 40.0)
        {
            $msg = "OBESIDADE GRAVE";
        }else 
        {
            $msg = "ERROR!";
        }
        
        $array[0] = $Imc;
        $array[1] = $msg;

        return $array;
    }

    public function calculaIdade()
    {
        $data = $this->Data_Nasc;

        list($ano, $dia, $mes) = explode('-', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        return $idade;
    }
   
    
    public function validaCPF($cpf)
    {

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999')
            {
                return false;
            } else {
                $val1= $cpf[0] * 10 + $cpf[1] * 9 + $cpf[2] * 8 + $cpf[3] * 7 + $cpf[4] * 6 + $cpf[5] * 5 + $cpf[6] * 4 + $cpf[7] * 3 + $cpf[8] * 2;
                //print_r($val1);
                $val1 = $val1 * 10 % 11;
                //print_r($val1);
                

                $val2= $cpf[0] * 11 + $cpf[1] * 10 + $cpf[2] * 9 + $cpf[3] * 8 + $cpf[4] * 7 + $cpf[5] * 6 + $cpf[6] * 5 + $cpf[7] * 4 + $cpf[8] * 3 + $cpf[9] * 2;
                
                $val2 = $val2 * 10 % 11;
                
                //print_r($val1);
                //print_r($cpf[9]);
                if ($val1 == $cpf[9])
                {
                    //print_r("VAL1 É TRUE");
                    $val1 = true;
                }else{
                    //print_r("VAL1 É FALSE");
                    $val1 = false;
                }

                if ($val2 == $cpf[10])
                {
                    $val2 = true;
                }else {
                    $val2 = false;
                }

                if ($val1 == true && $val2 == true)
                {
                    //print_r("PASSEI NA CONDIÇAO");
                    return true;
                }else {
                    return false;
                }

            
            }
    }


}