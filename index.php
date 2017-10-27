<?php 
//include 'src/Transfer.php'; 
require_once "vendor/autoload.php";
use Transfer\TransferView;

$transferView = new TransferView("1111111111",'Name Test',20000);
$transferView->showView();
?>