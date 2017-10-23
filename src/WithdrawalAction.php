<?php namespace Transfer;

class WithdrawalAction {
    public function doWithdrawal(string $accNumber,int $amount): array { 
        $output = array('balance' => 0,'errorMsg'=> '' );
        // Do something
        return $output;
    }
}