<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers\CreateBlockedCustomerRequest;

use Dodopayments\Blocklist\Customers\BlockedCustomerSource;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlocklistCustomersBlockByEmailShape = array{
 *   email: string,
 *   reason?: string|null,
 *   source?: null|BlockedCustomerSource|value-of<BlockedCustomerSource>,
 * }
 */
final class BlocklistCustomersBlockByEmail implements BaseModel
{
    /** @use SdkModel<BlocklistCustomersBlockByEmailShape> */
    use SdkModel;

    /**
     * Email to block. It must belong to an existing customer of this business.
     */
    #[Required]
    public string $email;

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
     * `new BlocklistCustomersBlockByEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlocklistCustomersBlockByEmail::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlocklistCustomersBlockByEmail)->withEmail(...)
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
        string $email,
        ?string $reason = null,
        BlockedCustomerSource|string|null $source = null,
    ): self {
        $self = new self;

        $self['email'] = $email;

        null !== $reason && $self['reason'] = $reason;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    /**
     * Email to block. It must belong to an existing customer of this business.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

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
