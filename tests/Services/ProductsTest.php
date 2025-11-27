<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductUpdateFilesResponse;
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
        $result = $this->client->products->create([
            'name' => 'name',
            'price' => [
                'currency' => 'AED',
                'discount' => 0,
                'price' => 0,
                'purchasing_power_parity' => true,
                'type' => 'one_time_price',
            ],
            'tax_category' => 'digital_products',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Product::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->products->create([
            'name' => 'name',
            'price' => [
                'currency' => 'AED',
                'discount' => 0,
                'price' => 0,
                'purchasing_power_parity' => true,
                'type' => 'one_time_price',
                'pay_what_you_want' => true,
                'suggested_price' => 0,
                'tax_inclusive' => true,
            ],
            'tax_category' => 'digital_products',
            'addons' => ['string'],
            'brand_id' => 'brand_id',
            'description' => 'description',
            'digital_product_delivery' => [
                'external_url' => 'external_url', 'instructions' => 'instructions',
            ],
            'license_key_activation_message' => 'license_key_activation_message',
            'license_key_activations_limit' => 0,
            'license_key_duration' => ['count' => 0, 'interval' => 'Day'],
            'license_key_enabled' => true,
            'metadata' => ['foo' => 'string'],
        ]);

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
        $result = $this->client->products->update('id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->products->list([]);

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
        $result = $this->client->products->updateFiles(
            'id',
            ['file_name' => 'file_name']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductUpdateFilesResponse::class, $result);
    }

    #[Test]
    public function testUpdateFilesWithOptionalParams(): void
    {
        $result = $this->client->products->updateFiles(
            'id',
            ['file_name' => 'file_name']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductUpdateFilesResponse::class, $result);
    }
}
