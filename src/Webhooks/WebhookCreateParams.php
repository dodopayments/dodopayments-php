<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookEventType;

/**
 * Create a new webhook.
 *
 * @see Dodopayments\Webhooks->create
 *
 * @phpstan-type WebhookCreateParamsShape = array{
 *   url: string,
 *   description?: string|null,
 *   disabled?: bool|null,
 *   filter_types?: list<WebhookEventType|value-of<WebhookEventType>>,
 *   headers?: array<string,string>|null,
 *   idempotency_key?: string|null,
 *   metadata?: array<string,string>|null,
 *   rate_limit?: int|null,
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<WebhookCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Url of the webhook.
     */
    #[Api]
    public string $url;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Create the webhook in a disabled state.
     *
     * Default is false
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $disabled;

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var list<value-of<WebhookEventType>>|null $filter_types
     */
    #[Api(list: WebhookEventType::class, optional: true)]
    public ?array $filter_types;

    /**
     * Custom headers to be passed.
     *
     * @var array<string,string>|null $headers
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $headers;

    /**
     * The request's idempotency key.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $idempotency_key;

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    #[Api(nullable: true, optional: true)]
    public ?int $rate_limit;

    /**
     * `new WebhookCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookCreateParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookCreateParams)->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<WebhookEventType|value-of<WebhookEventType>> $filter_types
     * @param array<string,string>|null $headers
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $url,
        ?string $description = null,
        ?bool $disabled = null,
        ?array $filter_types = null,
        ?array $headers = null,
        ?string $idempotency_key = null,
        ?array $metadata = null,
        ?int $rate_limit = null,
    ): self {
        $obj = new self;

        $obj->url = $url;

        null !== $description && $obj->description = $description;
        null !== $disabled && $obj->disabled = $disabled;
        null !== $filter_types && $obj['filter_types'] = $filter_types;
        null !== $headers && $obj->headers = $headers;
        null !== $idempotency_key && $obj->idempotency_key = $idempotency_key;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $rate_limit && $obj->rate_limit = $rate_limit;

        return $obj;
    }

    /**
     * Url of the webhook.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Create the webhook in a disabled state.
     *
     * Default is false
     */
    public function withDisabled(?bool $disabled): self
    {
        $obj = clone $this;
        $obj->disabled = $disabled;

        return $obj;
    }

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @param list<WebhookEventType|value-of<WebhookEventType>> $filterTypes
     */
    public function withFilterTypes(array $filterTypes): self
    {
        $obj = clone $this;
        $obj['filter_types'] = $filterTypes;

        return $obj;
    }

    /**
     * Custom headers to be passed.
     *
     * @param array<string,string>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $obj = clone $this;
        $obj->headers = $headers;

        return $obj;
    }

    /**
     * The request's idempotency key.
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $obj = clone $this;
        $obj->idempotency_key = $idempotencyKey;

        return $obj;
    }

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withRateLimit(?int $rateLimit): self
    {
        $obj = clone $this;
        $obj->rate_limit = $rateLimit;

        return $obj;
    }
}
