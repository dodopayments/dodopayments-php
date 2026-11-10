<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\Invoice\Customer\BillingAddress;

/**
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Invoices\Invoice\Customer\BillingAddress
 *
 * @phpstan-type CustomerShape = array{
 *   billingAddress: BillingAddress|BillingAddressShape,
 *   ccEmails: list<string>,
 *   customerID: string,
 *   email?: string|null,
 *   taxID?: string|null,
 * }
 */
final class Customer implements BaseModel
{
    /** @use SdkModel<CustomerShape> */
    use SdkModel;

    /**
     * A draft can have no country yet. Finalise needs it.
     */
    #[Required('billing_address')]
    public BillingAddress $billingAddress;

    /** @var list<string> $ccEmails */
    #[Required('cc_emails', list: 'string')]
    public array $ccEmails;

    #[Required('customer_id')]
    public string $customerID;

    #[Optional(nullable: true)]
    public ?string $email;

    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

    /**
     * `new Customer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Customer::with(billingAddress: ..., ccEmails: ..., customerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Customer)->withBillingAddress(...)->withCcEmails(...)->withCustomerID(...)
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
     * @param BillingAddress|BillingAddressShape $billingAddress
     * @param list<string> $ccEmails
     */
    public static function with(
        BillingAddress|array $billingAddress,
        array $ccEmails,
        string $customerID,
        ?string $email = null,
        ?string $taxID = null,
    ): self {
        $self = new self;

        $self['billingAddress'] = $billingAddress;
        $self['ccEmails'] = $ccEmails;
        $self['customerID'] = $customerID;

        null !== $email && $self['email'] = $email;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * A draft can have no country yet. Finalise needs it.
     *
     * @param BillingAddress|BillingAddressShape $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * @param list<string> $ccEmails
     */
    public function withCcEmails(array $ccEmails): self
    {
        $self = clone $this;
        $self['ccEmails'] = $ccEmails;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }
}
