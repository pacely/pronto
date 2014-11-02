# Simple time converter
[![Build Status](https://travis-ci.org/pacely/Pronto.svg?branch=master)](https://travis-ci.org/pacely/Pronto)
[![Latest Stable Version](https://poser.pugx.org/leaphly/cart-bundle/version.svg)](https://packagist.org/packages/pacely/pronto)
[![Latest Unstable Version](https://poser.pugx.org/leaphly/cart-bundle/v/unstable.svg)](//packagist.org/packages/pacely/pronto)
[![License](https://poser.pugx.org/leaphly/cart-bundle/license.svg)](https://packagist.org/packages/pacely/pronto)

---

- [Installation](#installation)
- [Registering the Package](#registering-the-package)
- [Formatters](#formatters)
- [Helper methods](#helper-methods)

## Installation

Add pronto to your composer.json file:

```
"require": {
  "pacely/pronto": "dev-master"
}
```

Use composer to install this package.

```
$ composer update
```

### Registering the Package
Register the service provider within the `providers` array found in `app/config/app.php`:

```php
'providers' => array(
	// ...
	
	'Pacely\Pronto\ProntoServiceProvider'
)
```

Add an alias within the `aliases` array found in `app/config/app.php`:


```php
'aliases' => array(
	// ...
	
	'Pronto' => 'Pacely\Pronto\Facades\Pronto',
)
```

## Formatters

#### Integer
Matches integers only. `<=9` converts to hours, `>9` converts to minutes.

Input 		| Value (toTime)
----------- | ---
9 			| 09:00
10 			| 00:10

~~~
echo Pronto::parse(10)->toTime(); // 09:00
echo Pronto::parse(9)->toTime(); // 00:10
~~~

#### Decimal
Matches decimal values (float, double). Comma and period characters allowed.

Input     	| Value (toTime)
----------- | ---
0,5 		| 00:30
1,    		| 01:00
1.5    		| 01:30
,5    		| 00:30
1.    		| 01:00

~~~
echo Pronto::parse('0,5')->toTime(); // 00:30
echo Pronto::parse(1.5)->toTime(); // 01:30
~~~

#### Range
Matches time range.

Input     		| Value (toTime)
--------------- | ---
09-10 			| 01:00
09:00 - 10:00 	| 01:00
09 to 10 		| 01:00
09-   			| Time between 09:00 and NOW()

~~~
echo Pronto::parse('09-10')->toTime(); // 01:00
echo Pronto::parse('09:00 - 10:00')->toTime(); // 01:00
echo Pronto::parse('09:00-')->toTime(); // Time between 09:00 and NOW
~~~

#### Short
Matches short-time from *m(minutes)* to *w(week)*. 1 day equals 7.5 hours. 1 week equals 5 days.

Input     		| Value (toTime)
----------- 	| ---
1d 2h 30m 		| 10:00 (1d = 7.5 hours)
2 h 2 m 		| 02:02
1w 2d 20m		| 52:50 (1w = 7.5*5)

~~~
echo Pronto::parse('1d 2h 30m')->toTime(); // 10:00
echo Pronto::parse('2 h 2 m')->toTime(); // 02:02
echo Pronto::parse('1w 2d 20m')->toTime(); // 52:50
~~~

## Helper methods

##### `(int) parse(string)`
Returns converted time in seconds

~~~
$pronto = new Pronto;

echo $pronto->parse('0.5'); // 1800
~~~

##### `(int) toMinutes()`
Converts seconds to minutes

~~~
echo $pronto->parse('0.5')->toMinutes(); // 30
~~~

##### `(double) toDecimal()`
Converts seconds to decimal hours

~~~
echo $pronto->parse('2h 30m')->toDecimal(); // 2.5
~~~

##### `(string) toTime()`
Returns converted time the format `HH:mm`

~~~
echo $pronto->parse('0.5')->toTime(); // 00:30
~~~