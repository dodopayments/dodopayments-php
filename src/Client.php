<?php

declare(strict_types=1);

namespace Dodopayments;

use Dodopayments\Core\BaseClient;
use Dodopayments\Services\AddonsService;
use Dodopayments\Services\BrandsService;
use Dodopayments\Services\CheckoutSessionsService;
use Dodopayments\Services\CustomersService;
use Dodopayments\Services\DiscountsService;
use Dodopayments\Services\DisputesService;
use Dodopayments\Services\InvoicesService;
use Dodopayments\Services\LicenseKeyInstancesService;
use Dodopayments\Services\LicenseKeysService;
use Dodopayments\Services\LicensesService;
use Dodopayments\Services\MiscService;
use Dodopayments\Services\PaymentsService;
use Dodopayments\Services\PayoutsService;
use Dodopayments\Services\ProductsService;
use Dodopayments\Services\RefundsService;
use Dodopayments\Services\SubscriptionsService;
use Dodopayments\Services\WebhookEventsService;
use Dodopayments\Services\WebhooksService;

class Client extends BaseClient
{
    public string $bearerToken;

    public CheckoutSessionsService $checkoutSessions;

    public PaymentsService $payments;

    public SubscriptionsService $subscriptions;

    public InvoicesService $invoices;

    public LicensesService $licenses;

    public LicenseKeysService $licenseKeys;

    public LicenseKeyInstancesService $licenseKeyInstances;

    public CustomersService $customers;

    public RefundsService $refunds;

    public DisputesService $disputes;

    public PayoutsService $payouts;

    public WebhookEventsService $webhookEvents;

    public ProductsService $products;

    public MiscService $misc;

    public DiscountsService $discounts;

    public AddonsService $addons;

    public BrandsService $brands;

    public WebhooksService $webhooks;

    public function __construct(?string $bearerToken = null, ?string $baseUrl = null)
    {
        $this->bearerToken = (string) (
            $bearerToken ?? getenv('DODO_PAYMENTS_API_KEY')
        );

        $base = $baseUrl ?? getenv(
            'DODO_PAYMENTS_BASE_URL'
        ) ?: 'https://live.dodopayments.com';

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $base,
            options: new RequestOptions,
        );

        $this->checkoutSessions = new CheckoutSessionsService($this);
        $this->payments = new PaymentsService($this);
        $this->subscriptions = new SubscriptionsService($this);
        $this->invoices = new InvoicesService($this);
        $this->licenses = new LicensesService($this);
        $this->licenseKeys = new LicenseKeysService($this);
        $this->licenseKeyInstances = new LicenseKeyInstancesService($this);
        $this->customers = new CustomersService($this);
        $this->refunds = new RefundsService($this);
        $this->disputes = new DisputesService($this);
        $this->payouts = new PayoutsService($this);
        $this->webhookEvents = new WebhookEventsService($this);
        $this->products = new ProductsService($this);
        $this->misc = new MiscService($this);
        $this->discounts = new DiscountsService($this);
        $this->addons = new AddonsService($this);
        $this->brands = new BrandsService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string, string> */
    protected function authHeaders(): array
    {
        if (!$this->bearerToken) {
            return [];
        }

        return ['Authorization' => "Bearer {$this->bearerToken}"];
    }
}
