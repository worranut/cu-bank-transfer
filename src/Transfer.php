<?php namespace Transfer;

use Transfer\Outputs;
use Transfer\WithdrawalStub;
use Transfer\DepositStub;

class Transfer {
    private $srcNumber, $accountBalance = 20000;

    public function getAccountBalance(): int {
        return $this->accountBalance;
    }

    public function setAccountBalance(int $accountBalance) {
        $this->accountBalance = $accountBalance;
    }

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
            $this->setAccountBalance($wOutput->accountBalance);

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