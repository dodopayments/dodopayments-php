<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class AddonsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->addons->create(
            currency: Currency::AED,
            name: 'name',
            price: 0,
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->addons->create(
            currency: Currency::AED,
            name: 'name',
            price: 0,
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
            description: 'description',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->addons->retrieve('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->addons->update('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->addons->list();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateImages(): void
    {
        $result = $this->client->addons->updateImages('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
