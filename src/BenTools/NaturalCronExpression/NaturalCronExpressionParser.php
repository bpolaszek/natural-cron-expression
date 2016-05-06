<?php

namespace BenTools\NaturalCronExpression;

use BenTools\NaturalCronExpression\ElementProvider\Hour\Base12Hour;
use BenTools\NaturalCronExpression\ElementProvider\Hour\Base12HourShort;
use BenTools\NaturalCronExpression\ElementProvider\Hour\Base24Hour;
use BenTools\NaturalCronExpression\ElementProvider\Hour\Midnight;
use BenTools\NaturalCronExpression\ElementProvider\Hour\Noon;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryDay;
use BenTools\NaturalCronExpression\ElementProvider\DayNumber;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryDayNumber;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryHour;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryMinute;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryMonth;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryWeek;
use BenTools\NaturalCronExpression\ElementProvider\Recurring\EveryYear;

class NaturalCronExpressionParser {
    
    const VALID_PATTERN = '^(@reboot|@yearly|@annually|@monthly|@weekly|@daily|@midnight|@hourly|((?:[1-9]?\d|\*)\s*(?:(?:[\/-][1-9]?\d)|(?:,[1-9]?\d)+)?\s*){5})$';

    /**
     * @var ExpressionElementProvider[]
     */
    protected $elementProviders = [];

    /**
     * NaturalCronExpressionParser constructor.
     */
    public function __construct() {
        $this->elementProviders = [
            new EveryYear(),
            new EveryMonth(),
            new EveryWeek(),
            new EveryDayNumber(),
            new EveryDay(),
            new EveryHour(),
            new EveryMinute(),
            new DayNumber(),
            new Noon(),
            new Midnight(),
            new Base12Hour(),
            new Base12HourShort(),
            new Base24Hour(),
        ];
    }

    /**
     * @param $string
     * @return CronExpression
     */
    public function parse($string) {
        
        $string   = strtolower($string);
        $mappings = [
            '@yearly'   => new CronExpression(0, 0, 1, 1, '*'),
            '@annually' => new CronExpression(0, 0, 1, 1, '*'),
            '@monthly'  => new CronExpression(0, 0, 1, '*', '*'),
            '@weekly'   => new CronExpression(0, 0, '*', '*', 0),
            '@midnight' => new CronExpression(0, 0, '*', '*', '*'),
            '@daily'    => new CronExpression(0, 0, '*', '*', '*'),
            '@hourly'   => new CronExpression(0, '*', '*', '*', '*'),
        ];

        if (isset($mappings[$string])) {
            return $mappings[$string];
        }
        
        $expression = new CronExpression();

        $isMinuteElementLocked    = false;
        $isHourElementLocked      = false;
        $isDayNumberElementLocked = false;
        $isMonthElementLocked     = false;
        $isDayOfWeekElementLocked = false;

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $elementProvider
         * @return bool
         */
        $shouldUpdateMinute =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isMinuteElementLocked) {
            return $subParser->canProvideMinute()
                && !$isMinuteElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $elementProvider
         * @return bool
         */
        $shouldUpdateHour =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isHourElementLocked) {
            return $subParser->canProvideHour()
                && !$isHourElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $elementProvider
         * @return bool
         */
        $shouldUpdateDayNumber =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isDayNumberElementLocked) {
            return $subParser->canProvideDayNumber()
                && !$isDayNumberElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $elementProvider
         * @return bool
         */
        $shouldUpdateMonth =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isMonthElementLocked) {
            return $subParser->canProvideMonth()
                && !$isMonthElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $elementProvider
         * @return bool
         */
        $shouldUpdateDayOfWeek =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isDayOfWeekElementLocked) {
            return $subParser->canProvideDayOfWeek()
                && !$isDayOfWeekElementLocked;
        };

        foreach ($this->elementProviders AS $elementProvider) {

            if ($elementProvider->matches($string)) {

                if ($shouldUpdateMinute($expression, $elementProvider)) {
                    $expression->setMinute($elementProvider->getMinuteElement());
                }

                if ($shouldUpdateHour($expression, $elementProvider)) {
                    $expression->setHour($elementProvider->getHourElement());
                }

                if ($shouldUpdateDayNumber($expression, $elementProvider)) {
                    $expression->setDayNumber($elementProvider->getDayNumberElement());
                }

                if ($shouldUpdateMonth($expression, $elementProvider)) {
                    $expression->setMonth($elementProvider->getMonthElement());
                }

                if ($shouldUpdateDayOfWeek($expression, $elementProvider)) {
                    $expression->setDayOfWeek($elementProvider->getDayOfWeekElement());
                }

                if ($elementProvider->isMinuteElementLocked()) {
                    $isMinuteElementLocked = true;
                }

                if ($elementProvider->isHourElementLocked()) {
                    $isHourElementLocked = true;
                }

                if ($elementProvider->isDayNumberElementLocked()) {
                    $isDayNumberElementLocked = true;
                }

                if ($elementProvider->isMonthElementLocked()) {
                    $isMonthElementLocked = true;
                }

                if ($elementProvider->isDayOfWeekElementLocked()) {
                    $isDayOfWeekElementLocked = true;
                }

            }

        }

        if ($expression->hasNothing() || !preg_match(sprintf('/%s/', static::VALID_PATTERN), (string) $expression)) {
            throw new ParserException(sprintf('Unable to parse "%s"', $string));
        }

        return $expression;
    }

    /**
     * @param $string
     * @return string
     */
    public static function fromString($string) {
        $parser = new static;
        return (string) $parser->parse($string);
    }

    /**
     * @param $string
     * @return bool
     */
    public static function isValid($string) {
        if ($string === '@reboot') // Can't be parsed, but valid
            return true;
        try {
            static::fromString($string);
            return true;
        }
        catch (ParserException $e) {
            return false;
        }
    }

}