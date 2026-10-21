<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Invoices\PaymentsService::retrievePayout()
 *
 * @phpstan-type PaymentRetrievePayoutParamsShape = array{token?: string|null}
 */
final class PaymentRetrievePayoutParams implements BaseModel
{
    /** @use SdkModel<PaymentRetrievePayoutParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The signed link token. If the business asks for a credential on its invoice links, a valid token for this record replaces the credential.
     */
    #[Optional]
    public ?string $token;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $token = null): self
    {
        $self = new self;

        null !== $token && $self['token'] = $token;

        return $self;
    }

    /**
     * The signed link token. If the business asks for a credential on its invoice links, a valid token for this record replaces the credential.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }
}
