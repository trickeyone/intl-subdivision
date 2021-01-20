IntlSubdivision Component
=============

[![Build Status](https://travis-ci.org/trickeyone/intl-subdivision.png?branch=master)](https://travis-ci.org/trickeyone/intl-subdivision)
[![Test Coverage](https://codeclimate.com/github/trickeyone/intl-subdivision/badges/coverage.svg)](https://codeclimate.com/github/trickeyone/intl-subdivision/coverage)
[![Code Climate](https://codeclimate.com/github/trickeyone/intl-subdivision/badges/gpa.svg)](https://codeclimate.com/github/trickeyone/intl-subdivision)
[![HitCount](https://hitt.herokuapp.com/trickeyone/intl-subdivision.svg)](https://github.com/trickeyone/intl-subdivision)


A companion component to Symfony's Intl Component. This component allows for easy retrieval of a country's states/provinces
using the country's [ISO 3166-1 alpha-2][0] code.

The Symfony Intl component is a replacement for the C intl extension. It is limited to only the "en" locale. If you want
to have access to more locales you should [install the intl PECL extension][1].

### Usage:

```php
// States/Provinces for the United States of America
$subdivisionsForUS = \Symfony\Component\IntlSubdivision::getStatesAndProvincesForCountry('US');
  
// States/Provinces for Canada
$subdivisionsForCA = \Symfony\Component\IntlSubdivision::getStatesAndProvincesForCountry('CA');
  
// States/Provinces for the United Arab Emirates
$subdivisionsForAE = \Symfony\Component\IntlSubdivision::getStatesAndProvincesForCountry('AE');
```

Requirements
-----------
* PHP PHP 7+
* Symfony Intl package 4.1+ or 5.0+

Resources
---------

  * [Symfony Intl Documentation](https://symfony.com/doc/current/components/intl.html)
  * [Report issues](https://github.com/trickeyone/intl-subdivision/issues) and
    [send Pull Requests](https://github.com/trickeyone/intl-subdivision/pulls)

[0]: http://www.iso.org/iso/home/standards/country_codes.htm
[1]: http://www.php.net/manual/en/intl.setup.php
