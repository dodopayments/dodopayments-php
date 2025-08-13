<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Webhooks;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;

/**
 * @phpstan-type webhook_new_response_alias = array{
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
final class WebhookNewResponse implements BaseModel
{
    use Model;

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
    #[Api(type: new MapOf('string'))]
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
    #[Api(optional: true)]
    public ?bool $disabled;

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var null|list<string> $filterTypes
     */
    #[Api(
        'filter_types',
        type: new ListOf('string'),
        nullable: true,
        optional: true
    )]
    public ?array $filterTypes;

    /**
     * Configured rate limit.
     */
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
     * @param array<string, string> $metadata
     * @param null|list<string> $filterTypes
     */
    public static function from(
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
    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Created at timestamp.
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * An example webhook name.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Metadata of the webhook.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Updated at timestamp.
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Url endpoint of the webhook.
     */
    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Status of the webhook.
     *
     * If true, events are not sent
     */
    public function setDisabled(?bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @param null|list<string> $filterTypes
     */
    public function setFilterTypes(?array $filterTypes): self
    {
        $this->filterTypes = $filterTypes;

        return $this;
    }

    /**
     * Configured rate limit.
     */
    public function setRateLimit(?int $rateLimit): self
    {
        $this->rateLimit = $rateLimit;

        return $this;
    }
}
