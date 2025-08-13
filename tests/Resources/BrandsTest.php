<?php

namespace Tests\Resources;

use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class BrandsTest extends TestCase
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
        $params = (new BrandCreateParams);
        $result = $this->client->brands->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->brands->retrieve('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new BrandUpdateParams);
        $result = $this->client->brands->update('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->brands->list();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateImages(): void
    {
        $result = $this->client->brands->updateImages('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
