<?php

declare(strict_types=1);

namespace Dodopayments\Misc;

/**
 * A locale that the checkout and the customer portal can show.
 *
 * The codes are a copy of the checkout locales. `GET /locales` lists them.
 */
enum Locale: string
{
    case AR = 'ar';

    case CA = 'ca';

    case ZH = 'zh';

    case NL = 'nl';

    case EN = 'en';

    case FR = 'fr';

    case DE = 'de';

    case HE = 'he';

    case ID = 'id';

    case IT = 'it';

    case JA = 'ja';

    case KA = 'ka';

    case KO = 'ko';

    case MS = 'ms';

    case PL = 'pl';

    case PT = 'pt';

    case RO = 'ro';

    case RU = 'ru';

    case ES = 'es';

    case SV = 'sv';

    case TH = 'th';

    case TR = 'tr';
}
