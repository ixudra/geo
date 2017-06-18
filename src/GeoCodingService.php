<?php namespace Ixudra\Geo;


class GeoCodingService {

    public function geocode($query)
    {
        return $this->getService()->geocode( $query );
    }

    public function distance($from, $to)
    {
        return $this->getService()->distance( $from, $to );
    }

    protected function getService()
    {
        $serviceClass = $this->getServiceClass(env('GEO_SERVICE', 'google'));

        if( !class_exists($serviceClass) ) {
            $serviceClass = $this->getServiceClass('google');
        }

        return new $serviceClass();
    }

    protected function getServiceClass($key)
    {
        $key = ucfirst( $key );

        return '\Ixudra\Geo\\'. $key .'\\'. $key .'GeoCoder';
    }

}