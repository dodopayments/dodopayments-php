<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

enum PaymentMethodTypes: string
{
    case ACH = 'ach';

    case AFFIRM = 'affirm';

    case AFTERPAY_CLEARPAY = 'afterpay_clearpay';

    case ALFAMART = 'alfamart';

    case ALI_PAY = 'ali_pay';

    case ALI_PAY_HK = 'ali_pay_hk';

    case ALMA = 'alma';

    case AMAZON_PAY = 'amazon_pay';

    case APPLE_PAY = 'apple_pay';

    case ATOME = 'atome';

    case BACS = 'bacs';

    case BANCONTACT_CARD = 'bancontact_card';

    case BECS = 'becs';

    case BENEFIT = 'benefit';

    case BIZUM = 'bizum';

    case BLIK = 'blik';

    case BOLETO = 'boleto';

    case BCA_BANK_TRANSFER = 'bca_bank_transfer';

    case BNI_VA = 'bni_va';

    case BRI_VA = 'bri_va';

    case CARD_REDIRECT = 'card_redirect';

    case CIMB_VA = 'cimb_va';

    case CLASSIC = 'classic';

    case CREDIT = 'credit';

    case CRYPTO_CURRENCY = 'crypto_currency';

    case CASHAPP = 'cashapp';

    case DANA = 'dana';

    case DANAMON_VA = 'danamon_va';

    case DEBIT = 'debit';

    case DUIT_NOW = 'duit_now';

    case EFECTY = 'efecty';

    case EFT = 'eft';

    case EPS = 'eps';

    case FPS = 'fps';

    case EVOUCHER = 'evoucher';

    case GIROPAY = 'giropay';

    case GIVEX = 'givex';

    case GOOGLE_PAY = 'google_pay';

    case GO_PAY = 'go_pay';

    case GCASH = 'gcash';

    case IDEAL = 'ideal';

    case INTERAC = 'interac';

    case INDOMARET = 'indomaret';

    case KLARNA = 'klarna';

    case KAKAO_PAY = 'kakao_pay';

    case LOCAL_BANK_REDIRECT = 'local_bank_redirect';

    case MANDIRI_VA = 'mandiri_va';

    case KNET = 'knet';

    case MB_WAY = 'mb_way';

    case MOBILE_PAY = 'mobile_pay';

    case MOMO = 'momo';

    case MOMO_ATM = 'momo_atm';

    case MULTIBANCO = 'multibanco';

    case ONLINE_BANKING_THAILAND = 'online_banking_thailand';

    case ONLINE_BANKING_CZECH_REPUBLIC = 'online_banking_czech_republic';

    case ONLINE_BANKING_FINLAND = 'online_banking_finland';

    case ONLINE_BANKING_FPX = 'online_banking_fpx';

    case ONLINE_BANKING_POLAND = 'online_banking_poland';

    case ONLINE_BANKING_SLOVAKIA = 'online_banking_slovakia';

    case OXXO = 'oxxo';

    case PAGO_EFECTIVO = 'pago_efectivo';

    case PERMATA_BANK_TRANSFER = 'permata_bank_transfer';

    case OPEN_BANKING_UK = 'open_banking_uk';

    case PAY_BRIGHT = 'pay_bright';

    case PAYPAL = 'paypal';

    case PAZE = 'paze';

    case PIX = 'pix';

    case PAY_SAFE_CARD = 'pay_safe_card';

    case PRZELEWY24 = 'przelewy24';

    case PROMPT_PAY = 'prompt_pay';

    case PSE = 'pse';

    case RED_COMPRA = 'red_compra';

    case RED_PAGOS = 'red_pagos';

    case SAMSUNG_PAY = 'samsung_pay';

    case SEPA = 'sepa';

    case SEPA_BANK_TRANSFER = 'sepa_bank_transfer';

    case SOFORT = 'sofort';

    case SWISH = 'swish';

    case TOUCH_N_GO = 'touch_n_go';

    case TRUSTLY = 'trustly';

    case TWINT = 'twint';

    case UPI_COLLECT = 'upi_collect';

    case UPI_INTENT = 'upi_intent';

    case VIPPS = 'vipps';

    case VIET_QR = 'viet_qr';

    case VENMO = 'venmo';

    case WALLEY = 'walley';

    case WE_CHAT_PAY = 'we_chat_pay';

    case SEVEN_ELEVEN = 'seven_eleven';

    case LAWSON = 'lawson';

    case MINI_STOP = 'mini_stop';

    case FAMILY_MART = 'family_mart';

    case SEICOMART = 'seicomart';

    case PAY_EASY = 'pay_easy';

    case LOCAL_BANK_TRANSFER = 'local_bank_transfer';

    case MIFINITY = 'mifinity';

    case OPEN_BANKING_PIS = 'open_banking_pis';

    case DIRECT_CARRIER_BILLING = 'direct_carrier_billing';

    case INSTANT_BANK_TRANSFER = 'instant_bank_transfer';

    case BILLIE = 'billie';

    case ZIP = 'zip';

    case REVOLUT_PAY = 'revolut_pay';

    case NAVER_PAY = 'naver_pay';

    case PAYCO = 'payco';
}
