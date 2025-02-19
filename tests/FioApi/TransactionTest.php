<?php

namespace FioApi;

class TransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testAccountValuesAreProperlySet()
    {
        $transaction = json_decode(file_get_contents(__DIR__.'/data/example-transaction.json'));
        $transaction = Transaction::createFromJson($transaction);

        $this->assertSame('1111111111', $transaction->getId());
        $this->assertEquals(new \DateTime('2015-03-30+0200'), $transaction->getDate());
        $this->assertSame(127.0, $transaction->getAmount());
        $this->assertSame('CZK', $transaction->getCurrency());
        $this->assertSame('214498596', $transaction->getAccountNumber());
        $this->assertSame('2100', $transaction->getBankCode());
        $this->assertSame('0', $transaction->getVariableSymbol());
        $this->assertSame(null, $transaction->getConstantSymbol());
        $this->assertSame(null, $transaction->getSpecificSymbol());
        $this->assertSame('HUJER MARTIN', $transaction->getUserIdentity());
        $this->assertSame('Platba eshop', $transaction->getUserMessage());
        $this->assertSame('Bezhotovostní příjem', $transaction->getTransactionType());
        $this->assertSame(null, $transaction->getPerformedBy());
        $this->assertSame('Comment? Comment!', $transaction->getComment());
        $this->assertSame('1111122222', $transaction->getPaymentOrderId());
        $this->assertSame('1500.00 EUR', $transaction->getSpecification());
    }

    public function testBenefFields()
    {
        $tx = Transaction::create((object) [
            'date'         => new \DateTime(),
            'amount'       => 200.00,
            'currency'     => 'CAD',
            'benefName'    => 'Petr Kramar',
            'benefStreet'  => 'Andelova 12',
            'benefCity'    => 'Ostrava',
            'benefCountry' => 'CZ',
        ]);

        $this->assertEquals('Petr Kramar', $tx->getBenefName());
        $this->assertEquals('Andelova 12', $tx->getBenefStreet());
        $this->assertEquals('Ostrava', $tx->getBenefCity());
        $this->assertEquals('CZ', $tx->getBenefCountry());
    }
}
