<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlockByEmailShape = array{email: string}
 */
final class BlockByEmail implements BaseModel
{
    /** @use SdkModel<BlockByEmailShape> */
    use SdkModel;

    /**
     * Email to block. It must belong to an existing customer of this business.
     */
    #[Required]
    public string $email;

    /**
     * `new BlockByEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockByEmail::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockByEmail)->withEmail(...)
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
     */
    public static function with(string $email): self
    {
        $self = new self;

        $self['email'] = $email;

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
}
