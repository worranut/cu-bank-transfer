<?php namespace Transfer;

use Transfer\Outputs;
use Transfer\WithdrawalStub;
use Transfer\DepositStub;

class Transfer {
    private $srcNumber;

    public function __construct(string $srcNumber){
        $this->srcNumber = $srcNumber;
    }

    public function doTransfer(string $desNumber,int $amount): Outputs {
        $output = new Outputs();
        $output->sourceAccountNumber = $this->srcNumber;

        $withdrawalStub = new WithdrawalStub($this->srcNumber);
        $wOutput = $withdrawalStub->withdraw($amount);
        if($wOutput->errorMessage == null) {
            $output->accountBalance = $wOutput->accountBalance;

            $depositStub = new DepositStub($desNumber);
            $dOutput = $depositStub->deposit($amount);
            if($dOutput->errorMessage != null) {
                $output->errorMessage = $dOutput->errorMessage;
            }
        } else {
            $output->errorMessage = $wOutput->errorMessage;
        }
        return $output;
    }

}