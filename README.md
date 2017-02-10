ixudra/geo
===============

Custom PHP geocoding library for the Laravel 5 framework - developed by [Ixudra](http://ixudra.be).

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "ixudra/geo": "6.*"
        }
    }

```

Add the service provider to your `config/app.php` file:

```php

    'providers'         => array(

        //...
        Ixudra\Geo\GeoServiceProvider::class,

    ),

```

Add the facade to your `config/app.php` file:

```php

    'facades'           => array(

        //...
        'Geo'               => Ixudra\Geo\Facades\Geo::class,

    ),

```

Add the following environment values to your `.env` file:

```

GEO_SERVICE=google                      # Valid options are: google, mapquest 
GEO_GOOGLE_API_KEY=your_api_key         # Only required when using Google for geo coding
GEO_MAPQUEST_API_KEY=your_api_key       # Only required when using MapQuest for geo coding

```

By default, the package will use the Google API.



## Usage

Once you've installed the package, you can start using it in your code:

```php

    $response = Geo::geocode('Mersenhovenstraat 5, 3722 Kortessem');

    // Will return the following response:
    //
    // {
    //     "status": "success"
    //     "lat": 50.8565248
    //     "lng": 5.391962
    // }

```

If the GeoCoder instance could not find any results, it wil thrown an `Ixudra\Geo\Exceptions\EmptyResponseException`. If the GeoCoder instance encounters an error of some kind, an `Ixudra\Geo\Exceptions\ErrorResponseException` will be thrown:


That's all there is to it! Have fun!




## License

This template is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

Jan Oris (developer)

- Email: jan.oris@ixudra.be
- Telephone: +32 496 94 20 57