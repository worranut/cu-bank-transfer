<?php namespace Transfer;

use Transfer\Outputs;

class TransferAction {
    private $srcNumber,$targetNumber,$amount;

    public function __construct(string $srcNumber,string $targetNumber,int $amount){
        $this->srcNumber = $srcNumber;
        $this->targetNumber = $targetNumber;
        $this->amount = $amount;
    }

    public function doTransfer(): Outputs { 
        $output = new Outputs();
        $output->accountNumber = $this->srcNumber;

        return $output;
    }

}