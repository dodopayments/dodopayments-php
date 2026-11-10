<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\CollectionMethod;
use Dodopayments\Invoices\DunningState;
use Dodopayments\Invoices\Invoice\AllowedAction;
use Dodopayments\Invoices\Invoice\BillingMode;
use Dodopayments\Invoices\Invoice\Customer;
use Dodopayments\Invoices\Invoice\EditableField;
use Dodopayments\Invoices\Invoice\Frequency;
use Dodopayments\Invoices\Invoice\Frequency\Mixed_;
use Dodopayments\Invoices\Invoice\Frequency\OneTime;
use Dodopayments\Invoices\Invoice\Frequency\Recurring;
use Dodopayments\Invoices\Invoice\Payment;
use Dodopayments\Invoices\Invoice\ReminderSettings;
use Dodopayments\Invoices\Invoice\ReminderSettings\Override;
use Dodopayments\Invoices\Invoice\ReminderSettings\Snapshot;
use Dodopayments\Invoices\Invoice\Tag;
use Dodopayments\Invoices\InvoiceLine;
use Dodopayments\Invoices\InvoiceStatus;
use Dodopayments\Misc\Currency;

/**
 * An invoice-led invoice. Every read and every `invoice.*` webhook uses this schema.
 *
 * @phpstan-import-type FrequencyVariants from \Dodopayments\Invoices\Invoice\Frequency
 * @phpstan-import-type ReminderSettingsVariants from \Dodopayments\Invoices\Invoice\ReminderSettings
 * @phpstan-import-type CustomerShape from \Dodopayments\Invoices\Invoice\Customer
 * @phpstan-import-type FrequencyShape from \Dodopayments\Invoices\Invoice\Frequency
 * @phpstan-import-type InvoiceLineShape from \Dodopayments\Invoices\InvoiceLine
 * @phpstan-import-type PaymentShape from \Dodopayments\Invoices\Invoice\Payment
 * @phpstan-import-type ReminderSettingsShape from \Dodopayments\Invoices\Invoice\ReminderSettings
 *
 * @phpstan-type InvoiceShape = array{
 *   allowedActions: list<AllowedAction|value-of<AllowedAction>>,
 *   amountDue: int,
 *   amountPaid: int,
 *   amountRefunded: int,
 *   billingMode: BillingMode|value-of<BillingMode>,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   credits: int,
 *   currency: Currency|value-of<Currency>,
 *   customer: Customer|CustomerShape,
 *   discountIDs: list<string>,
 *   editableFields: list<EditableField|value-of<EditableField>>,
 *   frequency: FrequencyShape,
 *   invoiceID: string,
 *   metadata: mixed,
 *   refundIDs: list<string>,
 *   retryCount: int,
 *   rowVersion: int,
 *   status: InvoiceStatus|value-of<InvoiceStatus>,
 *   subscriptionIDs: list<string>,
 *   tags: list<Tag|value-of<Tag>>,
 *   tax: int,
 *   totalAmount: int,
 *   collectionMethod?: null|CollectionMethod|value-of<CollectionMethod>,
 *   dueAt?: \DateTimeInterface|null,
 *   dunningState?: null|DunningState|value-of<DunningState>,
 *   finalizedAt?: \DateTimeInterface|null,
 *   hostedURL?: string|null,
 *   lines?: list<InvoiceLine|InvoiceLineShape>|null,
 *   memo?: string|null,
 *   nextReminderAt?: \DateTimeInterface|null,
 *   nextRetryAt?: \DateTimeInterface|null,
 *   paymentTermsDays?: int|null,
 *   payments?: list<\Dodopayments\Invoices\Invoice\Payment|PaymentShape>|null,
 *   pdfURL?: string|null,
 *   reminderSettings?: ReminderSettingsShape|null,
 *   reviewDeadline?: \DateTimeInterface|null,
 *   sentAt?: \DateTimeInterface|null,
 *   payloadType: 'Invoice',
 * }
 */
final class Invoice implements BaseModel
{
    /** @use SdkModel<InvoiceShape> */
    use SdkModel;

    /** @var 'Invoice' $payloadType */
    #[Required('payload_type')]
    public string $payloadType = 'Invoice';

    /**
     * The actions that the current status accepts.
     *
     * @var list<value-of<AllowedAction>> $allowedActions
     */
    #[Required('allowed_actions', list: AllowedAction::class)]
    public array $allowedActions;

    /**
     * The amount that the customer must pay. Zero unless the invoice is open or past due.
     */
    #[Required('amount_due')]
    public int $amountDue;

