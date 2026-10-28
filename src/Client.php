<?php

declare(strict_types=1);

namespace Dodopayments;

use Dodopayments\Core\BaseClient;
use Dodopayments\Core\Contracts\BasePage;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Contracts\BaseStream;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Core\Exceptions\AuthenticationException;
use Dodopayments\Core\Implementation\StreamingHttpClient;
use Dodopayments\Core\Util;
use Dodopayments\Services\AddonsService;
use Dodopayments\Services\BalancesService;
use Dodopayments\Services\BlocklistService;
use Dodopayments\Services\BrandsService;
use Dodopayments\Services\CheckoutSessionsService;
use Dodopayments\Services\CreditEntitlementsService;
use Dodopayments\Services\CustomersService;
use Dodopayments\Services\DiscountsService;
use Dodopayments\Services\DisputesService;
use Dodopayments\Services\EntitlementsService;
use Dodopayments\Services\InvoicesService;
use Dodopayments\Services\LicenseKeyInstancesService;
use Dodopayments\Services\LicenseKeysService;
use Dodopayments\Services\LicensesService;
use Dodopayments\Services\MetersService;
use Dodopayments\Services\MiscService;
use Dodopayments\Services\ModerationService;
use Dodopayments\Services\PaymentsService;
use Dodopayments\Services\PayoutsService;
use Dodopayments\Services\ProductCollectionsService;
use Dodopayments\Services\ProductsService;
use Dodopayments\Services\RefundsService;
use Dodopayments\Services\SubscriptionsService;
use Dodopayments\Services\UsageEventsService;
use Dodopayments\Services\WebhookEventsService;
use Dodopayments\Services\WebhooksService;
use Dodopayments\WorkloadIdentity\Providers;
use Dodopayments\WorkloadIdentity\TokenManager;
use Dodopayments\WorkloadIdentity\WorkloadIdentity;
use Dodopayments\WorkloadIdentity\WorkloadIdentityException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-import-type NormalizedRequest from \Dodopayments\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
class Client extends BaseClient
{
    /**
     * The workload identity token cache. It is null when the client does not use workload identity.
     */
    public ?TokenManager $workloadIdentity = null;

    public string $bearerToken;

    public string $webhookKey;

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
    public BlocklistService $blocklist;

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

    /**
     * @api
     */
    public BalancesService $balances;

    /**
     * @api
     */
    public CreditEntitlementsService $creditEntitlements;

    /**
     * @api
     */
    public EntitlementsService $entitlements;

    /**
     * @api
     */
    public ProductCollectionsService $productCollections;

    /**
     * @api
     */
    public ModerationService $moderation;

