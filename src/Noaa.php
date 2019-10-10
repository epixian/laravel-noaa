<?php

namespace Epixian\LaravelNoaa;

use Epixian\LaravelNoaa\Requests\Dataset;
use Epixian\LaravelNoaa\Requests\DataCategory;

class Noaa
{
    protected $request;

    /**
     * Sets the dataset parameter for the query
     * @param string|array $dataset
     * @return $this
     */
    public function datasets($dataset = null)
    {
        $this->request = $dataset ? new Dataset($dataset) : new Dataset();

        return $this;
    }

    /**
     * Sets the datacategory parameter for the query
     * @param string|array $dataCategory
     * @return $this
     */
    public function dataCategories($dataCategory = null)
    {
        $this->request = $dataCategory ? new DataCategory($dataCategory) : new DataCategory();

        return $this;
    }

    /**
     * Pass through non-explicitly defined method calls to the internal request class
     * @param  string $function
     * @param  array $args
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($function, $args)
    {
        if ($this->request === null) {
            throw new \BadMethodCallException('Must specify request type before chaining constraints.');
        }

        if (method_exists($this->request, $function)) {
            return $this->request->$function(sizeof($args) ? $args[0] : null);
        }

        throw new \BadMethodCallException('Method \'' . $function . '()\' does not exist.');
    }
}