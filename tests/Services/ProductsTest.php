<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ProductsTest extends TestCase
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
        $result = $this->client->products->create(
            price: OneTimePrice::with(
                currency: Currency::AED,
                discount: 0,
                price: 0,
                purchasingPowerParity: true,
                type: 'one_time_price',
            ),
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->products->create(
            price: OneTimePrice::with(
                currency: Currency::AED,
                discount: 0,
                price: 0,
                purchasingPowerParity: true,
                type: 'one_time_price',
            )
                ->withPayWhatYouWant(true)
                ->withSuggestedPrice(0)
                ->withTaxInclusive(true),
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->products->retrieve('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->products->update('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->products->list();

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->products->archive('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUnarchive(): void
    {
        $result = $this->client->products->unarchive('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdateFiles(): void
    {
        $result = $this->client->products->updateFiles('id', 'file_name');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdateFilesWithOptionalParams(): void
    {
        $result = $this->client->products->updateFiles('id', 'file_name');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