    /**
     * The sum of the succeeded payments, in the smallest currency unit. A late payment is not included after its late refund.
     */
    #[Required('amount_paid')]
    public int $amountPaid;

    /**
     * The sum of the succeeded refunds, in the currency of each payment. The late refund of a late payment is not included.
     */
    #[Required('amount_refunded')]
    public int $amountRefunded;

    /** @var value-of<BillingMode> $billingMode */
    #[Required('billing_mode', enum: BillingMode::class)]
    public string $billingMode;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Customer credits applied at finalise, in the smallest currency unit. Zero or less.
     */
    #[Required]
    public int $credits;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public Customer $customer;

    /**
     * The discount codes of the invoice.
     *
     * @var list<string> $discountIDs
     */
    #[Required('discount_ids', list: 'string')]
    public array $discountIDs;

    /**
     * The fields that `PATCH` can change in the current status.
     *
     * @var list<value-of<EditableField>> $editableFields
     */
    #[Required('editable_fields', list: EditableField::class)]
    public array $editableFields;

    /**
     * How often the invoice lines bill. `mixed` covers several intervals, or one-time lines next to a plan.
     *
     * @var FrequencyVariants $frequency
     */
    #[Required(union: Frequency::class)]
    public OneTime|Recurring|Mixed_ $frequency;

    #[Required('invoice_id')]
    public string $invoiceID;

    #[Required]
    public mixed $metadata;

    /** @var list<string> $refundIDs */
    #[Required('refund_ids', list: 'string')]
    public array $refundIDs;

    /**
     * The number of failed automatic charges.
     */
    #[Required('retry_count')]
    public int $retryCount;

    /**
     * Goes up by one on each change. Use it to ignore an older webhook delivery.
     */
    #[Required('row_version')]
    public int $rowVersion;

    /**
     * The `message` of each variant is the label of the invoice document.
     *
     * @var value-of<InvoiceStatus> $status
     */
    #[Required(enum: InvoiceStatus::class)]
    public string $status;

    /** @var list<string> $subscriptionIDs */
    #[Required('subscription_ids', list: 'string')]
    public array $subscriptionIDs;

    /** @var list<value-of<Tag>> $tags */
    #[Required(list: Tag::class)]
    public array $tags;

    /**
     * Tax in the smallest currency unit.
     */
    #[Required]
    public int $tax;

    /**
     * Total with tax, before credits, in the smallest currency unit.
     */
    #[Required('total_amount')]
    public int $totalAmount;

    /** @var value-of<CollectionMethod>|null $collectionMethod */
    #[Optional('collection_method', enum: CollectionMethod::class)]
    public ?string $collectionMethod;

    #[Optional('due_at', nullable: true)]
    public ?\DateTimeInterface $dueAt;

    /** @var value-of<DunningState>|null $dunningState */
    #[Optional('dunning_state', enum: DunningState::class)]
    public ?string $dunningState;

    #[Optional('finalized_at', nullable: true)]
    public ?\DateTimeInterface $finalizedAt;

    /**
     * The page where the customer pays. `null` until the invoice is sent.
     */
    #[Optional('hosted_url', nullable: true)]
    public ?string $hostedURL;

    /**
     * Only on a single invoice. A list leaves it out.
     *
     * @var list<InvoiceLine>|null $lines
     */
    #[Optional(list: InvoiceLine::class, nullable: true)]
    public ?array $lines;

    #[Optional(nullable: true)]
    public ?string $memo;

    /**
     * The time of the next reminder email to the customer, before or after the due date.
     * `null` when no reminder email will go out.
     */
    #[Optional('next_reminder_at', nullable: true)]
    public ?\DateTimeInterface $nextReminderAt;

    #[Optional('next_retry_at', nullable: true)]
    public ?\DateTimeInterface $nextRetryAt;

    /**
     * Days from finalise to the due date. `null` when the invoice has a custom due date.
     */
    #[Optional('payment_terms_days', nullable: true)]
    public ?int $paymentTermsDays;

