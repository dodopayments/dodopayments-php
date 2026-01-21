<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Customer's response to a custom field.
 *
 * @phpstan-type CustomFieldResponseShape = array{key: string, value: string}
 */
final class CustomFieldResponse implements BaseModel
{
    /** @use SdkModel<CustomFieldResponseShape> */
    use SdkModel;

    /**
     * Key matching the custom field definition.
     */
    #[Required]
    public string $key;

    /**
     * Value provided by customer.
     */
    #[Required]
    public string $value;

    /**
     * `new CustomFieldResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomFieldResponse::with(key: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomFieldResponse)->withKey(...)->withValue(...)
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
    public static function with(string $key, string $value): self
    {
        $self = new self;

        $self['key'] = $key;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Key matching the custom field definition.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * Value provided by customer.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
