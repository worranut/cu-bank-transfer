<?php namespace Transfer;

use Transfer\Outputs;

final class DepositStub {
    public function deposit(string $accNumber,int $amount): Outputs { 
        $mockAccNumber = "1234567890";
        $output = new Outputs();
        if($mockAccNumber == $accNumber) {
            $output->accNumber = $mockAccNumber;
        } else {
            $output->errorMessage = "ไม่พบหมายเลขบัญชีนี้ภายในระบบ CU Bank";
        }
        return $output;
    }
}