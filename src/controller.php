<?php

require_once "../vendor/autoload.php";

use Transfer\Transfer;
use Transfer\Outputs;

if(isset($_POST['srcNumber']) && $_POST['targetNumber'] && $_POST['amount']) {
    $srcNumber = $_POST['srcNumber'];
    $targetNumber = $_POST['targetNumber'];
    $amount = $_POST['amount'];
    
    $transfer = new Transfer($srcNumber);
    
    echo json_encode($transfer->doTransfer($targetNumber,$amount));
}

if(isset($_GET['accNo'])) {
    $output = new Outputs();
    $output->accountNumber = "1234567890";
    $output->accountName = "test name";
    $output->accountBalance = 20000;
    echo json_encode($output);
}