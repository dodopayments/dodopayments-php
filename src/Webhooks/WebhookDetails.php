<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type webhook_details = array{
 *   id: string,
 *   createdAt: string,
 *   description: string,
 *   metadata: array<string, string>,
 *   updatedAt: string,
 *   url: string,
 *   disabled?: bool|null,
 *   filterTypes?: list<string>|null,
 *   rateLimit?: int|null,
 * }
 */
final class WebhookDetails implements BaseModel
{
    /** @use SdkModel<webhook_details> */
    use SdkModel;

    /**
     * The webhook's ID.
     */
    #[Api]
    public string $id;

    /**
     * Created at timestamp.
     */
    #[Api('created_at')]
    public string $createdAt;

    /**
     * An example webhook name.
     */
    #[Api]
    public string $description;

    /**
     * Metadata of the webhook.
     *
     * @var array<string, string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Updated at timestamp.
     */
    #[Api('updated_at')]
    public string $updatedAt;

    /**
     * Url endpoint of the webhook.
     */
    #[Api]
    public string $url;

    /**
     * Status of the webhook.
     *
     * If true, events are not sent
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $disabled;

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var list<string>|null $filterTypes
     */
    #[Api('filter_types', list: 'string', nullable: true, optional: true)]
    public ?array $filterTypes;

    /**
     * Configured rate limit.
     */
    #[Api('rate_limit', nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string> $metadata
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
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->description = $description;
        $obj->metadata = $metadata;
        $obj->updatedAt = $updatedAt;
        $obj->url = $url;

        null !== $disabled && $obj->disabled = $disabled;
        null !== $filterTypes && $obj->filterTypes = $filterTypes;
        null !== $rateLimit && $obj->rateLimit = $rateLimit;

        return $obj;
    }

    /**
     * The webhook's ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Created at timestamp.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * An example webhook name.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Metadata of the webhook.
     *
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Updated at timestamp.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * Url endpoint of the webhook.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * Status of the webhook.
     *
     * If true, events are not sent
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
     * @param list<string>|null $filterTypes
     */
    public function withFilterTypes(?array $filterTypes): self
    {
        $obj = clone $this;
        $obj->filterTypes = $filterTypes;

        return $obj;
    }

    /**
     * Configured rate limit.
     */
    public function withRateLimit(?int $rateLimit): self
    {
        $obj = clone $this;
        $obj->rateLimit = $rateLimit;

        return $obj;
    }
}
