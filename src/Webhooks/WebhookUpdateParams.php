<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Conversion\MapOf;
use Dodopayments\WebhookEvents\WebhookEventType;

/**
 * Patch a webhook by id.
 *
 * @phpstan-type update_params = array{
 *   description?: string|null,
 *   disabled?: bool|null,
 *   filterTypes?: list<WebhookEventType::*>|null,
 *   metadata?: array<string, string>|null,
 *   rateLimit?: int|null,
 *   url?: string|null,
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Description of the webhook.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * To Disable the endpoint, set it to true.
     */
    #[Api(optional: true)]
    public ?bool $disabled;

    /**
     * Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var null|list<WebhookEventType::*> $filterTypes
     */
    #[Api(
        'filter_types',
        type: new ListOf(enum: WebhookEventType::class),
        nullable: true,
        optional: true,
    )]
    public ?array $filterTypes;

    /**
     * Metadata.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * Rate limit.
     */
    #[Api('rate_limit', optional: true)]
    public ?int $rateLimit;

    /**
     * Url endpoint.
     */
    #[Api(optional: true)]
    public ?string $url;

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
     * @param null|array<string, string> $metadata
     */
    public static function from(
        ?string $description = null,
        ?bool $disabled = null,
        ?array $filterTypes = null,
        ?array $metadata = null,
        ?int $rateLimit = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $description && $obj->description = $description;
        null !== $disabled && $obj->disabled = $disabled;
        null !== $filterTypes && $obj->filterTypes = $filterTypes;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $rateLimit && $obj->rateLimit = $rateLimit;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    /**
     * Description of the webhook.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * To Disable the endpoint, set it to true.
     */
    public function setDisabled(?bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @param null|list<WebhookEventType::*> $filterTypes
     */
    public function setFilterTypes(?array $filterTypes): self
    {
        $this->filterTypes = $filterTypes;

        return $this;
    }

    /**
     * Metadata.
     *
     * @param null|array<string, string> $metadata
     */
    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Rate limit.
     */
    public function setRateLimit(?int $rateLimit): self
    {
        $this->rateLimit = $rateLimit;

        return $this;
    }

    /**
     * Url endpoint.
     */
    public function setURL(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
