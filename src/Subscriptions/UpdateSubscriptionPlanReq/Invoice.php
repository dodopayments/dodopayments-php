<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\UpdateSubscriptionPlanReq;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\CollectionMethod;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms\DueOnReceipt;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms\Net;

/**
 * The invoice of a plan change billed now. Only invoice-led subscriptions read it.
 *
 * @phpstan-import-type PaymentTermsVariants from \Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms
 *
 * @phpstan-type InvoiceShape = array{
 *   collectionMethod?: null|CollectionMethod|value-of<CollectionMethod>,
 *   finalize?: bool|null,
 *   paymentTerms?: PaymentTermsShape|null,
 * }
 */
final class Invoice implements BaseModel
{
    /** @use SdkModel<InvoiceShape> */
    use SdkModel;

    /**
     * The collection method of the invoice. The subscription value applies when absent.
     *
     * @var value-of<CollectionMethod>|null $collectionMethod
     */
    #[Optional(
        'collection_method',
        enum: CollectionMethod::class,
        nullable: true
    )]
    public ?string $collectionMethod;

    /**
     * `false` keeps the invoice as a draft for review. Default `true`.
     */
    #[Optional]
    public ?bool $finalize;

    /**
     * The terms of the plan-change invoice. The subscription terms apply when absent.
     *
     * @var PaymentTermsVariants|null $paymentTerms
     */
    #[Optional('payment_terms', union: PaymentTerms::class, nullable: true)]
    public DueOnReceipt|Net|null $paymentTerms;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod
     * @param PaymentTermsShape|null $paymentTerms
     */
    public static function with(
        CollectionMethod|string|null $collectionMethod = null,
        ?bool $finalize = null,
        DueOnReceipt|array|Net|null $paymentTerms = null,
    ): self {
        $self = new self;

        null !== $collectionMethod && $self['collectionMethod'] = $collectionMethod;
        null !== $finalize && $self['finalize'] = $finalize;
        null !== $paymentTerms && $self['paymentTerms'] = $paymentTerms;

        return $self;
    }

    /**
     * The collection method of the invoice. The subscription value applies when absent.
     *
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod
     */
    public function withCollectionMethod(
        CollectionMethod|string|null $collectionMethod
    ): self {
        $self = clone $this;
        $self['collectionMethod'] = $collectionMethod;

        return $self;
    }

    /**
     * `false` keeps the invoice as a draft for review. Default `true`.
     */
    public function withFinalize(bool $finalize): self
    {
        $self = clone $this;
        $self['finalize'] = $finalize;

        return $self;
    }

    /**
     * The terms of the plan-change invoice. The subscription terms apply when absent.
     *
     * @param PaymentTermsShape|null $paymentTerms
     */
    public function withPaymentTerms(
        DueOnReceipt|array|Net|null $paymentTerms
    ): self {
        $self = clone $this;
        $self['paymentTerms'] = $paymentTerms;

        return $self;
    }
}
