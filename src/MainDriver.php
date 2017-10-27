<?php namespace MainDriver;

use Transfer\Transfer;

final class MainDriver {
    public function transfer(string $accNumber,string $accName,int $accBalance): void { 
        $transfer = new Transfer($accNumber, $accName, $accBalance);
        $transfer->showView();
    }
}