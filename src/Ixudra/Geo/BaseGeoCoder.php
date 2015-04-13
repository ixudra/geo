<?php namespace Ixudra\Geo;


use Ixudra\Curl\CurlService;

abstract class BaseGeoCoder {

    CONST RESPONSE_EMPTY = 'not_found';

    const RESPONSE_SUCCESSFUL = 'success';

    const RESPONSE_UNSUCCESSFUL = 'error';


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
        $result = new \stdClass();
        $result->status = self::RESPONSE_EMPTY;

        return $result;
    }

    protected function returnSuccessResponse($lat, $lng)
    {
        $result = new \stdClass();
        $result->status = self::RESPONSE_SUCCESSFUL;
        $result->lat = $lat;
        $result->lng = $lng;

        return $result;
    }

    protected function returnErrorResponse($message)
    {
        $result = new \stdClass();
        $result->status = self::RESPONSE_UNSUCCESSFUL;
        $result->message = $message;

        return $result;
    }

} 