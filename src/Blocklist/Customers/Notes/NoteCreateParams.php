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
 * @phpstan-type NoteCreateParamsShape = array{note: string}
 */
final class NoteCreateParams implements BaseModel
{
    /** @use SdkModel<NoteCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $note;

    /**
     * `new NoteCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NoteCreateParams::with(note: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NoteCreateParams)->withNote(...)
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
    public static function with(string $note): self
    {
        $self = new self;

        $self['note'] = $note;

        return $self;
    }

    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }
}
