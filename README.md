## Symfony CLI example with DDD

### Description
This example follow [DDD](https://en.wikipedia.org/wiki/Domain-driven_design) approach. It is maintainable and we can write our tests easily.

We use Fixer API in this example. [Fixer](http://fixer.io) is a free API for current and historical foreign exchange rates published by [the European Central Bank](https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html).

Rates are updated around 4PM CET every working day.

##### Dependencies
* Symfony Console
* Symfony Dependency Injection
* Guzzle

### Installation
```
cd /path/to/project/folder
composer install
```

### Exchange command
```
php private/cli exchange <date> [<base>] [<symbols>]
```

* **date*** - Historical rates for any day since 1999. (Format: “Y-m-d” or "latest" for today)
* **base** - Rates are quoted against (Default: Euro)
* **symbols** - Specific exchange rates (Example: "USD, GBP, RUB")

### Next steps

* Add validation & filter for input arguments
* Create Rate model (use instead of plain rate array)
* Write unit tests
* Add amount feature for exchange rates