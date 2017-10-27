<?php

use PHPUnit\Framework\TestCase;
use Transfer\TransferAction;
use Transfer\Outputs;

final class TransferActionTest extends TestCase {

    function testTransferSuccess() {
        $result = new Outputs();
        $transferAction = new TransferAction('1111111111','Test','1234567890',5000);
        $tOutput = $transferAction->doTransfer();
        $result->accountBalance = 15000;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testBalanceCannotWithdraw() {
        $result = new Outputs();
        $transferAction = new TransferAction('1111111111','Test','1234567890',50000);
        $tOutput = $transferAction->doTransfer();
        $result->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testDestinationNumberNotFoundInDatabase() {
        $result = new Outputs();
        $transferAction = new TransferAction('1111111111','Test','2222222222',5000);
        $tOutput = $transferAction->doTransfer();
        $result->errorMessage = "ไม่พบหมายเลขบัญชีนี้ภายในระบบ CU Bank";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

}