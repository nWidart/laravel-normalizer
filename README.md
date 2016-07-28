# laravel-normalizer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nwidart/laravel-normalizer.svg?style=flat-square)](https://packagist.org/packages/nwidart/laravel-normalizer)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/nWidart/laravel-normalizer/master.svg?style=flat-square)](https://travis-ci.org/nWidart/laravel-normalizer)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/nWidart/laravel-normalizer.svg?maxAge=86400&style=flat-square)](https://scrutinizer-ci.com/g/nWidart/laravel-normalizer/?branch=master)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/0de1cad9-eca9-4907-9466-d4b943ab5183.svg?style=flat-square)](https://insight.sensiolabs.com/projects/0de1cad9-eca9-4907-9466-d4b943ab5183)
[![Quality Score](https://img.shields.io/scrutinizer/g/nWidart/laravel-normalizer.svg?style=flat-square)](https://scrutinizer-ci.com/g/nWidart/laravel-normalizer)
[![Total Downloads](https://img.shields.io/packagist/dt/nwidart/laravel-normalizer.svg?style=flat-square)](https://packagist.org/packages/nwidart/laravel-normalizer)

This package helps you normalize your data in order to save them into the database. The Goal is to having separate classes that handle the data normalization, and thus can be tested independently.

## Install

Via Composer

``` bash
$ composer require nwidart/laravel-normalizer
```

## Usage

### 1. Adding trait

Add the `Nwidart\LaravelNormalizer\Traits\CanNormalizeData` trait on the model(s) you wish data to be normalized.

### 2. Create Normalizer classes

Your normalizers classes need to implement the `Nwidart\LaravelNormalizer\Contracts\Normalizer` interface. This interface will add the `normalize(array $data)` method.

Example:

``` php
use Nwidart\LaravelNormalizer\Contracts\Normalizer;

final class CustomNormalizer implements Normalizer
{
    /**
     * Normalize the given data
     * @param array $data
     * @return array
     */
    public function normalize(array $data)
    {
        if (array_key_exists('name', $data)) {
            $data['name'] = strtoupper($data['name']);
        }

        return $data;
    }
}
```

This method needs to return the `$data` array. In here you can change the received data as you please.

### 3. Add `normalizers` class property

On that same model, add a `protected $normalizers` property. This is where you list your normalizers, in an array.

Example:

``` php
use Illuminate\Database\Eloquent\Model;
use Nwidart\LaravelNormalizer\Traits\CanNormalizeData;

class Product extends Model
{
    use CanNormalizeData;
    protected $normalizers = [CustomNormalizer::class];
}
```

### 4. Normalize your data on save/update

Now you can start normalizing your data. This can for instance be done in your repository class.

Example:

``` php
public function create($data)
{
    $data = $this->model->normalize($data);

    return $this->model->create($data);
}
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

If you discover any security related issues, please email n.widart@gmail.com instead of using the issue tracker.

## Credits

- [Nicolas Widart][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/nwidart/laravel-normalizer.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nwidart/laravel-normalizer/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nwidart/laravel-normalizer.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nwidart/laravel-normalizer.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nwidart/laravel-normalizer.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nwidart/laravel-normalizer
[link-travis]: https://travis-ci.org/nwidart/laravel-normalizer
[link-scrutinizer]: https://scrutinizer-ci.com/g/nwidart/laravel-normalizer/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nwidart/laravel-normalizer
[link-downloads]: https://packagist.org/packages/nwidart/laravel-normalizer
[link-author]: https://github.com/nwidart
[link-contributors]: ../../contributors
