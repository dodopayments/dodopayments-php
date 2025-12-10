<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * List all webhooks.
 *
 * @see Dodopayments\Services\WebhooksService::list()
 *
 * @phpstan-type WebhookListParamsShape = array{
 *   iterator?: string|null, limit?: int|null
 * }
 */
final class WebhookListParams implements BaseModel
{
    /** @use SdkModel<WebhookListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The iterator returned from a prior invocation.
     */
    #[Optional(nullable: true)]
    public ?string $iterator;

    /**
     * Limit the number of returned items.
     */
    #[Optional(nullable: true)]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $iterator = null,
        ?int $limit = null
    ): self {
        $self = new self;

        null !== $iterator && $self['iterator'] = $iterator;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * The iterator returned from a prior invocation.
     */
    public function withIterator(?string $iterator): self
    {
        $self = clone $this;
        $self['iterator'] = $iterator;

        return $self;
    }

    /**
     * Limit the number of returned items.
     */
    public function withLimit(?int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
