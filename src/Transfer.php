<?php namespace Transfer;

use Transfer\Outputs;

class Transfer {
    private $accNumber,$accName,$accBalance;

    public function __construct(string $accNumber,string $accName,int $accBalance){
        $this->accNumber = $accNumber;
        $this->accName = $accName;
        $this->accBalance = $accBalance;
    }

    public function showView() {
        $viewName = 'view/transfer.php';
        include $viewName;
    }
}