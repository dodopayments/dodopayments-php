<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Invoices\CollectionMethod;
use Dodopayments\Invoices\Invoice;
use Dodopayments\Invoices\InvoiceListEventsResponse;
use Dodopayments\Invoices\InvoiceNewHostedLinkResponse;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InvoicesTest extends TestCase
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
        $result = $this->client->invoices->create(
            collectionMethod: CollectionMethod::AUTO_CHARGE,
            currency: Currency::AED,
            customerID: 'customer_id',
            items: [
                [
                    'description' => 'description',
                    'kind' => 'custom',
                    'taxCategory' => TaxCategory::DIGITAL_PRODUCTS,
                    'unitAmount' => 0,
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->invoices->create(
            collectionMethod: CollectionMethod::AUTO_CHARGE,
            currency: Currency::AED,
            customerID: 'customer_id',
            items: [
                [
                    'description' => 'description',
                    'kind' => 'custom',
                    'taxCategory' => TaxCategory::DIGITAL_PRODUCTS,
                    'unitAmount' => 0,
                    'quantity' => 0,
                ],
            ],
            billingAddress: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            ccEmails: ['string'],
            customerEmail: 'customer_email',
            discountIDs: ['string'],
            dueAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            dunning: ['remindersEnabled' => true, 'offsetsDays' => [0]],
            memo: 'memo',
            metadata: ['foo' => 'string'],
            paymentTerms: ['type' => 'due_on_receipt'],
            reviewRequired: true,
            taxID: 'tax_id',
            idempotencyKey: 'Idempotency-Key',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->invoices->retrieve('invoice_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->invoices->update(
            'invoice_id',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->invoices->update(
            'invoice_id',
            ifMatch: 'If-Match',
            billingAddress: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            ccEmails: ['string'],
            collectionMethod: CollectionMethod::AUTO_CHARGE,
            currency: Currency::AED,
            customerEmail: 'customer_email',
            customerID: 'customer_id',
            discountIDs: ['string'],
            dueAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            dunning: ['remindersEnabled' => true, 'offsetsDays' => [0]],
            items: [
                [
                    'description' => 'description',
                    'kind' => 'custom',
                    'taxCategory' => TaxCategory::DIGITAL_PRODUCTS,
                    'unitAmount' => 0,
                    'quantity' => 0,
                ],
            ],
            memo: 'memo',
            metadata: ['foo' => 'string'],
            paymentTerms: ['type' => 'due_on_receipt'],
            reviewRequired: true,
            taxID: 'tax_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->invoices->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Invoice::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->invoices->delete(
            'invoice_id',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->invoices->delete(
            'invoice_id',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testAddNote(): void
    {
        $result = $this->client->invoices->addNote('invoice_id', text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testAddNoteWithOptionalParams(): void
    {
        $result = $this->client->invoices->addNote('invoice_id', text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testCreateHostedLink(): void
    {
        $result = $this->client->invoices->createHostedLink('invoice_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceNewHostedLinkResponse::class, $result);
    }

    #[Test]
    public function testDuplicate(): void
    {
        $result = $this->client->invoices->duplicate('invoice_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testFinalize(): void
    {
        $result = $this->client->invoices->finalize(
            'invoice_id',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testFinalizeWithOptionalParams(): void
    {
        $result = $this->client->invoices->finalize(
            'invoice_id',
            ifMatch: 'If-Match',
            ccEmails: ['string'],
            customerEmail: 'customer_email',
            send: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testListEvents(): void
    {
        $result = $this->client->invoices->listEvents('invoice_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceListEventsResponse::class, $result);
    }

    #[Test]
    public function testMarkUncollectable(): void
    {
        $result = $this->client->invoices->markUncollectable(
            'invoice_id',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testMarkUncollectableWithOptionalParams(): void
    {
        $result = $this->client->invoices->markUncollectable(
            'invoice_id',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testPreview(): void
    {
        $result = $this->client->invoices->preview(
            collectionMethod: CollectionMethod::AUTO_CHARGE,
            currency: Currency::AED,
            customerID: 'customer_id',
            items: [
                [
                    'description' => 'description',
                    'kind' => 'custom',
                    'taxCategory' => TaxCategory::DIGITAL_PRODUCTS,
                    'unitAmount' => 0,
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testPreviewWithOptionalParams(): void
    {
        $result = $this->client->invoices->preview(
            collectionMethod: CollectionMethod::AUTO_CHARGE,
            currency: Currency::AED,
            customerID: 'customer_id',
            items: [
                [
                    'description' => 'description',
                    'kind' => 'custom',
                    'taxCategory' => TaxCategory::DIGITAL_PRODUCTS,
                    'unitAmount' => 0,
                    'quantity' => 0,
                ],
            ],
            format: 'json',
            billingAddress: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            ccEmails: ['string'],
            customerEmail: 'customer_email',
            discountIDs: ['string'],
            dueAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            dunning: ['remindersEnabled' => true, 'offsetsDays' => [0]],
            memo: 'memo',
            metadata: ['foo' => 'string'],
            paymentTerms: ['type' => 'due_on_receipt'],
            reviewRequired: true,
            taxID: 'tax_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testPreviewExisting(): void
    {
        $result = $this->client->invoices->previewExisting('invoice_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetry(): void
    {
        $result = $this->client->invoices->retry('invoice_id', ifMatch: 'If-Match');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testRetryWithOptionalParams(): void
    {
        $result = $this->client->invoices->retry('invoice_id', ifMatch: 'If-Match');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testSend(): void
    {
        $result = $this->client->invoices->send('invoice_id', ifMatch: 'If-Match');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testSendWithOptionalParams(): void
    {
        $result = $this->client->invoices->send('invoice_id', ifMatch: 'If-Match');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testUpdateDunning(): void
    {
        $result = $this->client->invoices->updateDunning(
            'invoice_id',
            action: 'pause',
            ifMatch: 'If-Match'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testUpdateDunningWithOptionalParams(): void
    {
        $result = $this->client->invoices->updateDunning(
            'invoice_id',
            action: 'pause',
            ifMatch: 'If-Match',
            offsetsDays: [0]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testVoid(): void
    {
        $result = $this->client->invoices->void('invoice_id', ifMatch: 'If-Match');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }

    #[Test]
    public function testVoidWithOptionalParams(): void
    {
        $result = $this->client->invoices->void('invoice_id', ifMatch: 'If-Match');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Invoice::class, $result);
    }
}
