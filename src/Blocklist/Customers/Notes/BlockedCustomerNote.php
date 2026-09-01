<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers\Notes;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlockedCustomerNoteShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   note: string,
 *   authorEmail?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class BlockedCustomerNote implements BaseModel
{
    /** @use SdkModel<BlockedCustomerNoteShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public string $note;

    #[Optional('author_email', nullable: true)]
    public ?string $authorEmail;

    #[Optional('updated_at', nullable: true)]
    public ?\DateTimeInterface $updatedAt;

    /**
     * `new BlockedCustomerNote()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockedCustomerNote::with(id: ..., createdAt: ..., note: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockedCustomerNote)->withID(...)->withCreatedAt(...)->withNote(...)
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
        \DateTimeInterface $createdAt,
        string $note,
        ?string $authorEmail = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['note'] = $note;

        null !== $authorEmail && $self['authorEmail'] = $authorEmail;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    public function withAuthorEmail(?string $authorEmail): self
    {
        $self = clone $this;
        $self['authorEmail'] = $authorEmail;

        return $self;
    }

    public function withUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
