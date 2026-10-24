<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Locale;
use Dodopayments\Misc\MetadataItem;

/**
 * @see Dodopayments\Services\CustomersService::create()
 *
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 *
 * @phpstan-type CustomerCreateParamsShape = array{
 *   email: string,
 *   name: string,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   phoneNumber?: string|null,
 *   preferredLocale?: null|Locale|value-of<Locale>,
 * }
 */
final class CustomerCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $email;

    #[Required]
    public string $name;

    /**
     * Additional metadata for the customer.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class)]
    public ?array $metadata;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    /**
     * The language of the customer emails, a code from `GET /locales`. With no value, the
     * emails are in English until a checkout or the customer portal sets a language.
     *
     * @var value-of<Locale>|null $preferredLocale
     */
    #[Optional('preferred_locale', enum: Locale::class, nullable: true)]
    public ?string $preferredLocale;

    /**
     * `new CustomerCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerCreateParams::with(email: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerCreateParams)->withEmail(...)->withName(...)
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
     * @param array<string,MetadataItemShape>|null $metadata
     * @param Locale|value-of<Locale>|null $preferredLocale
     */
    public static function with(
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
        Locale|string|null $preferredLocale = null,
    ): self {
        $self = new self;

        $self['email'] = $email;
        $self['name'] = $name;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $preferredLocale && $self['preferredLocale'] = $preferredLocale;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Additional metadata for the customer.
     *
     * @param array<string,MetadataItemShape> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * The language of the customer emails, a code from `GET /locales`. With no value, the
     * emails are in English until a checkout or the customer portal sets a language.
     *
     * @param Locale|value-of<Locale>|null $preferredLocale
     */
    public function withPreferredLocale(
        Locale|string|null $preferredLocale
    ): self {
        $self = clone $this;
        $self['preferredLocale'] = $preferredLocale;

        return $self;
    }
}
