<?php

use PHPUnit\Framework\TestCase;
use Output\Outputs;

require_once __DIR__.'./../src/Outputs.php';

final class OutputsTest extends TestCase {
    function testAssignValueToAccountNumber() {
        $result = new Outputs();
        $result->accountNumber = '1234567890';
        $this->assertEquals('1234567890', $result->accountNumber);
    }

    function testAssignValueToAccountName() {
        $result = new Outputs();
        $result->accountName = 'Kittisak Phetrungnapha';
        $this->assertEquals('Kittisak Phetrungnapha', $result->accountName);
    }

    function testAssignValueToAccountBalance() {
        $result = new Outputs();
        $result->accountBalance = 10000;
        $this->assertEquals(10000, $result->accountBalance);
    }

    function testAssignValueToSourceAccountNumber() {
        $result = new Outputs();
        $result->sourceAccountNumber = '1234567890';
        $this->assertEquals('1234567890', $result->sourceAccountNumber);
    }

    function testAssignValueToWaterCharge() {
        $result = new Outputs();
        $result->waterCharge = 100;
        $this->assertEquals(100, $result->waterCharge);
    }

    function testAssignValueToElectricCharge() {
        $result = new Outputs();
        $result->electricCharge = 1000;
        $this->assertEquals(1000, $result->electricCharge);
    }

    function testAssignValueToPhoneCharge() {
        $result = new Outputs();
        $result->phoneCharge = 500;
        $this->assertEquals(500, $result->phoneCharge);
    }

    function testAssignValueToErrorMessage() {
        $result = new Outputs();
        $result->errorMessage = 'Something went wrong with your laptop. Please buy a new one!';
        $this->assertEquals('Something went wrong with your laptop. Please buy a new one!', $result->errorMessage);
    }

    function testPropertyIsNull() {
        $result = new Outputs();
        $this->assertEquals(NULL, $result->accountNumber);
    }
}