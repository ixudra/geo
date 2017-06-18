<?php namespace Ixudra\Geo;


interface GeoCoderInterface {

    public function geocode($query);

    public function distance($from, $to);

}