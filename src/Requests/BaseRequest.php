<?php

namespace Epixian\LaravelNoaa\Requests;

abstract class BaseRequest
{
    protected $token;
    protected $baseUrl = 'https://ncdc.noaa.gov/cdo-web/api/v2/';
    protected $endpoint;
    protected $params = [];

    public function __construct()
    {
        $this->token = config('noaa.token');
    }

    /**
     * Query the API
     * @param  string $id the ID of the data point for the specified query type
     * @return mixed
     */
    public function get($id = null)
    {
        $client = new \GuzzleHttp\Client();

        $url = $this->baseUrl . $this->endpoint;

        $this->endpoint = null;
        
        if ($id === null) {
            return json_decode($client->get($url, [
                'headers' => ['token' => $this->token],
                'query' => $this->params
            ])->getBody());
        } else {
            return json_decode($client->get($url . $id)->getBody());
        }
    }

    /**
     * Set the startdate parameter
     * @param  string $startDate e.g. '2019-10-01'
     * @return $this
     */
    public function from($startDate)
    {
        $this->params['startdate'] = $startDate;

        return $this;
    }

    /**
     * Set the enddate parameter
     * @param  string $endDate e.g. '2019-10-01'
     * @return $this
     */
    public function to($endDate)
    {
        $this->params['enddate'] = $endDate;

        return $this;
    }

    /**
     * Set the sortfield and sortorder fields
     * @param  string $field the field to sort on
     * @param  string|null $direction the direction to sort e.g. 'asc' (default if not previously set) or 'desc'.
     * @return $this
     * @throws \UnexpectedValueException
     */
    public function orderBy($field, $direction = 'asc')
    {
        if (! in_array($field, ['id', 'name', 'mindate', 'maxdate', 'datacoverage'])) {
            throw new \UnexpectedValueException('No such field \'' . $field . '\'.');
        }

        $this->params['sortfield'] = $field;
        $this->params['sortorder'] = isset($this->params['sortorder']) ? $this->params['sortorder'] : $direction;

        return $this;
    }

    /**
     * Set the limit field
     * @param  int $value
     * @return $this
     */
    public function limit($value)
    {
        $this->params['limit'] = $value;

        return $this;
    }

    /**
     * Set the offset field
     * @param  int $value
     * @return $this
     */
    public function offset($value)
    {
        $this->params['offset'] = $value;

        return $this;
    }

    ///////////////////////////////////////////////////////////////////
    ////////////////////// LARAVEL-ESQUE HELPERS //////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Set a generic parameter
     * @param  string $field
     * @param  string $value
     * @return $this
     */
    public function where($field, $value)
    {
        $this->params[$field] = $value;

        return $this;
    }

    /**
     * Sorts by date descending
     * @return $this
     */
    public function latest()
    {
        $this->params['sortfield'] = 'maxdate';
        $this->params['sortorder'] = 'desc';

        return $this;
    }

    /**
     * Sorts by date ascending
     * @return $this
     */
    public function oldest()
    {
        $this->params['sortfield'] = 'mindate';
        $this->params['sortorder'] = 'asc';

        return $this;
    }

    /**
     * Alias for offset()
     * @param  int $value
     * @return \Epixian\LaravelNoaa\NoaaBaseRequest
     */
    public function skip($value)
    {
        return $this->offset($value);
    }

    /**
     * Alias for limit()
     * @param  int $value
     * @return \Epixian\LaravelNoaa\NoaaBaseRequest
     */
    public function take($value)
    {
        return $this->limit($value);
    }
}