<?php

declare(strict_types=1);

namespace Dodopayments\Meters\Translations;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Creates or replaces the translation of one locale. The response is 201 for a new
 * locale and 200 for a replaced locale.
 *
 * @see Dodopayments\Services\Meters\TranslationsService::update()
 *
 * @phpstan-type TranslationUpdateParamsShape = array{
 *   id: string, description?: string|null, name?: string|null
 * }
 */
final class TranslationUpdateParams implements BaseModel
{
    /** @use SdkModel<TranslationUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * The translated description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * The translated name.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new TranslationUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranslationUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranslationUpdateParams)->withID(...)
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
        string $id,
        ?string $description = null,
        ?string $name = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The translated description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The translated name.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
