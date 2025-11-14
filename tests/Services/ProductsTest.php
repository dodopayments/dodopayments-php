<?php

namespace Tests\Services;

use Dodopayments\Client;
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
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
        ]);

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
        $result = $this->client->products->update('id', []);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->products->list([]);

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
        $result = $this->client->products->updateFiles(
            'id',
            ['file_name' => 'file_name']
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdateFilesWithOptionalParams(): void
    {
        $result = $this->client->products->updateFiles(
            'id',
            ['file_name' => 'file_name']
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
