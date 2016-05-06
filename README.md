# Natural cron expression #
A parser that converts natural (English) language to a cron expression.

## Installation##

    composer require bentools/natural-cron-expression

## Usage ##

```php
NaturalCronExpressionParser::fromString('every 5 minutes on Tuesdays'); // */5 * * * 2
NaturalCronExpressionParser::fromString('every day at 5:45pm'); // 45 17 * * *
```

## Tests ##
Check out phpunit tests in /tests

## License ##
MIT