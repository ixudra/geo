<?php namespace Ixudra\Geo;


use Config;

class GeoCodingService {

    public function getCoordinates($query)
    {
        $serviceClass = $this->getServiceClass( Config::get('geo.service') );

        if( !class_exists($serviceClass) ) {
            $serviceClass = $this->getServiceClass( 'google' );
        }

        $service = new $serviceClass();

        return $service->getCoordinates( $query );
    }

    protected function getServiceClass($key)
    {
        $key = ucfirst( $key );

        return '\Ixudra\Geo\\'. $key .'\\'. $key .'GeoCoder';
    }

}