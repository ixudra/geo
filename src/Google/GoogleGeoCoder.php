<?php namespace Ixudra\Geo\Google;


use Ixudra\Geo\BaseGeoCoder;
use Ixudra\Geo\GeoCoderInterface;
use Ixudra\Geo\Exceptions\InvalidArgumentException;

class GoogleGeoCoder extends BaseGeoCoder implements GeoCoderInterface {

    public function geocode($query)
    {
        if( $query == '' ) {
            throw new InvalidArgumentException();
        }

        $data = array(
            'address'       => $query,
            'sensor'        => false,
            'key'           => env('GEO_GOOGLE_API_KEY')
        );

        $response = $this->getCurlService()
            ->to('https://maps.googleapis.com/maps/api/geocode/json')
            ->withData( $data )
            ->asJson()
            ->get();

        if(  is_null($response) || $response->status != 'OK' ) {
            $this->returnErrorResponse( 'An error has occurred while connecting to the Google Maps API' );
        }

        if( count($response->results) == 0 ) {
            $this->returnEmptyResponse();
        }

        $lat = $response->results[ 0 ]->geometry->location->lat;
        $lng = $response->results[ 0 ]->geometry->location->lng;

        return $this->returnSuccessResponse( $lat, $lng );
    }

} 
