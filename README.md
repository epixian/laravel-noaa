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
  * [`dataCategories`](#data-categories)
  * [`dataTypes`](#data-types)
  * `locationCategories`
  * `locations`
  * `stations`
  * `data`

Sets the type of request to be generated.

##### `get()`
Executes the request and returns a JSON-decoded result (typically an array) depending on the API response.  Note: requires a request type method to be previously called and must be the last call when chaining methods.
```php
// fetch all datasets
$response = \Noaa::datasets()->get();
```

Alternatively, you may supply a single `string` argument to `get()` representing an `id` belonging to that request type (valid for all request type methods except `data()`:
```php
// fetch dataset with id of 'GSOM'
$dataset = \Noaa::datasets()->get('GSOM');
```

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
Defaults to 0 if omitted.  Note: the API returns results with indexes starting at 1.  `offset(0)` and `offset(1)` produce equivalent results.

#### Laravel-style helpers

A number of method aliases are provided for convenience:

 * `latest()` - equivalent to `orderBy('maxdate', 'desc')`
 * `oldest()` - equivalent to `orderBy('mindate', 'asc')`
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
$dataset = \Noaa::datasets()->withDataType('ACMH')->get();
// or
$dataset = \Noaa::datasets()->withDataType(['ACMH', 'MLY-TAVG-NORMAL'])->get();
```

##### `withLocation(id)`
`id` is a string containing a single valid location ID, or an array of strings representing multiple location IDs.
```php
$dataset = \Noaa::datasets()->withLocation('FIPS:37')->get();
// or
$dataset = \Noaa::datasets()->withLocation(['FIPS:09', 'FIPS:10'])->get();
```

##### `withStation(id)`
`id` is a string containing a single valid station ID, or an array of strings representing multiple station IDs.
```php
$dataset = \Noaa::datasets()->withStation('COOP:310090')->get();
// or
$dataset = \Noaa::datasets()->withStation(['COOP:310090', 'COOP:310184'])->get();
```

### Data Categories

Returns the available data category(s) applicable to the given constraints (if any).  The following optional constraint methods are available:

##### `withDataset(id)`
`id` is a string containing a single valid dataset ID, or an array of strings representing multiple dataset IDs.
```php
$dataset = \Noaa::dataCategories()->withDataset('ACMH')->get();
// or
$dataset = \Noaa::dataCategories()->withDataset(['ACMH', 'GSOM'])->get();
```

##### `withLocation(id)`
`id` is a string containing a single valid location ID, or an array of strings representing multiple location IDs.
```php
$dataset = \Noaa::dataCategories()->withLocation('FIPS:37')->get();
// or
$dataset = \Noaa::dataCategories()->withLocation(['FIPS:09', 'FIPS:10'])->get();
```

##### `withStation(id)`
`id` is a string containing a single valid station ID, or an array of strings representing multiple station IDs.
```php
$dataset = \Noaa::dataCategories()->withStation('COOP:310090')->get();
// or
$dataset = \Noaa::dataCategories()->withStation(['COOP:310090', 'COOP:310184'])->get();
```

### Data Types

Returns the available data type(s) applicable to the given constraints (if any).  The following optional constraint methods are available:

##### `withDataset(id)`
`id` is a string containing a single valid dataset ID, or an array of strings representing multiple dataset IDs.
```php
$dataset = \Noaa::dataTypes()->withDataset('ACMH')->get();
// or
$dataset = \Noaa::dataTypes()->withDataset(['ACMH', 'GSOM'])->get();
```

##### `withLocation(id)`
`id` is a string containing a single valid location ID, or an array of strings representing multiple location IDs.
```php
$dataset = \Noaa::dataTypes()->withLocation('FIPS:37')->get();
// or
$dataset = \Noaa::dataTypes()->withLocation(['FIPS:09', 'FIPS:10'])->get();
```

##### `withStation(id)`
`id` is a string containing a single valid station ID, or an array of strings representing multiple station IDs.
```php
$dataset = \Noaa::dataTypes()->withStation('COOP:310090')->get();
// or
$dataset = \Noaa::dataTypes()->withStation(['COOP:310090', 'COOP:310184'])->get();
```

##### `withDataCategory(id)`
`id` is a string containing a single valid data category ID, or an array of strings representing multiple data category IDs.
```php
$dataset = \Noaa::dataTypes()->withDataCategory('ANNAGR')->get();
// or
$dataset = \Noaa::dataTypes()->withDataCategory(['ANNAGR', 'ANNTEMP'])->get();
```