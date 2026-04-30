<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementGetResponse;

enum IntegrationType: string
{
    case DISCORD = 'discord';

    case TELEGRAM = 'telegram';

    case GITHUB = 'github';

    case FIGMA = 'figma';

    case FRAMER = 'framer';

    case NOTION = 'notion';

    case DIGITAL_FILES = 'digital_files';

    case LICENSE_KEY = 'license_key';
}
