# Natural cron expression #
A parser that converts natural (English) language to a cron expression.

## Installation##

    composer require bentools/natural-cron-expression

## Usage ##

```php
use BenTools\NaturalCronExpression\NaturalCronExpressionParser;

NaturalCronExpressionParser::fromString('each day'); // 0 0 * * *
NaturalCronExpressionParser::fromString('every day'); // 0 0 * * *
NaturalCronExpressionParser::fromString('daily'); // 0 0 * * *
NaturalCronExpressionParser::fromString('every day at 3 AM'); // 0 3 * * *
NaturalCronExpressionParser::fromString('5am'); // 0 5 * * *
NaturalCronExpressionParser::fromString('daily at 5am'); // 0 5 * * *
NaturalCronExpressionParser::fromString('every friday at 5am'); // 0 5 * * 5
NaturalCronExpressionParser::fromString('daily at 17:30'); // 30 17 * * *
NaturalCronExpressionParser::fromString('every week'); // 0 0 * * 0
NaturalCronExpressionParser::fromString('weekly'); // 0 0 * * 0
NaturalCronExpressionParser::fromString('every minute'); // * * * * *
NaturalCronExpressionParser::fromString('every 5 minutes'); // */5 * * * *
NaturalCronExpressionParser::fromString('every 30 minutes'); // */30 * * * *
NaturalCronExpressionParser::fromString('every month'); // 0 0 1 * *
NaturalCronExpressionParser::fromString('monthly'); // 0 0 1 * *
NaturalCronExpressionParser::fromString('every Monday'); // 0 0 * * 1
NaturalCronExpressionParser::fromString('every Wednesday'); // 0 0 * * 3
NaturalCronExpressionParser::fromString('every Friday'); // 0 0 * * 5
NaturalCronExpressionParser::fromString('every hour'); // 0 * * * *
NaturalCronExpressionParser::fromString('every 6 hours'); // 0 */6 * * *
NaturalCronExpressionParser::fromString('hourly'); // 0 * * * *
NaturalCronExpressionParser::fromString('every year'); // 0 0 1 1 *
NaturalCronExpressionParser::fromString('yearly'); // 0 0 1 1 *
NaturalCronExpressionParser::fromString('annually'); // 0 0 1 1 *
NaturalCronExpressionParser::fromString('every day at 9am'); // 0 9 * * *
NaturalCronExpressionParser::fromString('every day at 5pm'); // 0 17 * * *
NaturalCronExpressionParser::fromString('every day at 5:45pm'); // 45 17 * * *
NaturalCronExpressionParser::fromString('every day at 17:00'); // 0 17 * * *
NaturalCronExpressionParser::fromString('every day at 17:25'); // 25 17 * * *
NaturalCronExpressionParser::fromString('5:15am every Tuesday'); // 15 5 * * 2
NaturalCronExpressionParser::fromString('7pm every Thursday'); // 0 19 * * 4
NaturalCronExpressionParser::fromString('every May'); // 0 0 1 5 *
NaturalCronExpressionParser::fromString('every December'); // 0 0 1 12 *
NaturalCronExpressionParser::fromString('midnight'); // 0 0 * * *
NaturalCronExpressionParser::fromString('midnight on tuesdays'); // 0 0 * * 2
NaturalCronExpressionParser::fromString('every 5 minutes on Tuesdays'); // */5 * * * 2
NaturalCronExpressionParser::fromString('noon'); // 0 12 * * *
NaturalCronExpressionParser::fromString('every 25th'); // 0 0 25 * *
NaturalCronExpressionParser::fromString('every 3rd of January'); // 0 0 3 1 *
```

## Tests ##
Check out phpunit tests in /tests

## License ##
MIT