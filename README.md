# Tutis

Tutis is a wrapper for handling passwords. It is provided with a password handler that uses `bcrypt` and allows you to
generate a hash, rehash and verify a password, all via a simple call to the `Tutis\Pass` object.

## Install

Via Composer

``` bash
$ composer require NigelGreenway/Tutis
```

## Usage

### Generate a pass for a user (using BasicPasswordHandler)

``` php
$username = 'bob.builder';

$password = '9455w0rd';
$options = [
    'cost' => 12,
];
$passwordHandler = Tutis\Handler\BasicPasswordHandler::hash($password, $options);

$pass = Tutis\Pass::generate($username, $passwordHandler, Tutis\Pass::ACTIVE);
echo $pass->toUsername() // bob.builder
echo $pass->toHash() // $0m3l0ngh4sh
```

### Authenticate the password

``` php
$username = 'bob.builder';
$password = '9455w0rd';
$hash     = '$0m3l0ngh4sh';

$pass = Tutis\Pass::authenticate(
    $username,
    $password,
    $hash,
    BasicPasswordHandler::class,
    1
)

var_dump($pass); // Instance of Tutis\Pass
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email github@futurepixels.co.uk instead of using the issue tracker.

## Credits

- [Nigel Greenway][link-author]
- [All Contributors][link-contributors]

## License

The Apache License (Apache). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/NigelGreenway/Tutis.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/NigelGreenway/Tutis/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/NigelGreenway/Tutis.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/NigelGreenway/Tutis.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/NigelGreenway/Tutis.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/NigelGreenway/Tutis
[link-travis]: https://travis-ci.org/NigelGreenway/Tutis
[link-scrutinizer]: https://scrutinizer-ci.com/g/NigelGreenway/Tutis/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/NigelGreenway/Tutis
[link-downloads]: https://packagist.org/packages/NigelGreenway/Tutis
[link-author]: https://github.com/NigelGreenway
[link-contributors]: ../../contributors