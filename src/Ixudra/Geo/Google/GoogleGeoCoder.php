<?php namespace Ixudra\Geo\Google;


use Ixudra\Geo\BaseGeoCoder;
use Ixudra\Geo\GeoCoderInterface;
use Config;

class GoogleGeoCoder extends BaseGeoCoder implements GeoCoderInterface {

    public function geocode($query)
    {
        if( $query == '' ) {
            return false;
        }

        $getParameters = array(
            'address'       => $query,
            'sensor'        => false,
            'key'           => Config::get('geo.google.api_key')
        );

        $response = $this->getCurlService()->get('https://maps.googleapis.com/maps/api/geocode/json', $getParameters, true);
        if( $response == null || $response->status != 'OK' ) {
            $this->returnErrorResponse( 'An error has occurred while connecting to the Google Maps API' );
        }

        if( count($response->results) == 0 ) {
            return $this->returnEmptyResponse();
        }

        $lat = $response->results[ 0 ]->geometry->location->lat;
        $lng = $response->results[ 0 ]->geometry->location->lng;

        return $this->returnSuccessResponse( $lat, $lng );
    }

} 
