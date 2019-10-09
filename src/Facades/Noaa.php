<?php

namespace Epixian\LaravelNoaa\Facades;

use Illuminate\Support\Facades\Facade;

class Noaa extends Facade
{
    /**
     * Get the registered name of the component.
     * 
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'noaa';
    }
}