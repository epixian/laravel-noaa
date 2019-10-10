# Changelog

## [0.2.3] - 2019-10-10
  - Fixed bug where request type would not unset after `get()`

## [0.2.2] - 2019-10-10
  - Updated README with correct method names (changed during pre-0.1 development)

## [0.2.1] - 2019-10-10
  - Just kidding, this version actually adds support for 0.2 features listed below
  - Actually merged the dev branch into master before tagging

## [0.2] - 2019-10-10
  - Added support for data categories, with the following constraint methods:
    - `withDataset()` - constrain by datasetid
    - `withLocation()` - constrain by locationid
    - `withStation()` - constrain by stationid

## [0.1] - 2019-10-09
Initial release
  - Added support for datasets, with the following constraint methods:
    - `withDataType()` - constrain by datatypeid
    - `withLocation()` - constrain by locationid
    - `withStation()` - constrain by stationid
  - Added general constraint methods:
    - `from()` - only results with data on or after startdate
    - `to()` - only results with data on or before enddate
    - `orderBy()` - order results by sortfield in sortorder
    - `limit()` - limit results
    - `offset()` - offset result list
  - Added Laravel-style helper methods:
    - `take()` - alias for `limit`
    - `skip()` - alias for `offset`
    - `latest()` - sort by maxdate desc
    - `oldest()` - sort by mindate asc
    - `where()` - set generic constraints