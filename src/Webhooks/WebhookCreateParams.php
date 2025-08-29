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
 * @phpstan-type webhook_create_params = array{
 *   url: string,
 *   description?: string|null,
 *   disabled?: bool|null,
 *   filterTypes?: list<WebhookEventType::*>,
 *   headers?: array<string, string>|null,
 *   idempotencyKey?: string|null,
 *   metadata?: array<string, string>|null,
 *   rateLimit?: int|null,
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<webhook_create_params> */
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
     * @var list<WebhookEventType::*>|null $filterTypes
     */
    #[Api('filter_types', list: WebhookEventType::class, optional: true)]
    public ?array $filterTypes;

    /**
     * Custom headers to be passed.
     *
     * @var array<string, string>|null $headers
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $headers;

    /**
     * The request's idempotency key.
     */
    #[Api('idempotency_key', nullable: true, optional: true)]
    public ?string $idempotencyKey;

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @var array<string, string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    #[Api('rate_limit', nullable: true, optional: true)]
    public ?int $rateLimit;

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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<WebhookEventType::*> $filterTypes
     * @param array<string, string>|null $headers
     * @param array<string, string>|null $metadata
     */
    public static function with(
        string $url,
        ?string $description = null,
        ?bool $disabled = null,
        ?array $filterTypes = null,
        ?array $headers = null,
        ?string $idempotencyKey = null,
        ?array $metadata = null,
        ?int $rateLimit = null,
    ): self {
        $obj = new self;

        $obj->url = $url;

        null !== $description && $obj->description = $description;
        null !== $disabled && $obj->disabled = $disabled;
        null !== $filterTypes && $obj->filterTypes = $filterTypes;
        null !== $headers && $obj->headers = $headers;
        null !== $idempotencyKey && $obj->idempotencyKey = $idempotencyKey;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $rateLimit && $obj->rateLimit = $rateLimit;

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
     * @param list<WebhookEventType::*> $filterTypes
     */
    public function withFilterTypes(array $filterTypes): self
    {
        $obj = clone $this;
        $obj->filterTypes = $filterTypes;

        return $obj;
    }

    /**
     * Custom headers to be passed.
     *
     * @param array<string, string>|null $headers
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
        $obj->idempotencyKey = $idempotencyKey;

        return $obj;
    }

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @param array<string, string>|null $metadata
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
        $obj->rateLimit = $rateLimit;

        return $obj;
    }
}
