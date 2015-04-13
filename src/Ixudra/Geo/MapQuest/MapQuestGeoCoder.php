<?php namespace Ixudra\Geo\MapQuest;


use Ixudra\Geo\BaseGeoCoder;
use Ixudra\Geo\GeoCoderInterface;

use Config;

class MapQuestGeoCoder extends BaseGeoCoder implements GeoCoderInterface {

    public function getCoordinates($query)
    {
        if( $query == '' ) {
            return false;
        }

        $getParameters = array(
            'q'                 => $query,
            'api_key'           => Config::get('geo.mapQuest.api_key')
        );

        try {
            $response = $this->getCurlService()->get('https://api.geocod.io/v1/geocode', $getParameters, true);
        } catch(\Exception $e) {
            return $this->returnErrorResponse( 'An error has occurred while connecting to the Google Maps API: '. $e->getMessage() );
        }

        $lat = $response->results[ 0 ]->location->lat;
        $lng = $response->results[ 0 ]->location->lng;

        return $this->returnSuccessResponse( $lat, $lng );
    }

} 