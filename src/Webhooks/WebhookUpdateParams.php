<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookEventType;

/**
 * Patch a webhook by id.
 *
 * @see Dodopayments\Services\WebhooksService::update()
 *
 * @phpstan-type WebhookUpdateParamsShape = array{
 *   description?: string|null,
 *   disabled?: bool|null,
 *   filterTypes?: list<WebhookEventType|value-of<WebhookEventType>>|null,
 *   metadata?: array<string,string>|null,
 *   rateLimit?: int|null,
 *   url?: string|null,
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Description of the webhook.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * To Disable the endpoint, set it to true.
     */
    #[Optional(nullable: true)]
    public ?bool $disabled;

    /**
     * Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var list<value-of<WebhookEventType>>|null $filterTypes
     */
    #[Optional('filter_types', list: WebhookEventType::class, nullable: true)]
    public ?array $filterTypes;

    /**
     * Metadata.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    /**
     * Rate limit.
     */
    #[Optional('rate_limit', nullable: true)]
    public ?int $rateLimit;

    /**
     * Url endpoint.
     */
    #[Optional(nullable: true)]
    public ?string $url;

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
     * @param array<string,string>|null $metadata
     */
    public static function with(
        ?string $description = null,
        ?bool $disabled = null,
        ?array $filterTypes = null,
        ?array $metadata = null,
        ?int $rateLimit = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $disabled && $self['disabled'] = $disabled;
        null !== $filterTypes && $self['filterTypes'] = $filterTypes;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $rateLimit && $self['rateLimit'] = $rateLimit;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Description of the webhook.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * To Disable the endpoint, set it to true.
     */
    public function withDisabled(?bool $disabled): self
    {
        $self = clone $this;
        $self['disabled'] = $disabled;

        return $self;
    }

    /**
     * Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @param list<WebhookEventType|value-of<WebhookEventType>>|null $filterTypes
     */
    public function withFilterTypes(?array $filterTypes): self
    {
        $self = clone $this;
        $self['filterTypes'] = $filterTypes;

        return $self;
    }

    /**
     * Metadata.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Rate limit.
     */
    public function withRateLimit(?int $rateLimit): self
    {
        $self = clone $this;
        $self['rateLimit'] = $rateLimit;

        return $self;
    }

    /**
     * Url endpoint.
     */
    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
