<?php namespace Transfer;

use Transfer\Outputs;

class Transfer {
    private $accNumber,$accName,$amount;

    public function __construct(string $accNumber,string $accName,int $amount){
        $this->accNumber = $accNumber;
        $this->accName = $accName;
        $this->amount = $amount;
    }

    public function showView() {
        $viewName = 'view/transfer.php';
        include $viewName;
    }
}