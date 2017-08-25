ixudra/geo
===============

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ixudra/geo.svg?style=flat-square)](https://packagist.org/packages/ixudra/geo)
[![license](https://img.shields.io/github/license/ixudra/geo.svg)]()
[![StyleCI](https://styleci.io/repos/33857364/shield)](https://styleci.io/repos/33857364)
[![Total Downloads](https://img.shields.io/packagist/dt/ixudra/geo.svg?style=flat-square)](https://packagist.org/packages/ixudra/geo)

Custom PHP geo-location services library for the Laravel 5 framework - developed by [Ixudra](http://ixudra.be).

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

or run in terminal:
`composer require ixudra/geo`



### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'         => array(

        //...
        Ixudra\Geo\GeoServiceProvider::class,

    ),

```

Add the facade to your `config/app.php` file:

```php

    'aliases'           => array(

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

### Lumen 5.* integration

In your `bootstrap/app.php`, make sure you've un-commented the following line (around line 26):

```
$app->withFacades();
```

Then, register your class alias:
```
class_alias('Ixudra\Geo\Facades\Geo', 'Geo');
```

Finally, you have to register your ServiceProvider (around line 70-80):

```
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register('App\Providers\AppServiceProvider');

// Package service providers
$app->register(Ixudra\Geo\GeoServiceProvider::class);
```



## Usage

### Geocoding

Once you've installed the package, you can start using it in your code:

```php

    use Ixudra\Geo\Facades\Geo;

    $response = Geo::geocode('Mersenhovenstraat 5, 3722 Kortessem');

    // Will return the following response:
    //
    // {
    //     "status": "success"
    //     "lat": 50.8565248
    //     "lng": 5.391962
    // }

```

 > In order to use this feature, you will need to enable API access to the Google Maps API via the Google API console

If the GeoCoder instance could not find any results, it wil thrown an `Ixudra\Geo\Exceptions\EmptyResponseException`. If the GeoCoder instance encounters an error of some kind, an `Ixudra\Geo\Exceptions\ErrorResponseException` will be thrown:


### Distance calculation

Once you've installed the package, you can start using it in your code:

```php

    use Ixudra\Geo\Facades\Geo;

    $response = Geo::distance('Mersenhovenstraat 5, 3722 Wintershoven', 'Kempische Steenweg 293, 3500 Hasselt')

    // Will return the following response:
    //
    // {
    //      "status": "success"
    //      "distance": 13556       // in meters
    //      "duration": 1120        // in seconds
    // }

```

 > In order to use this feature, you will need to enable API access to the Google Distance Matrix API via the Google API console
 
 > Note: the distance calculation feature has not yet been implemented for MapQuest. Only the Google API service can be used at this point.

If the GeoCoder instance could not find any results, it wil thrown an `Ixudra\Geo\Exceptions\EmptyResponseException`. 


That's all there is to it! Have fun!




## License

This template is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

Jan Oris (developer)

- Email: jan.oris@ixudra.be
- Telephone: +32 496 94 20 57