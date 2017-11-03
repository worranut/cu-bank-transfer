<?php namespace MainDriver;

use Operation\TransferView;

final class MainDriver {
    public function transfer(string $srcNumber,string $targetNumber,int $amount): void {
        $transfer = new Transfer($srcNumber,Withdrawal::class,DepositService::class);
    	$transfer->doTransfer($targetNumber,$amount);
    }
}