<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotionConfigShape = array{notionTemplateID: string}
 */
final class NotionConfig implements BaseModel
{
    /** @use SdkModel<NotionConfigShape> */
    use SdkModel;

    #[Required('notion_template_id')]
    public string $notionTemplateID;

    /**
     * `new NotionConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotionConfig::with(notionTemplateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotionConfig)->withNotionTemplateID(...)
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
    public static function with(string $notionTemplateID): self
    {
        $self = new self;

        $self['notionTemplateID'] = $notionTemplateID;

        return $self;
    }

    public function withNotionTemplateID(string $notionTemplateID): self
    {
        $self = clone $this;
        $self['notionTemplateID'] = $notionTemplateID;

        return $self;
    }
}
