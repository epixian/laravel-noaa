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

    public function __call($function, $args)
    {
        if (method_exists($this->request, $function)) {
            return $this->request->$function($args);
        }

        throw new BadMethodCallException('Method does not exist.');
    }
}