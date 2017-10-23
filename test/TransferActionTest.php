<?php

use PHPUnit\Framework\TestCase;
use Transfer\TransferAction;
use Transfer\Outputs;

final class TransferActionTest extends TestCase {

    function testDoTransfer() {
        $result = new Outputs();
        $transferAction = new TransferAction('1234567890','0987654321',100);
        $result->accountNumber = '1234567890';
        $this->assertEquals($transferAction->doTransfer(), $result);
    }


}