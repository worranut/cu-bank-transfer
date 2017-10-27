<?php

use PHPUnit\Framework\TestCase;
use Transfer\Transfer;
use Transfer\Outputs;

final class TransferTest extends TestCase {

    function testTransferSuccess() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',5000);
        $result->accountBalance = 15000;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testBalanceCannotWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',50000);
        $result->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testDestinationNumberNotFoundInDatabase() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('2222222222',5000);
        $result->errorMessage = "ไม่พบหมายเลขบัญชีนี้ภายในระบบ CU Bank";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

}