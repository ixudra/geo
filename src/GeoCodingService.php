<?php namespace Ixudra\Geo;


class GeoCodingService {

    public function geocode($query)
    {
        $serviceClass = $this->getServiceClass( env('GEO_SERVICE', 'google') );

        if( !class_exists($serviceClass) ) {
            $serviceClass = $this->getServiceClass( 'google' );
        }

        $service = new $serviceClass();

        return $service->geocode( $query );
    }

    protected function getServiceClass($key)
    {
        $key = ucfirst( $key );

        return '\Ixudra\Geo\\'. $key .'\\'. $key .'GeoCoder';
    }

}