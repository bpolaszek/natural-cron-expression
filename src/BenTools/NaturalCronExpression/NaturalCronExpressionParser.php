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
            '@yearly'   => '0 0 1 1 *',
            '@annually' => '0 0 1 1 *',
            '@monthly'  => '0 0 1 * *',
            '@weekly'   => '0 0 * * 0',
            '@daily'    => '0 0 * * *',
            '@hourly'   => '0 * * * *',
        ];

        if (isset($mappings[$string])) {
            $string = $mappings[$string];
        }
        
        $expression = new CronExpression();

        $isMinuteElementLocked    = false;
        $isHourElementLocked      = false;
        $isDayNumberElementLocked = false;
        $isMonthElementLocked     = false;
        $isDayOfWeekElementLocked = false;

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $subParser
         * @return bool
         */
        $shouldUpdateMinute =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isMinuteElementLocked) {
            return $subParser->canProvideMinute()
                && !$isMinuteElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $subParser
         * @return bool
         */
        $shouldUpdateHour =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isHourElementLocked) {
            return $subParser->canProvideHour()
                && !$isHourElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $subParser
         * @return bool
         */
        $shouldUpdateDayNumber =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isDayNumberElementLocked) {
            return $subParser->canProvideDayNumber()
                && !$isDayNumberElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $subParser
         * @return bool
         */
        $shouldUpdateMonth =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isMonthElementLocked) {
            return $subParser->canProvideMonth()
                && !$isMonthElementLocked;
        };

        /**
         * @param CronExpression $expression
         * @param ExpressionElementProvider $subParser
         * @return bool
         */
        $shouldUpdateDayOfWeek =  function (CronExpression $expression, ExpressionElementProvider $subParser) use (&$isDayOfWeekElementLocked) {
            return $subParser->canProvideDayOfWeek()
                && !$isDayOfWeekElementLocked;
        };

        foreach ($this->elementProviders AS $subParser) {

            if ($subParser->matches($string)) {

                if ($shouldUpdateMinute($expression, $subParser)) {
                    $expression->setMinute($subParser->getMinuteElement());
                }

                if ($shouldUpdateHour($expression, $subParser)) {
                    $expression->setHour($subParser->getHourElement());
                }

                if ($shouldUpdateDayNumber($expression, $subParser)) {
                    $expression->setDayNumber($subParser->getDayNumberElement());
                }

                if ($shouldUpdateMonth($expression, $subParser)) {
                    $expression->setMonth($subParser->getMonthElement());
                }

                if ($shouldUpdateDayOfWeek($expression, $subParser)) {
                    $expression->setDayOfWeek($subParser->getDayOfWeekElement());
                }

                if ($subParser->isMinuteElementLocked()) {
                    $isMinuteElementLocked = true;
                }

                if ($subParser->isHourElementLocked()) {
                    $isHourElementLocked = true;
                }

                if ($subParser->isDayNumberElementLocked()) {
                    $isDayNumberElementLocked = true;
                }

                if ($subParser->isMonthElementLocked()) {
                    $isMonthElementLocked = true;
                }

                if ($subParser->isDayOfWeekElementLocked()) {
                    $isDayOfWeekElementLocked = true;
                }

            }

        }

        if ($expression->hasNothing()) {
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

}