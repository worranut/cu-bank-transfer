<?php

use PHPUnit\Framework\TestCase;
use Transfer\Transfer;
use Transfer\Outputs;

final class TransferTest extends TestCase {
    function testDoTransfer() {
        $result = new Outputs();
        $transfer = new Transfer('1234567890','0987654321',100);
        $result->accountNumber = '1234567890';
        $this->assertEquals($transfer->doTransfer(), $result);
    }
}