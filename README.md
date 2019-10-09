# Laravel NOAA

Laravel NOAA is a wrapper for the NOAA's climate data API at https://ncdc.noaa.giv/cdo-web/api/v2.
 
## Installation

From your source directory, use the following command:
```bash
$ composer require epixian/laravel-noaa
```

Publish assets:
```bash
$ php artisan vendor:publish --tag=epixian-laravel-noaa
```

## Configuration

Add the following to your `.env` file:
```sh
NOAA_TOKEN=YOUR_NOAA_TOKEN_HERE
```
Register for a token at https://www.ncdc.noaa.gov/cdo-web/token.

## Usage

For a full listing of API request parameters, visit: https://www.ncdc.noaa.gov/cdo-web/webservices/v2.

#### Required
##### `{requestType}()` 
where `{requestType}` is one of:
  * [`datasets`](#datasets)
  * `dataCategories`
  * `dataTypes`
  * `locationCategories`
  * `locations`
  * `stations`
  * `data`

Sets the type of request to be generated.

```php
// fetch all datasets
$response = \Noaa::datasets()->get();
```

Alternatively, every request type method except `data()` also accepts a single `string` argument representing an `id` belonging to that request type:
```php
// fetch dataset with id of 'GSOM'
$dataset = \Noaa::datasets('GSOM')->get();
```

##### `get()`
Executes the request and returns a JSON-decoded result (typically an array) depending on the API response.  Note: requires the request type to be set and must be the last call when chaining methods.

#### Optional

##### `from(startDate)`
`startDate` is a string containing a valid ISO formatted date (e.g. `'2010-10-02'`).  Note: this field is **required** for the `data()` request type.

##### `to(endDate)`
`endDate` is a string containing a valid ISO formatted date (e.g. `'2010-10-07'`).  Note: this field is **required** for the `data()` request type.

##### `orderBy(field, direction)`
`field` is a string containing one of: `id`, `name`, `mindate`, `maxdate`, or `datacoverage`.

`direction` is an optional string containing either `asc` (default if omitted) or `desc`.

##### `limit(number)`
Defaults to 25 if omitted.

##### `offset(number)`
Defaults to 0 if omitted.

#### Laravel-style helpers

A number of method aliases are provided for convenience:

 * `latest()` - equivalent to `orderBy('date', 'desc')`
 * `oldest()` - equivalent to `orderBy('date', 'asc')`
 * `skip(number)` - alias of `offset()`
 * `take(number)` - alias of `limit()`
 * `where(field, value)` - sets a generic parameter (see https://www.ncdc.noaa.gov/cdo-web/webservices/v2)

Request constraints may be chained together to refine or limit the data returned:
```php
$dataset = \Noaa::datasets()->from('1970-10-03')->to('2012-09-10')->take(50)->get();
```

Additional constraint methods specific to the request type are detailed below.

### Datasets

Returns the available dataset(s) applicable to the given constraints (if any).  The following optional constraint methods are available:

##### `withDataType(id)`
`id` is a string containing a single valid data type ID, or an array of strings representing multiple data type IDs.
```php
$dataset = \Noaa::datasets()->dataType('ACMH')->get();
// or
$dataset = \Noaa::datasets()->dataType(['ACMH', 'GSOM'])->get();
```

##### `withLocation(id)`
`id` is a string containing a single valid location ID, or an array of strings representing multiple location IDs.
```php
$dataset = \Noaa::datasets()->location('FIPS:37')->get();
// or
$dataset = \Noaa::datasets()->location(['FIPS:09', 'FIPS:10'])->get();
```

##### `withStation(id)`
`id` is a string containing a single valid station ID, or an array of strings representing multiple station IDs.
```php
$dataset = \Noaa::datasets()->station('COOP:310090')->get();
// or
$dataset = \Noaa::datasets()->station(['COOP:310090', 'COOP:310184'])->get();
```
