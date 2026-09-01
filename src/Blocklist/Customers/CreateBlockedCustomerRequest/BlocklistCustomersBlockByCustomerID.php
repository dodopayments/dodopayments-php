<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers\CreateBlockedCustomerRequest;

use Dodopayments\Blocklist\Customers\BlockedCustomerSource;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlocklistCustomersBlockByCustomerIDShape = array{
 *   customerID: string,
 *   reason?: string|null,
 *   source?: null|BlockedCustomerSource|value-of<BlockedCustomerSource>,
 * }
 */
final class BlocklistCustomersBlockByCustomerID implements BaseModel
{
    /** @use SdkModel<BlocklistCustomersBlockByCustomerIDShape> */
    use SdkModel;

    /**
     * Customer to block. The block still applies to that customer's email.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * Why the merchant blocked this customer. The entry page shows it.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * Where a block came from. `Api` marks an API-key caller, which carries no
     * dashboard actor. The other values name the screen the merchant used.
     *
     * @var value-of<BlockedCustomerSource>|null $source
     */
    #[Optional(enum: BlockedCustomerSource::class)]
    public ?string $source;

    /**
     * `new BlocklistCustomersBlockByCustomerID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlocklistCustomersBlockByCustomerID::with(customerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlocklistCustomersBlockByCustomerID)->withCustomerID(...)
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
     * @param BlockedCustomerSource|value-of<BlockedCustomerSource>|null $source
     */
    public static function with(
        string $customerID,
        ?string $reason = null,
        BlockedCustomerSource|string|null $source = null,
    ): self {
        $self = new self;

        $self['customerID'] = $customerID;

        null !== $reason && $self['reason'] = $reason;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    /**
     * Customer to block. The block still applies to that customer's email.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Why the merchant blocked this customer. The entry page shows it.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Where a block came from. `Api` marks an API-key caller, which carries no
     * dashboard actor. The other values name the screen the merchant used.
     *
     * @param BlockedCustomerSource|value-of<BlockedCustomerSource> $source
     */
    public function withSource(BlockedCustomerSource|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
