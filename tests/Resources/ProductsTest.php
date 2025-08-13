<?php

namespace Tests\Resources;

use DodopaymentsClient\Client;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Misc\TaxCategory;
use DodopaymentsClient\Products\LicenseKeyDuration;
use DodopaymentsClient\Products\Price\OneTimePrice;
use DodopaymentsClient\Products\ProductCreateParams;
use DodopaymentsClient\Products\ProductCreateParams\DigitalProductDelivery;
use DodopaymentsClient\Products\ProductListParams;
use DodopaymentsClient\Products\ProductUpdateFilesParams;
use DodopaymentsClient\Products\ProductUpdateParams;
use DodopaymentsClient\Subscriptions\TimeInterval;
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
        $params = ProductCreateParams::from(
            price: OneTimePrice::from(
                currency: Currency::AED,
                discount: 0,
                price: 0,
                purchasingPowerParity: true,
                type: 'one_time_price',
            ),
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
        );
        $result = $this->client->products->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = ProductCreateParams::from(
            price: OneTimePrice::from(
                currency: Currency::AED,
                discount: 0,
                price: 0,
                purchasingPowerParity: true,
                type: 'one_time_price',
            )
                ->setPayWhatYouWant(true)
                ->setSuggestedPrice(0)
                ->setTaxInclusive(true),
            taxCategory: TaxCategory::DIGITAL_PRODUCTS,
            addons: ['string'],
            brandID: 'brand_id',
            description: 'description',
            digitalProductDelivery: (new DigitalProductDelivery)
                ->setExternalURL('external_url')
                ->setInstructions('instructions'),
            licenseKeyActivationMessage: 'license_key_activation_message',
            licenseKeyActivationsLimit: 0,
            licenseKeyDuration: LicenseKeyDuration::from(
                count: 0,
                interval: TimeInterval::DAY
            ),
            licenseKeyEnabled: true,
            metadata: ['foo' => 'string'],
            name: 'name',
        );
        $result = $this->client->products->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->products->retrieve('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new ProductUpdateParams);
        $result = $this->client->products->update('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new ProductListParams);
        $result = $this->client->products->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->products->delete('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUnarchive(): void
    {
        $result = $this->client->products->unarchive('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateFiles(): void
    {
        $params = ProductUpdateFilesParams::from(fileName: 'file_name');
        $result = $this->client->products->updateFiles('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateFilesWithOptionalParams(): void
    {
        $params = ProductUpdateFilesParams::from(fileName: 'file_name');
        $result = $this->client->products->updateFiles('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
