<?php

namespace Tests\Services\ProductCollections;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\ProductCollections\Groups\GroupNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class GroupsTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->productCollections->groups->create(
            'id',
            products: [['productID' => 'product_id']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GroupNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->productCollections->groups->create(
            'id',
            products: [['productID' => 'product_id', 'status' => true]],
            groupName: 'group_name',
            status: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GroupNewResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->productCollections->groups->update(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->productCollections->groups->update(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            id: 'id',
            groupName: 'group_name',
            productOrder: ['182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'],
            status: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->productCollections->groups->delete(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->productCollections->groups->delete(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
