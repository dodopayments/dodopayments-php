<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductUpdateFilesResponse;
use Dodopayments\Subscriptions\TimeInterval;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
            name: 'name',
            price: [
                'currency' => Currency::AED,
                'discount' => 0,
                'price' => 0,
                'purchasingPowerParity' => true,
                'type' => 'one_time_price',
            ],
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Product::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->products->create(
            name: 'name',
            price: [
                'currency' => Currency::AED,
                'discount' => 0,
                'price' => 0,
                'purchasingPowerParity' => true,
                'type' => 'one_time_price',
                'payWhatYouWant' => true,
                'suggestedPrice' => 0,
                'taxInclusive' => true,
            ],
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
            addons: ['string'],
            brandID: 'brand_id',
            description: 'description',
            digitalProductDelivery: [
                'externalURL' => 'external_url', 'instructions' => 'instructions',
            ],
            licenseKeyActivationMessage: 'license_key_activation_message',
            licenseKeyActivationsLimit: 0,
            licenseKeyDuration: ['count' => 0, 'interval' => TimeInterval::DAY],
            licenseKeyEnabled: true,
            metadata: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Product::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->products->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Product::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->products->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->products->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->products->archive('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnarchive(): void
    {
        $result = $this->client->products->unarchive('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdateFiles(): void
    {
        $result = $this->client->products->updateFiles('id', fileName: 'file_name');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductUpdateFilesResponse::class, $result);
    }

    #[Test]
    public function testUpdateFilesWithOptionalParams(): void
    {
        $result = $this->client->products->updateFiles('id', fileName: 'file_name');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductUpdateFilesResponse::class, $result);
    }
}
