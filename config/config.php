<?php 

define("CLIENT_ID", "ARQXpPt3VwgD9C9XTywkYv_Ldbmm8QvlsJRTBUueQYluh-PbruufTGfAp1pt1pmtloAOM7s8tfyJX6J7");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "ARP.esc");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>