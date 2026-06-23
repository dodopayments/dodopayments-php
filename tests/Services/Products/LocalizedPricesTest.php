<?php

namespace Tests\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\LocalizedPrices\ListLocalizedPricesResponse;
use Dodopayments\Products\LocalizedPrices\LocalizedPrice;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LocalizedPricesTest extends TestCase
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
        $result = $this->client->products->localizedPrices->create(
            'pdt_R8AWMPiV8RyJElcCKvAID',
            amount: 0,
            currency: Currency::AED
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LocalizedPrice::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->products->localizedPrices->create(
            'pdt_R8AWMPiV8RyJElcCKvAID',
            amount: 0,
            currency: Currency::AED,
            countryCode: CountryCode::AF,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LocalizedPrice::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->products->localizedPrices->retrieve(
            'lcp_3aOOT7ebrzBOV41yL2V6s',
            productID: 'pdt_R8AWMPiV8RyJElcCKvAID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LocalizedPrice::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->products->localizedPrices->retrieve(
            'lcp_3aOOT7ebrzBOV41yL2V6s',
            productID: 'pdt_R8AWMPiV8RyJElcCKvAID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LocalizedPrice::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->products->localizedPrices->update(
            'lcp_3aOOT7ebrzBOV41yL2V6s',
            productID: 'pdt_R8AWMPiV8RyJElcCKvAID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LocalizedPrice::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->products->localizedPrices->update(
            'lcp_3aOOT7ebrzBOV41yL2V6s',
            productID: 'pdt_R8AWMPiV8RyJElcCKvAID',
            amount: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LocalizedPrice::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->products->localizedPrices->list(
            'pdt_R8AWMPiV8RyJElcCKvAID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ListLocalizedPricesResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->products->localizedPrices->archive(
            'lcp_3aOOT7ebrzBOV41yL2V6s',
            productID: 'pdt_R8AWMPiV8RyJElcCKvAID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testArchiveWithOptionalParams(): void
    {
        $result = $this->client->products->localizedPrices->archive(
            'lcp_3aOOT7ebrzBOV41yL2V6s',
            productID: 'pdt_R8AWMPiV8RyJElcCKvAID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
