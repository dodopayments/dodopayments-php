<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers\Notes;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Blocklist\Customers\NotesService::create()
 *
 * @phpstan-type NoteCreateParamsShape = array{text: string}
 */
final class NoteCreateParams implements BaseModel
{
    /** @use SdkModel<NoteCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $text;

    /**
     * `new NoteCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NoteCreateParams::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NoteCreateParams)->withText(...)
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
    public static function with(string $text): self
    {
        $self = new self;

        $self['text'] = $text;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
