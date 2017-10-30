<?php

use PHPUnit\Framework\TestCase;
use Transfer\Transfer;
use Transfer\Outputs;

final class TransferTest extends TestCase {

    function testTransferSuccess() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',5000);
        $result->accountBalance = $transfer->getAccountBalance();
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

    function testMinusAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',-1);
        $result->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testZeroAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',0);
        $result->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testMaxAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',20000);
        $result->accountBalance = $transfer->getAccountBalance();
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testNormAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',10000);
        $result->accountBalance = $transfer->getAccountBalance();
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testMaxOverAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111','Test');
        $tOutput = $transfer->doTransfer('1234567890',20001);
        $result->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

}