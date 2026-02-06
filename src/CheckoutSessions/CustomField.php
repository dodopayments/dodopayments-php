<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\CustomField\FieldType;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Definition of a custom field for checkout.
 *
 * @phpstan-type CustomFieldShape = array{
 *   fieldType: FieldType|value-of<FieldType>,
 *   key: string,
 *   label: string,
 *   options?: list<string>|null,
 *   placeholder?: string|null,
 *   required?: bool|null,
 * }
 */
final class CustomField implements BaseModel
{
    /** @use SdkModel<CustomFieldShape> */
    use SdkModel;

    /**
     * Type of field determining validation rules.
     *
     * @var value-of<FieldType> $fieldType
     */
    #[Required('field_type', enum: FieldType::class)]
    public string $fieldType;

    /**
     * Unique identifier for this field (used as key in responses).
     */
    #[Required]
    public string $key;

    /**
     * Display label shown to customer.
     */
    #[Required]
    public string $label;

    /**
     * Options for dropdown type (required for dropdown, ignored for others).
     *
     * @var list<string>|null $options
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $options;

    /**
     * Placeholder text for the input.
     */
    #[Optional(nullable: true)]
    public ?string $placeholder;

    /**
     * Whether this field is required.
     */
    #[Optional]
    public ?bool $required;

    /**
     * `new CustomField()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomField::with(fieldType: ..., key: ..., label: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomField)->withFieldType(...)->withKey(...)->withLabel(...)
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
     * @param FieldType|value-of<FieldType> $fieldType
     * @param list<string>|null $options
     */
    public static function with(
        FieldType|string $fieldType,
        string $key,
        string $label,
        ?array $options = null,
        ?string $placeholder = null,
        ?bool $required = null,
    ): self {
        $self = new self;

        $self['fieldType'] = $fieldType;
        $self['key'] = $key;
        $self['label'] = $label;

        null !== $options && $self['options'] = $options;
        null !== $placeholder && $self['placeholder'] = $placeholder;
        null !== $required && $self['required'] = $required;

        return $self;
    }

    /**
     * Type of field determining validation rules.
     *
     * @param FieldType|value-of<FieldType> $fieldType
     */
    public function withFieldType(FieldType|string $fieldType): self
    {
        $self = clone $this;
        $self['fieldType'] = $fieldType;

        return $self;
    }

    /**
     * Unique identifier for this field (used as key in responses).
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * Display label shown to customer.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * Options for dropdown type (required for dropdown, ignored for others).
     *
     * @param list<string>|null $options
     */
    public function withOptions(?array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }

    /**
     * Placeholder text for the input.
     */
    public function withPlaceholder(?string $placeholder): self
    {
        $self = clone $this;
        $self['placeholder'] = $placeholder;

        return $self;
    }

    /**
     * Whether this field is required.
     */
    public function withRequired(bool $required): self
    {
        $self = clone $this;
        $self['required'] = $required;

        return $self;
    }
}
