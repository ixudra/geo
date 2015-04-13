<?php namespace Ixudra\Geo\Facades;


use Illuminate\Support\Facades\Facade;

class Geo extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Geo';
    }

}