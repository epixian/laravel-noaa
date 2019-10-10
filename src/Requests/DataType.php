<?php

namespace Epixian\LaravelNoaa\Requests;

class DataType extends BaseRequest
{
    public function __construct()
    {
        parent::__construct();
        
        $this->endpoint = 'datatypes/';
    }

    /**
     * Set the datasetid parameter
     * @param  string|array $datasetId 
     * @return $this
     */
    public function withDataset($datasetId)
    {
        $this->params['datasetid'] = is_array($datasetId) ? implode('&', $datasetId) : $datasetId;

        return $this;
    }

    /**
     * Set the locationid parameter
     * @param  string|array $locationId
     * @return $this
     */
    public function withLocation($locationId)
    {
        $this->params['locationid'] = is_array($locationId) ? implode('&', $locationId) : $locationId;

        return $this;
    }

    /**
     * Set the stationid parameter
     * @param  string|array $stationId
     * @return $this
     */
    public function withStation($stationId)
    {
        $this->params['stationid'] = is_array($stationId) ? implode('&', $stationId) : $stationId;

        return $this;
    }

    /**
     * Set the datacategoryid parameter
     * @param  string|array $dataCategoryId
     * @return $this
     */
    public function withStation($dataCategoryId)
    {
        $this->params['datacategoryid'] = is_array($dataCategoryId) ? implode('&', $dataCategoryId) : $dataCategoryId;

        return $this;
    }
}