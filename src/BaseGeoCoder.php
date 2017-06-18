<?php namespace Ixudra\Geo;


use Ixudra\Curl\CurlService;
use Ixudra\Geo\Exceptions\EmptyResponseException;
use Ixudra\Geo\Exceptions\ErrorResponseException;

abstract class BaseGeoCoder {

    protected $curlService;


    protected function getCurlService()
    {
        if( is_null($this->curlService) ) {
            $this->curlService = new CurlService();
        }

        return $this->curlService;
    }

    protected function returnEmptyResponse()
    {
        throw new EmptyResponseException();
    }

    protected function returnSuccessGeocodingResponse($lat, $lng)
    {
        $result = new \stdClass();
        $result->status = 'success';
        $result->lat = $lat;
        $result->lng = $lng;

        return $result;
    }

    protected function returnSuccessDistanceResponse($distance, $duration)
    {
        $result = new \stdClass();
        $result->status = 'success';
        $result->distance = $distance;
        $result->duration = $duration;

        return $result;
    }

    protected function returnErrorResponse($api, $response)
    {
        $status = 'UNKNOWN';
        $message = 'An unknown error has occurred';

        if(  !is_null($response) ) {
            $status = $response->status;
            $message = $response->error_message;
        }

        throw new ErrorResponseException( 'An error has occurred while connecting to the '. $api .' API: '. $status .' - '. $message );
    }

} 