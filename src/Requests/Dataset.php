<?php

namespace Epixian\LaravelNoaa\Requests;

class Dataset extends BaseRequest
{
    public function __construct()
    {
        parent::__construct();
        
        $this->endpoint = 'datasets/';
    }

    /**
     * Set the datatypeid parameter
     * @param  string|array $dataTypeId 
     * @return $this
     */
    public function dataType($dataTypeId)
    {
        $this->params['datatypeid'] = is_array($dataTypeId) ? implode('&', $dataTypeId) : $dataTypeId;

        return $this;
    }

    /**
     * Set the locationid parameter
     * @param  string|array $locationId
     * @return $this
     */
    public function location($locationId)
    {
        $this->params['locationid'] = is_array($locationId) ? implode('&', $locationId) : $locationId;

        return $this;
    }

    /**
     * Set the stationid parameter
     * @param  string|array $stationId
     * @return $this
     */
    public function station($stationId)
    {
        $this->params['stationid'] = is_array($stationId) ? implode('&', $stationId) : $stationId;

        return $this;
    }
}