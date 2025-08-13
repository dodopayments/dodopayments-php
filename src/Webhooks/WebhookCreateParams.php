<?php

declare(strict_types=1);

namespace DodoPayments\Webhooks;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\WebhookEvents\WebhookEventType;

/**
 * Create a new webhook.
 *
 * @phpstan-type create_params = array{
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
    use Model;
    use Params;

    /**
     * Url of the webhook.
     */
    #[Api]
    public string $url;

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Create the webhook in a disabled state.
     *
     * Default is false
     */
    #[Api(optional: true)]
    public ?bool $disabled;

    /** @var null|list<WebhookEventType::*> $filterTypes */
    #[Api(
        'filter_types',
        type: new ListOf(enum: WebhookEventType::class),
        optional: true,
    )]
    public ?array $filterTypes;

    /**
     * Custom headers to be passed.
     *
     * @var null|array<string, string> $headers
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $headers;

    /**
     * The request's idempotency key.
     */
    #[Api('idempotency_key', optional: true)]
    public ?string $idempotencyKey;

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $metadata;

    #[Api('rate_limit', optional: true)]
    public ?int $rateLimit;

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
     * @param null|list<WebhookEventType::*> $filterTypes
     * @param null|array<string, string> $headers
     * @param null|array<string, string> $metadata
     */
    public static function from(
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
    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Create the webhook in a disabled state.
     *
     * Default is false
     */
    public function setDisabled(?bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @param list<WebhookEventType::*> $filterTypes
     */
    public function setFilterTypes(array $filterTypes): self
    {
        $this->filterTypes = $filterTypes;

        return $this;
    }

    /**
     * Custom headers to be passed.
     *
     * @param null|array<string, string> $headers
     */
    public function setHeaders(?array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * The request's idempotency key.
     */
    public function setIdempotencyKey(?string $idempotencyKey): self
    {
        $this->idempotencyKey = $idempotencyKey;

        return $this;
    }

    /**
     * Metadata to be passed to the webhook
     * Defaut is {}.
     *
     * @param null|array<string, string> $metadata
     */
    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setRateLimit(?int $rateLimit): self
    {
        $this->rateLimit = $rateLimit;

        return $this;
    }
}
