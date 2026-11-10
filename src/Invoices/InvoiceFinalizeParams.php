<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Issues the draft. With `send: true`, the invoice email goes out after the issue.
 * A failed send keeps the invoice issued. Call `/send` again with the new `ETag`.
 *
 * @see Dodopayments\Services\InvoicesService::finalize()
 *
 * @phpstan-type InvoiceFinalizeParamsShape = array{
 *   ifMatch: string,
 *   ccEmails?: list<string>|null,
 *   customerEmail?: string|null,
 *   send?: bool|null,
 * }
 */
final class InvoiceFinalizeParams implements BaseModel
{
    /** @use SdkModel<InvoiceFinalizeParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $ifMatch;

    /**
     * 10 addresses or fewer.
     *
     * @var list<string>|null $ccEmails
     */
    #[Optional('cc_emails', list: 'string', nullable: true)]
    public ?array $ccEmails;

    #[Optional('customer_email', nullable: true)]
    public ?string $customerEmail;

    /**
     * `true` sends the invoice email after finalise.
     */
    #[Optional]
    public ?bool $send;

    /**
     * `new InvoiceFinalizeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceFinalizeParams::with(ifMatch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceFinalizeParams)->withIfMatch(...)
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
     * @param list<string>|null $ccEmails
     */
    public static function with(
        string $ifMatch,
        ?array $ccEmails = null,
        ?string $customerEmail = null,
        ?bool $send = null,
    ): self {
        $self = new self;

        $self['ifMatch'] = $ifMatch;

        null !== $ccEmails && $self['ccEmails'] = $ccEmails;
        null !== $customerEmail && $self['customerEmail'] = $customerEmail;
        null !== $send && $self['send'] = $send;

        return $self;
    }

    public function withIfMatch(string $ifMatch): self
    {
        $self = clone $this;
        $self['ifMatch'] = $ifMatch;

        return $self;
    }

    /**
     * 10 addresses or fewer.
     *
     * @param list<string>|null $ccEmails
     */
    public function withCcEmails(?array $ccEmails): self
    {
        $self = clone $this;
        $self['ccEmails'] = $ccEmails;

        return $self;
    }

    public function withCustomerEmail(?string $customerEmail): self
    {
        $self = clone $this;
        $self['customerEmail'] = $customerEmail;

        return $self;
    }

    /**
     * `true` sends the invoice email after finalise.
     */
    public function withSend(bool $send): self
    {
        $self = clone $this;
        $self['send'] = $send;

        return $self;
    }
}
