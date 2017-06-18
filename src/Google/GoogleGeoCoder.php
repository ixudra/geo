<?php namespace Ixudra\Geo\Google;


use Ixudra\Geo\BaseGeoCoder;
use Ixudra\Geo\GeoCoderInterface;
use Ixudra\Geo\Exceptions\InvalidArgumentException;

class GoogleGeoCoder extends BaseGeoCoder implements GeoCoderInterface {

    public function geocode($query)
    {
        if( empty($query) ) {
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

        if(  is_null($response) || $response->status !== 'OK' ) {
            $this->returnErrorResponse( 'Google Maps', $response );
        }

        if( count($response->results) == 0 ) {
            $this->returnEmptyResponse();
        }

        $lat = $response->results[ 0 ]->geometry->location->lat;
        $lng = $response->results[ 0 ]->geometry->location->lng;

        return $this->returnSuccessGeocodingResponse( $lat, $lng );
    }

    public function distance($from, $to)
    {
        if( empty($from) ) {
            throw new InvalidArgumentException();
        }

        if( empty($to) ) {
            throw new InvalidArgumentException();
        }

        $data = array(
            'origins'           => urlencode($from),
            'destinations'      => urlencode($to),
            'key'               => env('GEO_GOOGLE_API_KEY')
        );

        $response = $this->getCurlService()
            ->to('https://maps.googleapis.com/maps/api/distancematrix/json')
            ->withData( $data )
            ->asJson()
            ->get();

        if(  is_null($response) || $response->status !== 'OK' ) {
            $this->returnErrorResponse( 'Google Distance Matrix', $response );
        }

        if( count($response->rows) == 0 ) {
            $this->returnEmptyResponse();
        }

        $distance = $response->rows[ 0 ]->elements[ 0 ]->distance->value;
        $duration = $response->rows[ 0 ]->elements[ 0 ]->duration->value;

        return $this->returnSuccessDistanceResponse( $distance, $duration );
    }

} 
