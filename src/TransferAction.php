<?php namespace Transfer;

use Transfer\Outputs;
use Transfer\WithdrawalStub;
use Transfer\DepositStub;

class TransferAction {
    private $srcNumber,$srcName,$desNumber,$amount;

    public function __construct(string $srcNumber,string $srcName,string $desNumber,int $amount){
        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;
        $this->desNumber = $desNumber;
        $this->amount = $amount;
    }

    public function doTransfer(): Outputs {
        $output = new Outputs();
        $output->sourceAccountNumber = $this->srcNumber;
        $output->accountName = $this->srcName;

        $withdrawalStub = new WithdrawalStub();
        $wOutput = $withdrawalStub->withdraw($this->srcNumber,$this->amount);
        if($wOutput->errorMessage == null) {
            $output->accountBalance = $wOutput->accountBalance;

            $depositStub = new DepositStub();
            $dOutput = $depositStub->deposit($this->desNumber,$this->amount);
            if($dOutput->errorMessage != null) {
                $output->errorMessage = $dOutput->errorMessage;
            }
        } else {
            $output->errorMessage = $wOutput->errorMessage;
        }
        return $output;
    }

}