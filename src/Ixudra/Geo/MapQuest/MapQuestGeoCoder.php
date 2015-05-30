<?php namespace Ixudra\Geo\MapQuest;


use Ixudra\Geo\BaseGeoCoder;
use Ixudra\Geo\GeoCoderInterface;
use Ixudra\Geo\Exceptions\InvalidArgumentException;

use Config;

class MapQuestGeoCoder extends BaseGeoCoder implements GeoCoderInterface {

    public function geocode($query)
    {
        if( $query == '' ) {
            throw new InvalidArgumentException();
        }

        $getParameters = array(
            'q'                 => $query,
            'api_key'           => Config::get('geo.mapQuest.api_key')
        );

        $lat = '';
        $lng = '';

        try {
            $response = $this->getCurlService()->get('https://api.geocod.io/v1/geocode', $getParameters, true);

            $lat = $response->results[ 0 ]->location->lat;
            $lng = $response->results[ 0 ]->location->lng;
        } catch(\Exception $e) {
            $this->returnErrorResponse( 'An error has occurred while connecting to the MapQuest API: '. $e->getMessage() );
        }

        return $this->returnSuccessResponse( $lat, $lng );
    }

} 