<?php namespace Transfer;

use Transfer\Outputs;

final class WithdrawalStub {
    
    public function withdraw(string $accNumber,int $amount): Outputs { 
        $accountBalance = 20000;
        $output = new Outputs();
        $output->accountNumber = $accNumber;
        $output->accountName = "Test";
        if($accountBalance - $amount >= 0) {
            $output->accountBalance = $accountBalance - $amount;
        } else {
            $output->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        }
        
        return $output;
    }
}