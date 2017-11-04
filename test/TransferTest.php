<?php

use PHPUnit\Framework\TestCase;
use Operation\Transfer;
use Operation\WithdrawalStub;
use Operation\DepositStub;
use Output\Outputs;

require_once __DIR__.'./../src/Outputs.php';
require_once __DIR__.'./../src/Transfer.php';
require_once __DIR__.'./../src/WithdrawalStub.php';
require_once __DIR__.'./../src/DepositStub.php';

final class TransferTest extends TestCase {

    function testTransferSuccess() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',5000);
        $result->accountBalance = 15000;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testBalanceCannotWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',50000);
        $result->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testDestinationNumberNotFoundInDatabase() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('2222222222',5000);
        $result->errorMessage = "ไม่พบหมายเลขบัญชีนี้ภายในระบบ CU Bank";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testOwnAccount() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1111111111',5000);
        $result->errorMessage = "บัญชีที่เลือกไม่สามารถเป็นบัญชีรับโอนได้";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testMinusAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',-1);
        $result->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testZeroAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',0);
        $result->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testMaxAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',20000);
        $result->accountBalance = 0;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testNormAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',10000);
        $result->accountBalance = 10000;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testMaxOverAmountForWithdraw() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',20001);
        $result->errorMessage = "ยอดเงินในบัญชีไม่เพียงพอ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

}