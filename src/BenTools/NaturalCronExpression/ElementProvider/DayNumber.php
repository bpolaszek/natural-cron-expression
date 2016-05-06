<?php

namespace BenTools\NaturalCronExpression\ElementProvider;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class DayNumber implements ExpressionElementProvider{

    const PATTERN = '([0-9]?[0-9])(st|nd|rd|th)';

    protected $segments = [];

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
        return $this->segments[1];
    }

    /**
     * @inheritDoc
     */
    public function canProvideMonth() {
        return (bool) $this->segments;
    }

    /**
     * @inheritDoc
     */
    public function getMonthElement() {
        return '*';
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
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isMonthElementLocked() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isDayOfWeekElementLocked() {
        return false;
    }

}