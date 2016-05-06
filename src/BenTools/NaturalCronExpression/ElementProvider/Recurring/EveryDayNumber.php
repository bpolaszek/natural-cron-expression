<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Recurring;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class EveryDayNumber implements ExpressionElementProvider {

    const PATTERN = '(every|each)\s([0-9]?[0-9])(st|nd|rd|th)\sof\s(month|january|february|march|april|may|june|july|august|september|october|november|december)';

    protected $segments = [];

    public static $MONTH_MAP = [
        'january'   => 1,
        'february'  => 2,
        'march'     => 3,
        'april'     => 4,
        'may'       => 5,
        'june'      => 6,
        'july'      => 7,
        'august'    => 8,
        'september' => 9,
        'october'   => 10,
        'november'  => 11,
        'december'  => 12,
    ];

    /**
     * @inheritDoc
     */
    public function matches($string) {
        preg_match('/' . static::PATTERN . '/i', $string, $matches);
        $this->segments = (array) $matches;
        return (bool) $this->segments;
    }

    /**
     * @inheritDoc
     */
    public function canProvideMinute() {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getMinuteElement() {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function canProvideHour() {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getHourElement() {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function canProvideDayNumber() {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDayNumberElement() {
        return $this->segments[2];
    }

    /**
     * @inheritDoc
     */
    public function canProvideMonth() {
        return isset($this->segments[4]);
    }

    /**
     * @inheritDoc
     */
    public function getMonthElement() {
        return isset(static::$MONTH_MAP[$this->segments[4]]) ? static::$MONTH_MAP[$this->segments[4]] : null;
    }

    /**
     * @inheritDoc
     */
    public function canProvideDayOfWeek() {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDayOfWeekElement() {
        return '*';
    }

    /**
     * @inheritDoc
     */
    public function isMinuteElementLocked() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isHourElementLocked() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isDayNumberElementLocked() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isMonthElementLocked() {
        return $this->canProvideMonth();
    }

    /**
     * @inheritDoc
     */
    public function isDayOfWeekElementLocked() {
        return false;
    }
}