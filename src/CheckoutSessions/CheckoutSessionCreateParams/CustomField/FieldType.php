<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\CustomField;

/**
 * Type of field determining validation rules.
 */
enum FieldType: string
{
    case TEXT = 'text';

    case NUMBER = 'number';

    case EMAIL = 'email';

    case URL = 'url';

    case PHONE = 'phone';

    case DATE = 'date';

    case DATETIME = 'datetime';

    case DROPDOWN = 'dropdown';

    case BOOLEAN = 'boolean';
}
