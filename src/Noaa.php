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
    public function datasets($dataset)
    {
        $this->request = $dataset ? new Dataset($dataset) : new Dataset();
    }

    public function get($id = null)
    {
        if ($this->request === null) {
            throw new Exception('Endpoint not specified.');
        }

        return $this->request->get($id);
    }

}