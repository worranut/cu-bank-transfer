<?php namespace Operation;

use Output\Outputs;

final class WithdrawalStub {
    private $accNumber,$accountBalance;

    public function __construct(string $accNumber){
        $this->accNumber = $accNumber;
    }
    
    public function withdraw(string $amount): Outputs { 
        $accountBalance = 2000000;
        $output = new Outputs();
        $output->accountNumber = $this->accNumber;
        $output->accountName = "Test";
        if(is_numeric($amount) == false) {
            $output->errorMessage = "จำนวนเงินที่ต้องการถอนต้องเป็นตัวเลขเท่านั้น";
        } elseif (is_float($amount+0)) {
            $output->errorMessage = "จำนวนเงินที่ต้องการถอนต้องเป็นตัวเลขจำนวนเต็มที่มีค่ามากกว่า 0 เท่านั้น";
        } elseif($amount <= 0) {
            $output->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        } elseif ($amount > 100000) {
            $output->errorMessage = "จำนวนเงินถอนในแต่ละครั้งต้องไม่เกิน 100,000 บาท";
        } else {
            if($accountBalance - $amount >= 0) {
                $output->accountBalance = $accountBalance - $amount;
            } else {
                $output->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
            }
        }
        return $output;
    }
    
    public function getAccountBalance(): int {
        return $this->accountBalance;
    }
}