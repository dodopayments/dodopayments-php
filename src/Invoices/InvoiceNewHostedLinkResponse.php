<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceNewHostedLinkResponseShape = array{
 *   expiresAt: \DateTimeInterface, hostedURL: string
 * }
 */
final class InvoiceNewHostedLinkResponse implements BaseModel
{
    /** @use SdkModel<InvoiceNewHostedLinkResponseShape> */
    use SdkModel;

    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    #[Required('hosted_url')]
    public string $hostedURL;

    /**
     * `new InvoiceNewHostedLinkResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceNewHostedLinkResponse::with(expiresAt: ..., hostedURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceNewHostedLinkResponse)->withExpiresAt(...)->withHostedURL(...)
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
    public static function with(
        \DateTimeInterface $expiresAt,
        string $hostedURL
    ): self {
        $self = new self;

        $self['expiresAt'] = $expiresAt;
        $self['hostedURL'] = $hostedURL;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withHostedURL(string $hostedURL): self
    {
        $self = clone $this;
        $self['hostedURL'] = $hostedURL;

        return $self;
    }
}
