<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following gateway to use.
    | You can switch to a different driver at runtime.
    |
    */
    'default' => 'sep',

    /*
    |--------------------------------------------------------------------------
    | List of Drivers
    |--------------------------------------------------------------------------
    |
    | These are the list of drivers to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */
    'drivers' => [
        'local' => [
            'callbackUrl' => '/callback',
            'title' => 'درگاه پرداخت تست',
            'description' => 'این درگاه *صرفا* برای تست صحت روند پرداخت و لغو پرداخت میباشد',
            'orderLabel' => 'شماره سفارش',
            'amountLabel' => 'مبلغ قابل پرداخت',
            'payButton' => 'پرداخت موفق',
            'cancelButton' => 'پرداخت ناموفق',
        ],
        
        'nextpay' => [
            'apiPurchaseUrl' => 'https://nextpay.org/nx/gateway/token',
            'apiPaymentUrl' => 'https://nextpay.org/nx/gateway/payment/',
            'apiVerificationUrl' => 'https://nextpay.org/nx/gateway/verify',
            'merchantId' => '',
            'callbackUrl' => 'http://yoursite.com/path/to',
            'description' => 'payment using nextpay',
            'currency' => 'T', //Can be R, T (Rial, Toman)
        ],
        
        'paypal' => [
            /* normal api */
            'apiPurchaseUrl' => 'https://www.paypal.com/cgi-bin/webscr',
            'apiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/',
            'apiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',

            /* sandbox api */
            'sandboxApiPurchaseUrl' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
            'sandboxApiPaymentUrl' => 'https://sandbox.zarinpal.com/pg/StartPay/',
            'sandboxApiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',

            'mode' => 'normal', // can be normal, sandbox
            'id' => '', // Specify the email of the PayPal Business account
            'callbackUrl' => 'http://yoursite.com/path/to',
            'description' => 'payment using paypal',
            'currency' => 'T', //Can be R, T (Rial, Toman)
        ],
       
        'saman' => [
            'apiPurchaseUrl' => 'https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',
            'apiPaymentUrl' => 'https://sep.shaparak.ir/payment.aspx',
            'apiVerificationUrl' => 'https://sep.shaparak.ir/payments/referencepayment.asmx?WSDL',
            'merchantId' => '',
            'callbackUrl' => '',
            'description' => 'payment using saman',
            'currency' => 'T', //Can be R, T (Rial, Toman)
        ],
        'sep' => [
            'apiGetToken' => 'https://sep.shaparak.ir/onlinepg/onlinepg',
            'apiPaymentUrl' => 'https://sep.shaparak.ir/OnlinePG/OnlinePG',
            'apiVerificationUrl' => 'https://sep.shaparak.ir/verifyTxnRandomSessionkey/ipg/VerifyTransaction',
            'terminalId' => '14642597',
            'callbackUrl' => '/userPay/callback',
            'description' => 'Saman Electronic Payment for Saderat & Keshavarzi',
            'currency' => 'R', //Can be R, T (Rial, Toman)
        ],
        'sepehr' => [
            'apiGetToken' => 'https://sepehr.shaparak.ir:8081/V1/PeymentApi/GetToken',
            'apiPaymentUrl' => 'https://sepehr.shaparak.ir:8080/Pay',
            'apiVerificationUrl' => 'https://sepehr.shaparak.ir:8081/V1/PeymentApi/Advice',
            'terminalId' => '14642597',
            'callbackUrl' => '/userPay/callback',
            'description' => 'payment using sepehr(saderat)',
            'currency' => 'T', //Can be R, T (Rial, Toman)
        ],
       
        'zarinpal' => [
            /* normal api */
            'apiPurchaseUrl' => 'https://api.zarinpal.com/pg/v4/payment/request.json',
            'apiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/',
            'apiVerificationUrl' => 'https://api.zarinpal.com/pg/v4/payment/verify.json',

            /* sandbox api */
            'sandboxApiPurchaseUrl' => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
            'sandboxApiPaymentUrl'  => 'https://sandbox.zarinpal.com/pg/StartPay/',
            'sandboxApiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',

            /* zarinGate api */
            'zaringateApiPurchaseUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
            'zaringateApiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/:authority/ZarinGate',
            'zaringateApiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',

            'mode' => 'sandbox', // can be normal, sandbox, zaringate
            'merchantId' => '',
            'callbackUrl' => 'http://yoursite.com/path/to',
            'description' => 'payment using zarinpal',
            'currency' => 'T', //Can be R, T (Rial, Toman)
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Drivers above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to extend
    | Shetabit\Multipay\Abstracts\Driver in your driver.
    |
    */
    'map' => [
        'local' => \Shetabit\Multipay\Drivers\Local\Local::class,
        'gooyapay' => \Shetabit\Multipay\Drivers\Gooyapay\Gooyapay::class,
        'fanavacard' => \Shetabit\Multipay\Drivers\Fanavacard\Fanavacard::class,
        'asanpardakht' => \Shetabit\Multipay\Drivers\Asanpardakht\Asanpardakht::class,
        'atipay' => \Shetabit\Multipay\Drivers\Atipay\Atipay::class,
        'behpardakht' => \Shetabit\Multipay\Drivers\Behpardakht\Behpardakht::class,
        'digipay' => \Shetabit\Multipay\Drivers\Digipay\Digipay::class,
        'etebarino' => \Shetabit\Multipay\Drivers\Etebarino\Etebarino::class,
        'idpay' => \Shetabit\Multipay\Drivers\Idpay\Idpay::class,
        'irandargah' => \Shetabit\Multipay\Drivers\IranDargah\IranDargah::class,
        'irankish' => \Shetabit\Multipay\Drivers\Irankish\Irankish::class,
        'jibit' => \Shetabit\Multipay\Drivers\Jibit\Jibit::class,
        'nextpay' => \Shetabit\Multipay\Drivers\Nextpay\Nextpay::class,
        'omidpay' => \Shetabit\Multipay\Drivers\Omidpay\Omidpay::class,
        'parsian' => \Shetabit\Multipay\Drivers\Parsian\Parsian::class,
        'parspal' => \Shetabit\Multipay\Drivers\Parspal\Parspal::class,
        'pasargad' => \Shetabit\Multipay\Drivers\Pasargad\Pasargad::class,
        'payir' => \Shetabit\Multipay\Drivers\Payir\Payir::class,
        'paypal' => \Shetabit\Multipay\Drivers\Paypal\Paypal::class,
        'payping' => \Shetabit\Multipay\Drivers\Payping\Payping::class,
        'paystar' => \Shetabit\Multipay\Drivers\Paystar\Paystar::class,
        'poolam' => \Shetabit\Multipay\Drivers\Poolam\Poolam::class,
        'sadad' => \Shetabit\Multipay\Drivers\Sadad\Sadad::class,
        'saman' => \Shetabit\Multipay\Drivers\Saman\Saman::class,
        'sep' => \Shetabit\Multipay\Drivers\SEP\SEP::class,
        'sepehr' => \Shetabit\Multipay\Drivers\Sepehr\Sepehr::class,
        'walleta' => \Shetabit\Multipay\Drivers\Walleta\Walleta::class,
        'yekpay' => \Shetabit\Multipay\Drivers\Yekpay\Yekpay::class,
        'zarinpal' => \Shetabit\Multipay\Drivers\Zarinpal\Zarinpal::class,
        'zibal' => \Shetabit\Multipay\Drivers\Zibal\Zibal::class,
        'sepordeh' => \Shetabit\Multipay\Drivers\Sepordeh\Sepordeh::class,
        'rayanpay' => \Shetabit\Multipay\Drivers\Rayanpay\Rayanpay::class,
        'shepa' => \Shetabit\Multipay\Drivers\Shepa\Shepa::class,
        'sizpay' => \Shetabit\Multipay\Drivers\Sizpay\Sizpay::class,
        'vandar' => \Shetabit\Multipay\Drivers\Vandar\Vandar::class,
        'aqayepardakht' => \Shetabit\Multipay\Drivers\Aqayepardakht\Aqayepardakht::class,
        'azki' => \Shetabit\Multipay\Drivers\Azki\Azki::class,
        'payfa' => \Shetabit\Multipay\Drivers\Payfa\Payfa::class,
        'toman' => \Shetabit\Multipay\Drivers\Toman\Toman::class,
        'bitpay' => \Shetabit\Multipay\Drivers\Bitpay\Bitpay::class,
        'minipay' => \Shetabit\Multipay\Drivers\Minipay\Minipay::class,
        'snapppay' => \Shetabit\Multipay\Drivers\SnappPay\SnappPay::class,
        'pna' => \Shetabit\Multipay\Drivers\Pna\Pna::class
    ]
];
