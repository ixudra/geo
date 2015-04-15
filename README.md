Ixudra/Geo
=============

Custom PHP geocoding library for the Laravel 5 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "ixudra/geo": "5.*"
        }
    }

```

Add the service provider to your `config/app.php` file:

```php

    providers       => array(

        //...
        'Ixudra\Geo\GeoServiceProvider',

    )

```

Add the facade to your `config/app.php` file:

```php

    facades         => array(

        //...
        'Geo'          => 'Ixudra\Geo\Facades\Geo',

    )

```



## Usage

Once you've installed the package, you can start using it in your code:

```php

    $response = Geo::getCoordinates('Mersenhovenstraat 5, 3722 Kortessem');
    
    // Will return the following response:
    //
    // {
    //     "status": "success"
    //     "lat": 50.8565248
    //     "lng": 5.391962
    // }

```

If the GeoCoder instance could not find any results, it will tell you by returning an empty result:

```php

    $response = Geo::getCoordinates('#####');
    
    // Will return the following response:
    //
    // {
    //     "status": "empty"
    // }

```

If the GeoCoder instance encounters an error of some kind, it will return the error message:

```php

    $response = Geo::getCoordinates('Mersenhovenstraat 5, 3722 Kortessem');
    
    // Will return the following response:
    //
    // {
    //     "status": "error",
    //     "message": "Error message goes here"
    // }

```




## Configuration options

### Publishing the config file

The package has several configuration options. In order to modify these, you will have to publish the config file using artisan:

```php

    // Publish all resources from all packages
    php artisan vendor:publish
    
    // Publish only the resources of the pckage
    php artisan vendor:publish --provider="Ixudra\\Geo\\GeoServiceProvider"

```

This will create a configuration file and publish it as `config/geo.php`. By default, the config file will look like this:

```php

    return array(
    
        'service'                   => 'google',
    
    
        // Google specific configuration
        'google'                    => array(
    
            'api_key'                   => '' // Not supported yet
    
        ),
    
    
        'mapQuest'                  => array(
    
            'api_key'                   => ''
    
        ),
    
    );

```

The `service` key can be used to select the specific geocoder that you would like to use. The default is set to `google`. At this point, only `google` and `mapQuest` are supported. Once you have selected a geocoder, you can add API configuration to its specific configuration array.

Please note that at this point only the MapQuest API is supported. Google Maps API (and others) will follow in the future.


That's all there is to it! Have fun!