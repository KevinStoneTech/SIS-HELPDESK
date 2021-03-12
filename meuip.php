<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //se possível, obtém o endereço ip da máquina do cliente
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //verifica se o ip está passando pelo proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
exec('wmic COMPUTERSYSTEM Get UserName', $user);
//print_r($user[1]);
$tabacces = "acesso";
$dtacces = date("d/m/Y");
$hracces = date("H:i:s");
$tabcontrol = "controleip";
?>