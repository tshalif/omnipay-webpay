# Omnipay: Webpay

**webpay.jp payment processing driver for the Omnipay PHP payment processing library**

Important note: at the moment, only the '$gateway->authorize()' is implemented..

[![Build Status](https://travis-ci.org/tshalif/omnipay-webpay.svg?branch=master)](https://travis-ci.org/tshalif/omnipay-webpay) [![Coverage Status](https://coveralls.io/repos/github/tshalif/omnipay-webpay/badge.svg?branch=master)](https://coveralls.io/github/tshalif/omnipay-webpay?branch=master) [![Latest Stable Version](https://poser.pugx.org/tshalif/omnipay-webpay/v/stable.svg)](https://packagist.org/packages/tshalif/omnipay-webpay) [![Total Downloads](https://poser.pugx.org/tshalif/omnipay-webpay/downloads)](https://packagist.org/packages/tshalif/omnipay-webpay)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Webpay support for Omnipay. Please see the [Webpay main site (Japanese)](https://webpay.jp/) for more information.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "tshalif/omnipay-webpay": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Webpay

```php
    $gateway = Omnipay\Omnipay::create('Webpay');
    $gateway->setAuthToken('test_secret_xxxxxxxxxxxxxxxxxxxxxxxx');

    $card = new Omnipay\Common\CreditCard();

    $card->setNumber("4242424242424242");
    $card->setExpiryMonth("10");
    $card->setExpiryYear("2020");
    $card->setCvv("123");
    $card->setName("ZAPHOD BEEBLEBROX");
    
    try {
        $params = array(
            'amount'                => 4200,
            'card'                  => $card,
        );

        $response = $gateway->authorize($params)->send();

        if ($response->isSuccessful()) {
            // successful
        } else {
            throw new ApplicationException($response->getMessage());
        }
    } catch (ApplicationException $e) {
        throw new ApplicationException($e->getMessage());
    }

```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/tshalif/omnipay-webpay/issues),
or better yet, fork the library and submit a pull request.
