<?php 
//include 'src/Transfer.php'; 
require_once "vendor/autoload.php";
use Transfer\Transfer;

$transfer = new Transfer("1234567890",'Name Test',25000);
$transfer->showView();
?>