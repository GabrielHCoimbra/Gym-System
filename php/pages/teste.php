<?php
$mes = date('d/m/Y');
$mes = substr($mes, 3, 2);
switch ($mes) {
    case '01':
        $mes= 'Jan';
        break;
    case '02':
        $mes= 'Fev';
        break;
    case '03':
        $mes= 'Mar';
        break;
    case '04':
        $mes= 'Abr';
        break;
    case '05':
        $mes= 'Mai';
        break;
    case '06':
        $mes= 'Jun';
        break;
    case '07':
        $mes= 'Jul';
        break;
    case '08':
        $mes= 'Ago';
        break;
    case '09':
        $mes= 'Sete';
        break;
    case '10':
        $mes= 'Outu';
        break;
    case '11':
        $mes= 'Nov';
        break;
    case '12':
        $mes= 'Dez';
        break;
    
    default:
        
        break;
}
echo $mes;
?>