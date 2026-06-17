<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\ProductCollections\ProductCollection;
use Dodopayments\ProductCollections\ProductCollectionListResponse;
use Dodopayments\ProductCollections\ProductCollectionUnarchiveResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ProductCollectionsTest extends TestCase
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
        $result = $this->client->productCollections->create(
            groups: [['products' => [['productID' => 'product_id']]]],
            name: 'name'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductCollection::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->productCollections->create(
            groups: [
                [
                    'products' => [['productID' => 'product_id', 'status' => true]],
                    'groupName' => 'group_name',
                    'status' => true,
                ],
            ],
            name: 'name',
            brandID: 'brand_id',
            description: 'description',
            effectiveAtOnDowngrade: 'immediately',
            effectiveAtOnUpgrade: 'immediately',
            onPaymentFailure: 'prevent_change',
            prorationBillingModeOnDowngrade: 'prorated_immediately',
            prorationBillingModeOnUpgrade: 'prorated_immediately',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductCollection::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->productCollections->retrieve(
            'pdc_8BWv0hojwUH7iCDabr0NI'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductCollection::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->productCollections->update(
            'pdc_8BWv0hojwUH7iCDabr0NI'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->productCollections->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ProductCollectionListResponse::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->productCollections->delete(
            'pdc_8BWv0hojwUH7iCDabr0NI'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnarchive(): void
    {
        $result = $this->client->productCollections->unarchive(
            'pdc_8BWv0hojwUH7iCDabr0NI'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProductCollectionUnarchiveResponse::class, $result);
    }

    #[Test]
    public function testUpdateImages(): void
    {
        $result = $this->client->productCollections->updateImages(
            'pdc_8BWv0hojwUH7iCDabr0NI'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            ProductCollectionUpdateImagesResponse::class,
            $result
        );
    }
}
