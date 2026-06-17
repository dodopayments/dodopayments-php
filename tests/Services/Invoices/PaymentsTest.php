<?php

namespace Tests\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class PaymentsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->invoices->payments->retrieve(
            'pay_gr4RizvMOXFJ6xca3y2tU'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testRetrievePayout(): void
    {
        $result = $this->client->invoices->payments->retrievePayout(
            'pyt_zFTrrn4sk3x3y2vjDBW3T'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testRetrieveRefund(): void
    {
        $result = $this->client->invoices->payments->retrieveRefund(
            'ref_F0gZetLvTxxBrMU2CZcmy'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }
}
