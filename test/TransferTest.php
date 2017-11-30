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

    function testTransferMinus() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',-1);
        $result->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testTransferZero() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',0);
        $result->errorMessage = "จำนวนเงินไม่ถูกต้อง กรุณาตรวจสอบ";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testTransferOne() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',1);
        $result->accountBalance = 1999999;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testTransferTwo() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',2);
        $result->accountBalance = 1999998;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testTransferHalf() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',50000);
        $result->accountBalance = 1950000;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testTransferMaxMinus() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',99999);
        $result->accountBalance = 1900001;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testTransferMax() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',100000);
        $result->accountBalance = 1900000;
        $this->assertEquals($tOutput->accountBalance, $result->accountBalance);
    }

    function testTransferMaxOver() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',100001);
        $result->errorMessage = "จำนวนเงินถอนในแต่ละครั้งต้องไม่เกิน 100,000 บาท";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testDestinationNumberNotFoundInDatabase() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('2222222222',50000);
        $result->errorMessage = "ไม่พบหมายเลขบัญชีนี้ภายในระบบ CU Bank";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testOwnAccount() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1111111111',50000);
        $result->errorMessage = "บัญชีที่เลือกไม่สามารถเป็นบัญชีรับโอนได้";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testTransferString() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890','500A');
        $result->errorMessage = "จำนวนเงินที่ต้องการถอนต้องเป็นตัวเลขเท่านั้น";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }

    function testTransferFloat() {
        $result = new Outputs();
        $transfer = new Transfer('1111111111',WithdrawalStub::class,DepositStub::class);
        $tOutput = $transfer->doTransfer('1234567890',500.50);
        $result->errorMessage = "จำนวนเงินที่ต้องการถอนต้องเป็นตัวเลขจำนวนเต็มที่มีค่ามากกว่า 0 เท่านั้น";
        $this->assertEquals($tOutput->errorMessage, $result->errorMessage);
    }
}