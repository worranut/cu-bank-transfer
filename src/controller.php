<?php

require_once "../vendor/autoload.php";

use Operation\Transfer;
use Operation\WithdrawalStub;
use Operation\DepositStub;
require_once __DIR__.'./../src/Transfer.php';
require_once __DIR__.'./../src/WithdrawalStub.php';
require_once __DIR__.'./../src/DepositStub.php';

$service = $_POST["service"];

if ($service == "Transfer"){
  $transaction = $_POST["transaction"];
  if(isset($transaction["srcNumber"]) && $transaction["targetNumber"] && $transaction["amount"]) {
      $transfer = new Transfer($transaction["srcNumber"],WithdrawalStub::class,DepositStub::class);
      echo json_encode($transfer->doTransfer($transaction["targetNumber"],$transaction["amount"]));
  }
}

