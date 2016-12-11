This is a Lavalite package that provides test management facility.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `test/test`.

    "test/test": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Test\Test\Providers\TestServiceProvider::class,

```

And also add it to alias

```php
'Test'  => Test\Test\Facades\Test::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Test\Test\Providers\TestServiceProvider" --tag="migrations"

    php artisan vendor:publish --provider="Test\Test\Providers\TestServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Test\Test\Providers\TestServiceProvider" --tag="config"

Language files

    php artisan vendor:publish --provider="Test\Test\Providers\TestServiceProvider" --tag="lang"

View files

    php artisan vendor:publish --provider="Test\Test\Providers\TestServiceProvider" --tag="views"

Public folders

    php artisan vendor:publish --provider="Test\Test\Providers\TestServiceProvider" --tag="public"


## Usage


