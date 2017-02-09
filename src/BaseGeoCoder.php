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

    protected function returnSuccessResponse($lat, $lng)
    {
        $result = new \stdClass();
        $result->status = 'success';
        $result->lat = $lat;
        $result->lng = $lng;

        return $result;
    }

    protected function returnErrorResponse($message)
    {
        throw new ErrorResponseException($message);
    }

} 