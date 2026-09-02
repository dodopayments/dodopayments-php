<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers\Notes;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Blocklist\Customers\NotesService::update()
 *
 * @phpstan-type NoteUpdateParamsShape = array{entryID: string, note: string}
 */
final class NoteUpdateParams implements BaseModel
{
    /** @use SdkModel<NoteUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $entryID;

    #[Required]
    public string $note;

    /**
     * `new NoteUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NoteUpdateParams::with(entryID: ..., note: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NoteUpdateParams)->withEntryID(...)->withNote(...)
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
    public static function with(string $entryID, string $note): self
    {
        $self = new self;

        $self['entryID'] = $entryID;
        $self['note'] = $note;

        return $self;
    }

    public function withEntryID(string $entryID): self
    {
        $self = clone $this;
        $self['entryID'] = $entryID;

        return $self;
    }

    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }
}
