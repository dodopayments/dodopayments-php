<?php

declare(strict_types=1);

namespace Dodopayments;

use Dodopayments\Core\BaseClient;
use Dodopayments\Core\Services\AddonsService;
use Dodopayments\Core\Services\BrandsService;
use Dodopayments\Core\Services\CheckoutSessionsService;
use Dodopayments\Core\Services\CustomersService;
use Dodopayments\Core\Services\DiscountsService;
use Dodopayments\Core\Services\DisputesService;
use Dodopayments\Core\Services\InvoicesService;
use Dodopayments\Core\Services\LicenseKeyInstancesService;
use Dodopayments\Core\Services\LicenseKeysService;
use Dodopayments\Core\Services\LicensesService;
use Dodopayments\Core\Services\MetersService;
use Dodopayments\Core\Services\MiscService;
use Dodopayments\Core\Services\PaymentsService;
use Dodopayments\Core\Services\PayoutsService;
use Dodopayments\Core\Services\ProductsService;
use Dodopayments\Core\Services\RefundsService;
use Dodopayments\Core\Services\SubscriptionsService;
use Dodopayments\Core\Services\UsageEventsService;
use Dodopayments\Core\Services\WebhookEventsService;
use Dodopayments\Core\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

class Client extends BaseClient
{
    public string $bearerToken;

    /**
     * @api
     */
    public CheckoutSessionsService $checkoutSessions;

    /**
     * @api
     */
    public PaymentsService $payments;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @api
     */
    public InvoicesService $invoices;

    /**
     * @api
     */
    public LicensesService $licenses;

    /**
     * @api
     */
    public LicenseKeysService $licenseKeys;

    /**
     * @api
     */
    public LicenseKeyInstancesService $licenseKeyInstances;

    /**
     * @api
     */
    public CustomersService $customers;

    /**
     * @api
     */
    public RefundsService $refunds;

    /**
     * @api
     */
    public DisputesService $disputes;

    /**
     * @api
     */
    public PayoutsService $payouts;

    /**
     * @api
     */
    public WebhookEventsService $webhookEvents;

    /**
     * @api
     */
    public ProductsService $products;

    /**
     * @api
     */
    public MiscService $misc;

    /**
     * @api
     */
    public DiscountsService $discounts;

    /**
     * @api
     */
    public AddonsService $addons;

    /**
     * @api
     */
    public BrandsService $brands;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @api
     */
    public UsageEventsService $usageEvents;

    /**
     * @api
     */
    public MetersService $meters;

    public function __construct(?string $bearerToken = null, ?string $baseUrl = null)
    {
        $this->bearerToken = (string) (
            $bearerToken ?? getenv('DODO_PAYMENTS_API_KEY')
        );

        $base = $baseUrl ?? getenv(
            'DODO_PAYMENTS_BASE_URL'
        ) ?: 'https://live.dodopayments.com';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $base,
            options: $options,
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
        $this->usageEvents = new UsageEventsService($this);
        $this->meters = new MetersService($this);
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
