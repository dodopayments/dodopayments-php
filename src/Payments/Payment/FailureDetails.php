<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\Payment\FailureDetails\CustomerCta;
use Dodopayments\Payments\Payment\FailureDetails\CustomerTemplate;
use Dodopayments\Payments\Payment\FailureDetails\DeclineType;

/**
 * Purpose-built failure messaging for the merchant and the customer, derived
 * from `error_code`. Present whenever `error_code` is set, regardless of payment
 * status; unrecognised codes still resolve via a generic fallback rather than
 * being omitted. The customer copy is always generic for fraud-sensitive
 * declines (lost/stolen/pickup/fraudulent) so the true reason is never leaked.
 *
 * @phpstan-type FailureDetailsShape = array{
 *   code: string,
 *   customerCta: CustomerCta|value-of<CustomerCta>,
 *   customerFixable: bool,
 *   customerMessage: string,
 *   customerTemplate: CustomerTemplate|value-of<CustomerTemplate>,
 *   declineType: DeclineType|value-of<DeclineType>,
 *   merchantMessage: string,
 * }
 */
final class FailureDetails implements BaseModel
{
    /** @use SdkModel<FailureDetailsShape> */
    use SdkModel;

    /**
     * The unified error code (echoes `error_code`).
     */
    #[Required]
    public string $code;

    /**
     * The primary CTA to show the customer.
     *
     * @var value-of<CustomerCta> $customerCta
     */
    #[Required('customer_cta', enum: CustomerCta::class)]
    public string $customerCta;

    /**
     * Whether the customer can resolve this themselves (e.g. fix CVC).
     */
    #[Required('customer_fixable')]
    public bool $customerFixable;

    /**
     * The customer-facing string. Always generic (`C11`) for the fraud-4.
     */
    #[Required('customer_message')]
    public string $customerMessage;

    /**
     * The customer message template identifier (C1..C20).
     *
     * @var value-of<CustomerTemplate> $customerTemplate
     */
    #[Required('customer_template', enum: CustomerTemplate::class)]
    public string $customerTemplate;

    /**
     * Soft or hard decline.
     *
     * @var value-of<DeclineType> $declineType
     */
    #[Required('decline_type', enum: DeclineType::class)]
    public string $declineType;

    /**
     * Merchant-facing headline + recommended action (Payment Details). For the fraud-4
     * this includes the operator "do not reveal" warning.
     */
    #[Required('merchant_message')]
    public string $merchantMessage;

    /**
     * `new FailureDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FailureDetails::with(
     *   code: ...,
     *   customerCta: ...,
     *   customerFixable: ...,
     *   customerMessage: ...,
     *   customerTemplate: ...,
     *   declineType: ...,
     *   merchantMessage: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FailureDetails)
     *   ->withCode(...)
     *   ->withCustomerCta(...)
     *   ->withCustomerFixable(...)
     *   ->withCustomerMessage(...)
     *   ->withCustomerTemplate(...)
     *   ->withDeclineType(...)
     *   ->withMerchantMessage(...)
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
     * @param CustomerCta|value-of<CustomerCta> $customerCta
     * @param CustomerTemplate|value-of<CustomerTemplate> $customerTemplate
     * @param DeclineType|value-of<DeclineType> $declineType
     */
    public static function with(
        string $code,
        CustomerCta|string $customerCta,
        bool $customerFixable,
        string $customerMessage,
        CustomerTemplate|string $customerTemplate,
        DeclineType|string $declineType,
        string $merchantMessage,
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['customerCta'] = $customerCta;
        $self['customerFixable'] = $customerFixable;
        $self['customerMessage'] = $customerMessage;
        $self['customerTemplate'] = $customerTemplate;
        $self['declineType'] = $declineType;
        $self['merchantMessage'] = $merchantMessage;

        return $self;
    }

    /**
     * The unified error code (echoes `error_code`).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The primary CTA to show the customer.
     *
     * @param CustomerCta|value-of<CustomerCta> $customerCta
     */
    public function withCustomerCta(CustomerCta|string $customerCta): self
    {
        $self = clone $this;
        $self['customerCta'] = $customerCta;

        return $self;
    }

    /**
     * Whether the customer can resolve this themselves (e.g. fix CVC).
     */
    public function withCustomerFixable(bool $customerFixable): self
    {
        $self = clone $this;
        $self['customerFixable'] = $customerFixable;

        return $self;
    }

    /**
     * The customer-facing string. Always generic (`C11`) for the fraud-4.
     */
    public function withCustomerMessage(string $customerMessage): self
    {
        $self = clone $this;
        $self['customerMessage'] = $customerMessage;

        return $self;
    }

    /**
     * The customer message template identifier (C1..C20).
     *
     * @param CustomerTemplate|value-of<CustomerTemplate> $customerTemplate
     */
    public function withCustomerTemplate(
        CustomerTemplate|string $customerTemplate
    ): self {
        $self = clone $this;
        $self['customerTemplate'] = $customerTemplate;

        return $self;
    }

    /**
     * Soft or hard decline.
     *
     * @param DeclineType|value-of<DeclineType> $declineType
     */
    public function withDeclineType(DeclineType|string $declineType): self
    {
        $self = clone $this;
        $self['declineType'] = $declineType;

        return $self;
    }

    /**
     * Merchant-facing headline + recommended action (Payment Details). For the fraud-4
     * this includes the operator "do not reveal" warning.
     */
    public function withMerchantMessage(string $merchantMessage): self
    {
        $self = clone $this;
        $self['merchantMessage'] = $merchantMessage;

        return $self;
    }
}