    private bool $workloadIdentityRequestInFlight = false;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $bearerToken = null,
        ?string $webhookKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
        ?WorkloadIdentity $workloadIdentity = null,
    ) {
        if (null !== $workloadIdentity && null !== $bearerToken) {
            throw new WorkloadIdentityException('Set bearerToken or workloadIdentity, not both.');
        }

        $this->bearerToken = (string) ($bearerToken ?? Util::getenv(
            'DODO_PAYMENTS_API_KEY'
        ));
        $this->webhookKey = (string) ($webhookKey ?? Util::getenv(
            'DODO_PAYMENTS_WEBHOOK_KEY'
        ));

        $baseUrl ??=
            getenv('DODO_PAYMENTS_BASE_URL') ?: 'https://live.dodopayments.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('Dodo Payments/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '6.33.0',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('DODO_PAYMENTS_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options,
        );

        $apiKeyIsSet = !in_array(Util::getenv('DODO_PAYMENTS_API_KEY'), [null, ''], true);
        $identityProviderIdIsSet = !in_array(Util::getenv(WorkloadIdentity::IDENTITY_PROVIDER_ID_ENV), [null, ''], true);
        if (null === $workloadIdentity && null === $bearerToken && !$apiKeyIsSet && $identityProviderIdIsSet) {
            $provider = Providers::auto($options->transporter);
            if (null !== $provider) {
                $workloadIdentity = new WorkloadIdentity($provider);
            }
        }

        if (null !== $workloadIdentity) {
            $this->workloadIdentity = new TokenManager($this, options: $workloadIdentity, baseUrl: (string) $this->baseUrl);
        }

        $this->checkoutSessions = new CheckoutSessionsService($this);
        $this->payments = new PaymentsService($this);
        $this->subscriptions = new SubscriptionsService($this);
        $this->invoices = new InvoicesService($this);
        $this->licenses = new LicensesService($this);
        $this->licenseKeys = new LicenseKeysService($this);
        $this->licenseKeyInstances = new LicenseKeyInstancesService($this);
        $this->customers = new CustomersService($this);
        $this->blocklist = new BlocklistService($this);
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
        $this->balances = new BalancesService($this);
        $this->creditEntitlements = new CreditEntitlementsService($this);
        $this->entitlements = new EntitlementsService($this);
        $this->productCollections = new ProductCollectionsService($this);
        $this->moderation = new ModerationService($this);
    }

    /**
     * Sends the request. With workload identity, a 401 response clears the token cache.
     * The client then exchanges a new token and sends the request again one time.
     *
     * @param string|list<mixed> $path
     * @param array<string,mixed> $query
     * @param array<string,mixed> $headers
     * @param string|int|list<string|int>|null $unwrap
     * @param class-string<BasePage<mixed>>|null $page
     * @param class-string<BaseStream<mixed>>|null $stream
     * @param RequestOptions|array<string,mixed>|null $options
     *
     * @return BaseResponse<mixed>
     */
    public function request(
        string $method,
        string|array $path,
        array $query = [],
        array $headers = [],
        mixed $body = null,
        string|int|array|null $unwrap = null,
        string|Converter|ConverterSource|null $convert = null,
        ?string $page = null,
        ?string $stream = null,
        RequestOptions|array|null $options = [],
    ): BaseResponse {
        if (null === $this->workloadIdentity) {
            return parent::request($method, $path, $query, $headers, $body, $unwrap, $convert, $page, $stream, $options);
        }

        // An exchange error must not start the 401 retry below.
        $this->workloadIdentity->accessToken();

        try {
            return parent::request($method, $path, $query, ['Authorization' => "Bearer {$this->workloadIdentity->currentAccessToken()}", ...$headers], $body, $unwrap, $convert, $page, $stream, $options);
        } catch (AuthenticationException) {
            $this->workloadIdentity->invalidate();

            return parent::request($method, $path, $query, ['Authorization' => "Bearer {$this->workloadIdentity->currentAccessToken()}", ...$headers], $body, $unwrap, $convert, $page, $stream, $options);
        }
    }

    /**
     * @internal
     *
     * Sends a workload identity request without the API Authorization header.
     * The client does not retry a 4xx response.
     *
     * @param array<string,string>|null $body
     */
    public function sendWorkloadIdentityRequest(
        string $path,
        ?array $body,
        ?string $accessToken,
    ): ResponseInterface {
        [$req, $opts] = parent::buildRequest(method: 'post', path: $path, query: [], headers: [], body: $body, opts: null);
        assert(!is_null($opts->requestFactory));

        $request = $opts->requestFactory->createRequest($req['method'], uri: $req['path']);
        $request = Util::withSetHeaders($request, headers: $req['headers']);
        $request = $this->transformRequest($request)->withoutHeader('Authorization');
        if (null !== $accessToken) {
            $request = $request->withHeader('Authorization', "Bearer {$accessToken}");
        }

        $this->workloadIdentityRequestInFlight = true;

        try {
            return $this->sendRequest($opts, req: $request, data: $body, retryCount: 0, redirectCount: 0);
        } finally {
            $this->workloadIdentityRequestInFlight = false;
        }
    }

    /**
     * @internal
     */
    protected function shouldRetry(
        RequestOptions $opts,
        int $retryCount,
        ?ResponseInterface $rsp
    ): bool {
        if ($this->workloadIdentityRequestInFlight && null !== $rsp && $rsp->getStatusCode() < 500) {
            return false;
        }

        return parent::shouldRetry($opts, retryCount: $retryCount, rsp: $rsp);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->bearerToken
            ? [
                'Authorization' => "Bearer {$this->bearerToken}",
            ]
            : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
