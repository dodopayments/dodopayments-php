<?php

declare(strict_types=1);

namespace Dodopayments\Products\Translations;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Deletes the translation of one locale.
 *
 * @see Dodopayments\Services\Products\TranslationsService::delete()
 *
 * @phpstan-type TranslationDeleteParamsShape = array{id: string}
 */
final class TranslationDeleteParams implements BaseModel
{
    /** @use SdkModel<TranslationDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new TranslationDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranslationDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranslationDeleteParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
