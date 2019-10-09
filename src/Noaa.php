<?php

namespace Epixian\LaravelNoaa;

use Epixian\LaravelNoaa\Requests\Dataset;

class Noaa
{
    protected $request;

    /**
     * Sets the dataset parameter for the query
     * @param  array $datasets
     * @return $this
     */
    public function datasets($dataset = null)
    {
        $this->request = $dataset ? new Dataset($dataset) : new Dataset();

        return $this;
    }

    public function get($id = null)
    {
        if ($this->request === null) {
            throw new Exception('Endpoint not specified.');
        }

        return $this->request->get($id);
    }



    public function withDataType($dataTypeId)
    {
        return $this->request->withDataType($dataTypeId);
    }

    public function withLocation($locationId)
    {
        return $this->request->withLocation($locationId);
    }

    public function withStation($stationId)
    {
        return $this->request->withStation($stationId);
    }
}