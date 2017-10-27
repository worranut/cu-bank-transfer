<?php namespace MainDriver;

use Transfer\TransferView;

final class MainDriver {
    public function transfer(string $accNumber,string $accName,int $accBalance): void { 
        $transfer = new TransferView($accNumber, $accName, $accBalance);
        $transfer->showView();
    }
}