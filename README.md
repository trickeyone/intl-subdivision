IntlSubdivision Component
=============

[![PHPUnit](https://github.com/trickeyone/intl-subdivision/actions/workflows/unit-tests.yml/badge.svg)](https://github.com/trickeyone/intl-subdivision/actions/workflows/unit-tests.yml)
[![Build Status](https://app.travis-ci.com/trickeyone/intl-subdivision.svg?branch=master)](https://app.travis-ci.com/trickeyone/intl-subdivision)
[![Test Coverage](https://codeclimate.com/github/trickeyone/intl-subdivision/badges/coverage.svg)](https://codeclimate.com/github/trickeyone/intl-subdivision/coverage)
[![Code Climate](https://codeclimate.com/github/trickeyone/intl-subdivision/badges/gpa.svg)](https://codeclimate.com/github/trickeyone/intl-subdivision)


A companion component to Symfony's Intl Component. This component allows for easy retrieval of a country's states/provinces
using the country's [ISO 3166-1 alpha-2][0] code.

The Symfony Intl component is a replacement for the C intl extension. It is limited to only the "en" locale. If you want
to have access to more locales you should [install the intl PECL extension][1].

### Usage:

```php
// States/Provinces for the United States of America
$subdivisionsForUS = \Symfony\Component\IntlSubdivision\IntlSubdivision::getStatesAndProvincesForCountry('US');
  
// States/Provinces for Canada
$subdivisionsForCA = \Symfony\Component\IntlSubdivision\IntlSubdivision::getStatesAndProvincesForCountry('CA');
  
// States/Provinces for the United Arab Emirates
$subdivisionsForAE = \Symfony\Component\IntlSubdivision\IntlSubdivision::getStatesAndProvincesForCountry('AE');
```

Requirements
-----------
* PHP 7+ or 8+
* Symfony Intl package 5.0+
  * older versions can still support 4.0+ but are not actively supported

Resources
---------

  * [Symfony Intl Documentation](https://symfony.com/doc/current/components/intl.html)
  * [Report issues](https://github.com/trickeyone/intl-subdivision/issues) and
    [send Pull Requests](https://github.com/trickeyone/intl-subdivision/pulls)

[0]: http://www.iso.org/iso/home/standards/country_codes.htm
[1]: http://www.php.net/manual/en/intl.setup.php
