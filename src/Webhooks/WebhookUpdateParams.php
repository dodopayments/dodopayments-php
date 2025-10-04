<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookEventType;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new WebhookUpdateParams); // set properties as needed
 * $client->webhooks->update(...$params->toArray());
 * ```
 * Patch a webhook by id.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->webhooks->update(...$params->toArray());`
 *
 * @see Dodopayments\Webhooks->update
 *
 * @phpstan-type webhook_update_params = array{
 *   description?: string|null,
 *   disabled?: bool|null,
 *   filterTypes?: list<WebhookEventType|value-of<WebhookEventType>>|null,
 *   metadata?: array<string, string>|null,
 *   rateLimit?: int|null,
 *   url?: string|null,
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<webhook_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Description of the webhook.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * To Disable the endpoint, set it to true.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $disabled;

    /**
     * Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     *
     * @var list<value-of<WebhookEventType>>|null $filterTypes
     */
    #[Api(
        'filter_types',
        list: WebhookEventType::class,
        nullable: true,
        optional: true,
    )]
    public ?array $filterTypes;

    /**
     * Metadata.
     *
     * @var array<string, string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * Rate limit.
     */
    #[Api('rate_limit', nullable: true, optional: true)]
    public ?int $rateLimit;

    /**
     * Url endpoint.
     */
    #[Api(nullable: true, optional: true)]
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
     * @param array<string, string>|null $metadata
     */
    public static function with(
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
        null !== $filterTypes && $obj['filterTypes'] = $filterTypes;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $rateLimit && $obj->rateLimit = $rateLimit;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    /**
     * Description of the webhook.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * To Disable the endpoint, set it to true.
     */
    public function withDisabled(?bool $disabled): self
    {
        $obj = clone $this;
        $obj->disabled = $disabled;

        return $obj;
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
        $obj = clone $this;
        $obj['filterTypes'] = $filterTypes;

        return $obj;
    }

    /**
     * Metadata.
     *
     * @param array<string, string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Rate limit.
     */
    public function withRateLimit(?int $rateLimit): self
    {
        $obj = clone $this;
        $obj->rateLimit = $rateLimit;

        return $obj;
    }

    /**
     * Url endpoint.
     */
    public function withURL(?string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
