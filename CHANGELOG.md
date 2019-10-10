# Changelog

## [0.2] - 2019-10-10
### Added
  - Support for data categories, with the following constraint methods:
    - `withDataset()` - constrain by datasetid
    - `withLocation()` - constrain by locationid
    - `withStation()` - constrain by stationid

## [0.1] - 2019-10-09
Initial release
### Added
  - Support for datasets, with the following constraint methods:
    - `withDataType()` - constrain by datatypeid
    - `withLocation()` - constrain by locationid
    - `withStation()` - constrain by stationid
  - General constraint methods:
    - `from()` - only results with data on or after startdate
    - `to()` - only results with data on or before enddate
    - `orderBy()` - order results by sortfield in sortorder
    - `limit()` - limit results
    - `offset()` - offset result list
  - Laravel-style helper methods:
    - `take()` - alias for `limit`
    - `skip()` - alias for `offset`
    - `latest()` - sort by maxdate desc
    - `oldest()` - sort by mindate asc
    - `where()` - set generic constraints