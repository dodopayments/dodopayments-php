<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookEventType;

/**
 * Create a new webhook.
 *
 * @see Dodopayments\Services\WebhooksService::create()
 *
 * @phpstan-type WebhookCreateParamsShape = array{
 *   url: string,
 *   description?: string|null,
 *   disabled?: bool|null,
 *   filterTypes?: list<WebhookEventType|value-of<WebhookEventType>>|null,
 *   headers?: array<string,string>|null,
 *   idempotencyKey?: string|null,
 *   metadata?: array<string,string>|null,
 *   rateLimit?: int|null,
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
    #[Required]
    public string $url;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Create the webhook in a disabled state.
     *
     * Default is false
     */
    #[Optional(nullable: true)]
    public ?bool $disabled;

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var list<value-of<WebhookEventType>>|null $filterTypes
     */
    #[Optional('filter_types', list: WebhookEventType::class)]
    public ?array $filterTypes;

    /**
     * Custom headers to be passed.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $headers;

    /**
     * The request's idempotency key.
     */
    #[Optional('idempotency_key', nullable: true)]
    public ?string $idempotencyKey;

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    #[Optional('rate_limit', nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<WebhookEventType|value-of<WebhookEventType>>|null $filterTypes
     * @param array<string,string>|null $headers
     * @param array<string,string>|null $metadata
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
        $self = new self;

        $self['url'] = $url;

        null !== $description && $self['description'] = $description;
        null !== $disabled && $self['disabled'] = $disabled;
        null !== $filterTypes && $self['filterTypes'] = $filterTypes;
        null !== $headers && $self['headers'] = $headers;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $rateLimit && $self['rateLimit'] = $rateLimit;

        return $self;
    }

    /**
     * Url of the webhook.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Create the webhook in a disabled state.
     *
     * Default is false
     */
    public function withDisabled(?bool $disabled): self
    {
        $self = clone $this;
        $self['disabled'] = $disabled;

        return $self;
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
        $self = clone $this;
        $self['filterTypes'] = $filterTypes;

        return $self;
    }

    /**
     * Custom headers to be passed.
     *
     * @param array<string,string>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    /**
     * The request's idempotency key.
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withRateLimit(?int $rateLimit): self
    {
        $self = clone $this;
        $self['rateLimit'] = $rateLimit;

        return $self;
    }
}
