# Nova Signature Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/appstract/nova-signature-field.svg?style=flat-square)](https://packagist.org/packages/appstract/nova-signature-field)
[![Total Downloads](https://img.shields.io/packagist/dt/appstract/nova-signature-field.svg?style=flat-square)](https://packagist.org/packages/appstract/nova-signature-field)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Add a Signature Pad field to Nova.

## Installation

You can install the package via composer:

``` bash
composer require appstract/nova-signature-field
```

## Usage

Just add the field to you resource.

```php
public function fields(Request $request)
{
    return [
        Signature::make('Drawing')
    ];
}
```

## Contributing

Contributions are welcome, [thanks to y'all](https://github.com/appstract/nova-signature-field/graphs/contributors) :)

## About Appstract

Appstract is a small team from The Netherlands. We create (open source) tools for Web Developers and write about related subjects on [Medium](https://medium.com/appstract). You can [follow us on Twitter](https://twitter.com/appstractnl), [buy us a beer](https://www.paypal.me/appstract/10) or [support us on Patreon](https://www.patreon.com/appstract).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
