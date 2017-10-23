<?php namespace Transfer;

class DepositAction {
    public function doDeposit(string $accNumber,int $amount): array { 
        $output = array('isSuccess' => false,'errorMsg'=> '' );
        // Do something
        return $output;
    }
}