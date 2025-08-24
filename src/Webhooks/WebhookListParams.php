<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * List all webhooks.
 */
final class WebhookListParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * The iterator returned from a prior invocation.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $iterator;

    /**
     * Limit the number of returned items.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $limit;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
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
        $obj = new self;

        null !== $iterator && $obj->iterator = $iterator;
        null !== $limit && $obj->limit = $limit;

        return $obj;
    }

    /**
     * The iterator returned from a prior invocation.
     */
    public function withIterator(?string $iterator): self
    {
        $obj = clone $this;
        $obj->iterator = $iterator;

        return $obj;
    }

    /**
     * Limit the number of returned items.
     */
    public function withLimit(?int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }
}
