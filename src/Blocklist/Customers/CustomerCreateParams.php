<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Blocklist\CustomersService::create()
 *
 * @phpstan-type CustomerCreateParamsShape = array{
 *   customerID: string,
 *   reason?: string|null,
 *   source?: null|BlockedCustomerSource|value-of<BlockedCustomerSource>,
 *   email: string,
 * }
 */
final class CustomerCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Screen the merchant blocked from. Ignored for an API-key caller, whose
     * entry always records `api`. A dashboard caller that omits it records
     * `blocklist_page`.
     *
     * @var value-of<BlockedCustomerSource>|null $source
     */
    #[Optional(enum: BlockedCustomerSource::class, nullable: true)]
    public ?string $source;

    /**
     * Email to block. It must belong to an existing customer of this business.
     */
    #[Required]
    public string $email;

    /**
     * `new CustomerCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerCreateParams::with(customerID: ..., email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerCreateParams)->withCustomerID(...)->withEmail(...)
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
        string $email,
        ?string $reason = null,
        BlockedCustomerSource|string|null $source = null,
    ): self {
        $self = new self;

        $self['customerID'] = $customerID;
        $self['email'] = $email;

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
     * Screen the merchant blocked from. Ignored for an API-key caller, whose
     * entry always records `api`. A dashboard caller that omits it records
     * `blocklist_page`.
     *
     * @param BlockedCustomerSource|value-of<BlockedCustomerSource>|null $source
     */
    public function withSource(BlockedCustomerSource|string|null $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

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
