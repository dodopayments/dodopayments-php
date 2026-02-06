<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CustomField;

/**
 * Type of field determining validation rules.
 */
enum FieldType: string
{
    case TEXT = 'text';

    case NUMBER = 'number';

    case EMAIL = 'email';

    case URL = 'url';

    case DATE = 'date';

    case DROPDOWN = 'dropdown';

    case BOOLEAN = 'boolean';
}
