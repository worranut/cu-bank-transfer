<?php namespace Transfer;

use Transfer\Outputs;

final class WithdrawalStub {
    private $accNumber;

    public function __construct(string $accNumber){
        $this->accNumber = $accNumber;
    }
    
    public function withdraw(int $amount): Outputs { 
        $accountBalance = 20000;
        $output = new Outputs();
        $output->accountNumber = $this->accNumber;
        $output->accountName = "Test";
        if($accountBalance - $amount >= 0) {
            $output->accountBalance = $accountBalance - $amount;
        } else {
            $output->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        }
        
        return $output;
    }
}