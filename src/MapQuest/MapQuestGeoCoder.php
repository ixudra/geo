<?php namespace Ixudra\Geo\MapQuest;


use Ixudra\Geo\BaseGeoCoder;
use Ixudra\Geo\GeoCoderInterface;
use Ixudra\Geo\Exceptions\InvalidArgumentException;

use Exception;

class MapQuestGeoCoder extends BaseGeoCoder implements GeoCoderInterface {

    public function geocode($query)
    {
        if( empty($query) ) {
            throw new InvalidArgumentException();
        }

        $data = array(
            'q'                 => $query,
            'api_key'           => env('GEO_MAPQUEST_API_KEY')
        );

        $lat = '';
        $lng = '';

        try {
            $response = $this->getCurlService()
                ->to('https://api.geocod.io/v1/geocode')
                ->withData( $data )
                ->asJson()
                ->get();

            $lat = $response->results[ 0 ]->location->lat;
            $lng = $response->results[ 0 ]->location->lng;
        } catch(Exception $e) {
            $response = new \stdClass();
            $response->status = 'ERROR';
            $response->error_message = $e->getMessage();

            $this->returnErrorResponse( 'Mapquest', $response  );
        }

        return $this->returnSuccessGeocodingResponse( $lat, $lng );
    }

    public function distance($from, $to)
    {
        throw new Exception( 'Not yet implemented' );
    }

} 