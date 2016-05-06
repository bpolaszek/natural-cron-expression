<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Recurring;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class EveryWeek implements ExpressionElementProvider {

    const PATTERN = '(weekly|(every|each)\sweek)';

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
        return '*';
    }

    /**
     * @inheritDoc
     */
    public function canProvideMonth() {
        return true;
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
        return (bool) $this->segments;
    }

    /**
     * @inheritDoc
     */
    public function getDayOfWeekElement() {
        return '0';
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
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isDayOfWeekElementLocked() {
        return false;
    }
}