    /**
     * Only on a single invoice. A list leaves it out.
     *
     * @var list<Payment>|null $payments
     */
    #[Optional(
        list: Payment::class,
        nullable: true
    )]
    public ?array $payments;

    #[Optional('pdf_url', nullable: true)]
    public ?string $pdfURL;

    /**
     * `null` on a draft that keeps all reminder settings of the business.
     *
     * @var ReminderSettingsVariants|null $reminderSettings
     */
    #[Optional(
        'reminder_settings',
        union: ReminderSettings::class,
        nullable: true
    )]
    public Snapshot|Override|null $reminderSettings;

    /**
     * The time at which a draft that waits for review finalises.
     */
    #[Optional('review_deadline', nullable: true)]
    public ?\DateTimeInterface $reviewDeadline;

    #[Optional('sent_at', nullable: true)]
    public ?\DateTimeInterface $sentAt;

    /**
     * `new Invoice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Invoice::with(
     *   allowedActions: ...,
     *   amountDue: ...,
     *   amountPaid: ...,
     *   amountRefunded: ...,
     *   billingMode: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   credits: ...,
     *   currency: ...,
     *   customer: ...,
     *   discountIDs: ...,
     *   editableFields: ...,
     *   frequency: ...,
     *   invoiceID: ...,
     *   metadata: ...,
     *   refundIDs: ...,
     *   retryCount: ...,
     *   rowVersion: ...,
     *   status: ...,
     *   subscriptionIDs: ...,
     *   tags: ...,
     *   tax: ...,
     *   totalAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Invoice)
     *   ->withAllowedActions(...)
     *   ->withAmountDue(...)
     *   ->withAmountPaid(...)
     *   ->withAmountRefunded(...)
     *   ->withBillingMode(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCredits(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withDiscountIDs(...)
     *   ->withEditableFields(...)
     *   ->withFrequency(...)
     *   ->withInvoiceID(...)
     *   ->withMetadata(...)
     *   ->withRefundIDs(...)
     *   ->withRetryCount(...)
     *   ->withRowVersion(...)
     *   ->withStatus(...)
     *   ->withSubscriptionIDs(...)
     *   ->withTags(...)
     *   ->withTax(...)
     *   ->withTotalAmount(...)
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
     * @param list<AllowedAction|value-of<AllowedAction>> $allowedActions
     * @param BillingMode|value-of<BillingMode> $billingMode
     * @param Currency|value-of<Currency> $currency
     * @param Customer|CustomerShape $customer
     * @param list<string> $discountIDs
     * @param list<EditableField|value-of<EditableField>> $editableFields
     * @param FrequencyShape $frequency
     * @param list<string> $refundIDs
     * @param InvoiceStatus|value-of<InvoiceStatus> $status
     * @param list<string> $subscriptionIDs
     * @param list<Tag|value-of<Tag>> $tags
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod
     * @param DunningState|value-of<DunningState>|null $dunningState
     * @param list<InvoiceLine|InvoiceLineShape>|null $lines
     * @param list<Payment|PaymentShape>|null $payments
     * @param ReminderSettingsShape|null $reminderSettings
     */
    public static function with(
        array $allowedActions,
        int $amountDue,
        int $amountPaid,
        int $amountRefunded,
        BillingMode|string $billingMode,
        string $businessID,
        \DateTimeInterface $createdAt,
        int $credits,
        Currency|string $currency,
        Customer|array $customer,
        array $discountIDs,
        array $editableFields,
        OneTime|array|Recurring|Mixed_ $frequency,
        string $invoiceID,
        mixed $metadata,
        array $refundIDs,
        int $retryCount,
        int $rowVersion,
        InvoiceStatus|string $status,
        array $subscriptionIDs,
        array $tags,
        int $tax,
        int $totalAmount,
        CollectionMethod|string|null $collectionMethod = null,
        ?\DateTimeInterface $dueAt = null,
        DunningState|string|null $dunningState = null,
        ?\DateTimeInterface $finalizedAt = null,
        ?string $hostedURL = null,
        ?array $lines = null,
        ?string $memo = null,
        ?\DateTimeInterface $nextReminderAt = null,
        ?\DateTimeInterface $nextRetryAt = null,
        ?int $paymentTermsDays = null,
        ?array $payments = null,
        ?string $pdfURL = null,
        Snapshot|array|Override|null $reminderSettings = null,
        ?\DateTimeInterface $reviewDeadline = null,
        ?\DateTimeInterface $sentAt = null,
    ): self {
        $self = new self;

        $self['allowedActions'] = $allowedActions;
        $self['amountDue'] = $amountDue;
        $self['amountPaid'] = $amountPaid;
        $self['amountRefunded'] = $amountRefunded;
        $self['billingMode'] = $billingMode;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['credits'] = $credits;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['discountIDs'] = $discountIDs;
        $self['editableFields'] = $editableFields;
        $self['frequency'] = $frequency;
        $self['invoiceID'] = $invoiceID;
        $self['metadata'] = $metadata;
        $self['refundIDs'] = $refundIDs;
        $self['retryCount'] = $retryCount;
        $self['rowVersion'] = $rowVersion;
        $self['status'] = $status;
        $self['subscriptionIDs'] = $subscriptionIDs;
        $self['tags'] = $tags;
        $self['tax'] = $tax;
        $self['totalAmount'] = $totalAmount;

        null !== $collectionMethod && $self['collectionMethod'] = $collectionMethod;
        null !== $dueAt && $self['dueAt'] = $dueAt;
        null !== $dunningState && $self['dunningState'] = $dunningState;
        null !== $finalizedAt && $self['finalizedAt'] = $finalizedAt;
        null !== $hostedURL && $self['hostedURL'] = $hostedURL;
        null !== $lines && $self['lines'] = $lines;
        null !== $memo && $self['memo'] = $memo;
        null !== $nextReminderAt && $self['nextReminderAt'] = $nextReminderAt;
        null !== $nextRetryAt && $self['nextRetryAt'] = $nextRetryAt;
        null !== $paymentTermsDays && $self['paymentTermsDays'] = $paymentTermsDays;
        null !== $payments && $self['payments'] = $payments;
        null !== $pdfURL && $self['pdfURL'] = $pdfURL;
        null !== $reminderSettings && $self['reminderSettings'] = $reminderSettings;
        null !== $reviewDeadline && $self['reviewDeadline'] = $reviewDeadline;
        null !== $sentAt && $self['sentAt'] = $sentAt;

        return $self;
    }

    /**
     * The actions that the current status accepts.
     *
     * @param list<AllowedAction|value-of<AllowedAction>> $allowedActions
     */
    public function withAllowedActions(array $allowedActions): self
    {
        $self = clone $this;
        $self['allowedActions'] = $allowedActions;

        return $self;
    }

    /**
     * The amount that the customer must pay. Zero unless the invoice is open or past due.
     */
    public function withAmountDue(int $amountDue): self
    {
        $self = clone $this;
        $self['amountDue'] = $amountDue;

        return $self;
    }

    /**
     * The sum of the succeeded payments, in the smallest currency unit. A late payment is not included after its late refund.
     */
    public function withAmountPaid(int $amountPaid): self
    {
        $self = clone $this;
        $self['amountPaid'] = $amountPaid;

        return $self;
    }

    /**
     * The sum of the succeeded refunds, in the currency of each payment. The late refund of a late payment is not included.
     */
    public function withAmountRefunded(int $amountRefunded): self
    {
        $self = clone $this;
        $self['amountRefunded'] = $amountRefunded;

        return $self;
    }

    /**
     * @param BillingMode|value-of<BillingMode> $billingMode
     */
    public function withBillingMode(BillingMode|string $billingMode): self
    {
        $self = clone $this;
        $self['billingMode'] = $billingMode;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Customer credits applied at finalise, in the smallest currency unit. Zero or less.
     */
    public function withCredits(int $credits): self
    {
        $self = clone $this;
        $self['credits'] = $credits;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * @param Customer|CustomerShape $customer
     */
    public function withCustomer(Customer|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * The discount codes of the invoice.
     *
     * @param list<string> $discountIDs
     */
    public function withDiscountIDs(array $discountIDs): self
    {
        $self = clone $this;
        $self['discountIDs'] = $discountIDs;

        return $self;
    }

    /**
     * The fields that `PATCH` can change in the current status.
     *
     * @param list<EditableField|value-of<EditableField>> $editableFields
     */
    public function withEditableFields(array $editableFields): self
    {
        $self = clone $this;
        $self['editableFields'] = $editableFields;

        return $self;
    }

    /**
     * How often the invoice lines bill. `mixed` covers several intervals, or one-time lines next to a plan.
     *
     * @param FrequencyShape $frequency
     */
    public function withFrequency(
        OneTime|array|Recurring|Mixed_ $frequency
    ): self {
        $self = clone $this;
        $self['frequency'] = $frequency;

        return $self;
    }

    public function withInvoiceID(string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param list<string> $refundIDs
     */
    public function withRefundIDs(array $refundIDs): self
    {
        $self = clone $this;
        $self['refundIDs'] = $refundIDs;

        return $self;
    }

    /**
     * The number of failed automatic charges.
     */
    public function withRetryCount(int $retryCount): self
    {
        $self = clone $this;
        $self['retryCount'] = $retryCount;

        return $self;
    }

    /**
     * Goes up by one on each change. Use it to ignore an older webhook delivery.
     */
    public function withRowVersion(int $rowVersion): self
    {
        $self = clone $this;
        $self['rowVersion'] = $rowVersion;

        return $self;
    }

    /**
     * The `message` of each variant is the label of the invoice document.
     *
     * @param InvoiceStatus|value-of<InvoiceStatus> $status
     */
    public function withStatus(InvoiceStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param list<string> $subscriptionIDs
     */
    public function withSubscriptionIDs(array $subscriptionIDs): self
    {
        $self = clone $this;
        $self['subscriptionIDs'] = $subscriptionIDs;

        return $self;
    }

    /**
     * @param list<Tag|value-of<Tag>> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Tax in the smallest currency unit.
     */
    public function withTax(int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * Total with tax, before credits, in the smallest currency unit.
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod
     */
    public function withCollectionMethod(
        CollectionMethod|string $collectionMethod
    ): self {
        $self = clone $this;
        $self['collectionMethod'] = $collectionMethod;

        return $self;
    }

    public function withDueAt(?\DateTimeInterface $dueAt): self
    {
        $self = clone $this;
        $self['dueAt'] = $dueAt;

        return $self;
    }

    /**
     * @param DunningState|value-of<DunningState> $dunningState
     */
    public function withDunningState(DunningState|string $dunningState): self
    {
        $self = clone $this;
        $self['dunningState'] = $dunningState;

        return $self;
    }

    public function withFinalizedAt(?\DateTimeInterface $finalizedAt): self
    {
        $self = clone $this;
        $self['finalizedAt'] = $finalizedAt;

        return $self;
    }

    /**
     * The page where the customer pays. `null` until the invoice is sent.
     */
    public function withHostedURL(?string $hostedURL): self
    {
        $self = clone $this;
        $self['hostedURL'] = $hostedURL;

        return $self;
    }

    /**
     * Only on a single invoice. A list leaves it out.
     *
     * @param list<InvoiceLine|InvoiceLineShape>|null $lines
     */
    public function withLines(?array $lines): self
    {
        $self = clone $this;
        $self['lines'] = $lines;

        return $self;
    }

    public function withMemo(?string $memo): self
    {
        $self = clone $this;
        $self['memo'] = $memo;

        return $self;
    }

    /**
     * The time of the next reminder email to the customer, before or after the due date.
     * `null` when no reminder email will go out.
     */
    public function withNextReminderAt(
        ?\DateTimeInterface $nextReminderAt
    ): self {
        $self = clone $this;
        $self['nextReminderAt'] = $nextReminderAt;

        return $self;
    }

    public function withNextRetryAt(?\DateTimeInterface $nextRetryAt): self
    {
        $self = clone $this;
        $self['nextRetryAt'] = $nextRetryAt;

        return $self;
    }

    /**
     * Days from finalise to the due date. `null` when the invoice has a custom due date.
     */
    public function withPaymentTermsDays(?int $paymentTermsDays): self
    {
        $self = clone $this;
        $self['paymentTermsDays'] = $paymentTermsDays;

        return $self;
    }

    /**
     * Only on a single invoice. A list leaves it out.
     *
     * @param list<Payment|PaymentShape>|null $payments
     */
    public function withPayments(?array $payments): self
    {
        $self = clone $this;
        $self['payments'] = $payments;

        return $self;
    }

    public function withPdfURL(?string $pdfURL): self
    {
        $self = clone $this;
        $self['pdfURL'] = $pdfURL;

        return $self;
    }

    /**
     * `null` on a draft that keeps all reminder settings of the business.
     *
     * @param ReminderSettingsShape|null $reminderSettings
     */
    public function withReminderSettings(
        Snapshot|array|Override|null $reminderSettings
    ): self {
        $self = clone $this;
        $self['reminderSettings'] = $reminderSettings;

        return $self;
    }

    /**
     * The time at which a draft that waits for review finalises.
     */
    public function withReviewDeadline(
        ?\DateTimeInterface $reviewDeadline
    ): self {
        $self = clone $this;
        $self['reviewDeadline'] = $reviewDeadline;

        return $self;
    }

    public function withSentAt(?\DateTimeInterface $sentAt): self
    {
        $self = clone $this;
        $self['sentAt'] = $sentAt;

        return $self;
    }

    /**
     * @param 'Invoice' $payloadType
     */
    public function withPayloadType(string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }
}
