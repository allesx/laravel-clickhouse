# Laravel Clickhouse

[![Latest Stable Version](https://poser.pugx.org/allesx/laravel-clickhouse/v/stable)](https://packagist.org/packages/allesx/laravel-clickhouse)
[![Latest Unstable Version](https://poser.pugx.org/allesx/laravel-clickhouse/v/unstable)](https://packagist.org/packages/allesx/laravel-clickhouse)
[![License](https://poser.pugx.org/allesx/laravel-clickhouse/license)](https://packagist.org/packages/allesx/laravel-clickhouse)
[![composer.lock](https://poser.pugx.org/allesx/laravel-clickhouse/composerlock)](https://packagist.org/packages/allesx/laravel-clickhouse)

Laravel Clickhouse - Eloquent model for ClickHouse.

* **Vendor**: allesx
* **Package**: Laravel Clickhouse
* **Version**: [![Latest Stable Version](https://poser.pugx.org/allesx/laravel-clickhouse/v/stable)](https://packagist.org/packages/allesx/laravel-clickhouse)
* **Laravel Version**: `5.8.x`
* **PHP Version**: 7.1.3+
* **[Composer](https://getcomposer.org/):** `composer require allesx/laravel-clickhouse`


## Get started
```sh
$ composer require allesx/laravel-clickhouse
```

Then add the code above into your config/app.php file providers section
```php
Allesx\LaravelClickHouse\ClickHouseServiceProvider::class,
```

And add new connection into your config/database.php file. Something like this:
```php
'connections' => [
    'allesx::clickhouse' => [
        'driver' => 'allesx::clickhouse',
        'host' => '',
        'port' => '',
        'database' => '',
        'username' => '',
        'password' => '',
        'options' => [
            'timeout' => 10,
            'protocol' => 'https'
        ]
    ]
]
```

Or like this, if clickhouse runs in cluster
```php
'connections' => [
    'allesx::clickhouse' => [
        'driver' => 'allesx::clickhouse',
        'servers' => [
            [
                'host' => 'ch-00.domain.com',
                'port' => '',
                'database' => '',
                'username' => '',
                'password' => '',
                'options' => [
                    'timeout' => 10,
                    'protocol' => 'https'
                ]
            ],
            [
                'host' => 'ch-01.domain.com',
                'port' => '',
                'database' => '',
                'username' => '',
                'password' => '',
                'options' => [
                    'timeout' => 10,
                    'protocol' => 'https'
                ]
            ]
        ]
    ]
],
```

Then create model
```php
<?php

use Allesx\LaravelClickHouse\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
}
```

And use it
```php
Payment::select(raw('count() AS cnt'), 'payment_system')
    ->whereBetween('payed_at', [
        Carbon\Carbon::parse('2017-01-01'),
        now(),
    ])
    ->groupBy('payment_system')
    ->get();

```

