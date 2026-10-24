<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Locale;
use Dodopayments\Misc\MetadataItem;

/**
 * @see Dodopayments\Services\CustomersService::update()
 *
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 *
 * @phpstan-type CustomerUpdateParamsShape = array{
 *   email?: string|null,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   name?: string|null,
 *   phoneNumber?: string|null,
 *   preferredLocale?: null|Locale|value-of<Locale>,
 * }
 */
final class CustomerUpdateParams implements BaseModel
{
    /** @use SdkModel<CustomerUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * Additional metadata for the customer.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class, nullable: true)]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    /**
     * The language of the customer emails, a code from `GET /locales`. A value replaces the
     * current language, and `null` removes it. Send this field only to change the language
     * on purpose. With no language, the emails are in English.
     *
     * @var value-of<Locale>|null $preferredLocale
     */
    #[Optional('preferred_locale', enum: Locale::class, nullable: true)]
    public ?string $preferredLocale;

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
        ?string $email = null,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        Locale|string|null $preferredLocale = null,
    ): self {
        $self = new self;

        null !== $email && $self['email'] = $email;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $preferredLocale && $self['preferredLocale'] = $preferredLocale;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Additional metadata for the customer.
     *
     * @param array<string,MetadataItemShape>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * The language of the customer emails, a code from `GET /locales`. A value replaces the
     * current language, and `null` removes it. Send this field only to change the language
     * on purpose. With no language, the emails are in English.
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
