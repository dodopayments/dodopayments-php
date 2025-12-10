<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookDetailsShape = array{
 *   id: string,
 *   createdAt: string,
 *   description: string,
 *   metadata: array<string,string>,
 *   updatedAt: string,
 *   url: string,
 *   disabled?: bool|null,
 *   filterTypes?: list<string>|null,
 *   rateLimit?: int|null,
 * }
 */
final class WebhookDetails implements BaseModel
{
    /** @use SdkModel<WebhookDetailsShape> */
    use SdkModel;

    /**
     * The webhook's ID.
     */
    #[Required]
    public string $id;

    /**
     * Created at timestamp.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * An example webhook name.
     */
    #[Required]
    public string $description;

    /**
     * Metadata of the webhook.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Updated at timestamp.
     */
    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * Url endpoint of the webhook.
     */
    #[Required]
    public string $url;

    /**
     * Status of the webhook.
     *
     * If true, events are not sent
     */
    #[Optional(nullable: true)]
    public ?bool $disabled;

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var list<string>|null $filterTypes
     */
    #[Optional('filter_types', list: 'string', nullable: true)]
    public ?array $filterTypes;

    /**
     * Configured rate limit.
     */
    #[Optional('rate_limit', nullable: true)]
    public ?int $rateLimit;

    /**
     * `new WebhookDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookDetails::with(
     *   id: ...,
     *   createdAt: ...,
     *   description: ...,
     *   metadata: ...,
     *   updatedAt: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookDetails)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withMetadata(...)
     *   ->withUpdatedAt(...)
     *   ->withURL(...)
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
     * @param array<string,string> $metadata
     * @param list<string>|null $filterTypes
     */
    public static function with(
        string $id,
        string $createdAt,
        string $description,
        array $metadata,
        string $updatedAt,
        string $url,
        ?bool $disabled = null,
        ?array $filterTypes = null,
        ?int $rateLimit = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['metadata'] = $metadata;
        $self['updatedAt'] = $updatedAt;
        $self['url'] = $url;

        null !== $disabled && $self['disabled'] = $disabled;
        null !== $filterTypes && $self['filterTypes'] = $filterTypes;
        null !== $rateLimit && $self['rateLimit'] = $rateLimit;

        return $self;
    }

    /**
     * The webhook's ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Created at timestamp.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * An example webhook name.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Metadata of the webhook.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Updated at timestamp.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Url endpoint of the webhook.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Status of the webhook.
     *
     * If true, events are not sent
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
     * @param list<string>|null $filterTypes
     */
    public function withFilterTypes(?array $filterTypes): self
    {
        $self = clone $this;
        $self['filterTypes'] = $filterTypes;

        return $self;
    }

    /**
     * Configured rate limit.
     */
    public function withRateLimit(?int $rateLimit): self
    {
        $self = clone $this;
        $self['rateLimit'] = $rateLimit;

        return $self;
    }
}
