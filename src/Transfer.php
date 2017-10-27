<?php namespace Transfer;

use Transfer\Outputs;
use Transfer\WithdrawalStub;
use Transfer\DepositStub;

class Transfer {
    private $srcNumber,$srcName;

    public function __construct(string $srcNumber,string $srcName){
        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;
    }

    public function doTransfer(string $desNumber,int $amount): Outputs {
        $output = new Outputs();
        $output->sourceAccountNumber = $this->srcNumber;
        $output->accountName = $this->srcName;

        $withdrawalStub = new WithdrawalStub();
        $wOutput = $withdrawalStub->withdraw($this->srcNumber,$amount);
        if($wOutput->errorMessage == null) {
            $output->accountBalance = $wOutput->accountBalance;

            $depositStub = new DepositStub();
            $dOutput = $depositStub->deposit($desNumber,$amount);
            if($dOutput->errorMessage != null) {
                $output->errorMessage = $dOutput->errorMessage;
            }
        } else {
            $output->errorMessage = $wOutput->errorMessage;
        }
        return $output;
    }

}