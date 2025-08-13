<?php

declare(strict_types=1);

namespace DodopaymentsClient;

use DodopaymentsClient\Addons\AddonsService;
use DodopaymentsClient\Brands\BrandsService;
use DodopaymentsClient\Core\BaseClient;
use DodopaymentsClient\Customers\CustomersService;
use DodopaymentsClient\Discounts\DiscountsService;
use DodopaymentsClient\Disputes\DisputesService;
use DodopaymentsClient\Invoices\InvoicesService;
use DodopaymentsClient\LicenseKeyInstances\LicenseKeyInstancesService;
use DodopaymentsClient\LicenseKeys\LicenseKeysService;
use DodopaymentsClient\Licenses\LicensesService;
use DodopaymentsClient\Misc\MiscService;
use DodopaymentsClient\Payments\PaymentsService;
use DodopaymentsClient\Payouts\PayoutsService;
use DodopaymentsClient\Products\ProductsService;
use DodopaymentsClient\Refunds\RefundsService;
use DodopaymentsClient\Subscriptions\SubscriptionsService;
use DodopaymentsClient\WebhookEvents\WebhookEventsService;
use DodopaymentsClient\Webhooks\WebhooksService;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLService;

class Client extends BaseClient
{
    public string $bearerToken;

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

    public YourWebhookURLService $yourWebhookURL;

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
        $this->yourWebhookURL = new YourWebhookURLService($this);
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
