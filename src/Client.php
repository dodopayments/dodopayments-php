<?php

declare(strict_types=1);

namespace Dodopayments;

use Dodopayments\Core\BaseClient;
use Dodopayments\Core\Util;
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
use Dodopayments\Services\MetersService;
use Dodopayments\Services\MiscService;
use Dodopayments\Services\PaymentsService;
use Dodopayments\Services\PayoutsService;
use Dodopayments\Services\ProductsService;
use Dodopayments\Services\RefundsService;
use Dodopayments\Services\SubscriptionsService;
use Dodopayments\Services\UsageEventsService;
use Dodopayments\Services\WebhookEventsService;
use Dodopayments\Services\WebhooksService;
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
    public WebhookEventsService $webhookEvents;

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
        $this->bearerToken = (string) ($bearerToken ?? getenv('DODO_PAYMENTS_API_KEY'));

        $baseUrl ??= getenv(
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
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('Dodo Payments/PHP %s', '3.5.0'),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '3.5.0',
                'X-Stainless-OS' => $this->getNormalizedOS(),
                'X-Stainless-Arch' => $this->getNormalizedArchitecture(),
                'X-Stainless-Runtime' => 'php',
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
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
        $this->products = new ProductsService($this);
        $this->misc = new MiscService($this);
        $this->discounts = new DiscountsService($this);
        $this->addons = new AddonsService($this);
        $this->brands = new BrandsService($this);
        $this->webhooks = new WebhooksService($this);
        $this->webhookEvents = new WebhookEventsService($this);
        $this->usageEvents = new UsageEventsService($this);
        $this->meters = new MetersService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->bearerToken ? [
            'Authorization' => "Bearer {$this->bearerToken}",
        ] : [];
    }
}
