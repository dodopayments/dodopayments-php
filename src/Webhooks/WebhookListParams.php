<?php

declare(strict_types=1);

namespace DodoPayments\Webhooks;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * List all webhooks.
 *
 * @phpstan-type list_params = array{iterator?: string|null, limit?: int|null}
 */
final class WebhookListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The iterator returned from a prior invocation.
     */
    #[Api(optional: true)]
    public ?string $iterator;

    /**
     * Limit the number of returned items.
     */
    #[Api(optional: true)]
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
    public static function from(
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
    public function setIterator(?string $iterator): self
    {
        $this->iterator = $iterator;

        return $this;
    }

    /**
     * Limit the number of returned items.
     */
    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
}
