<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Recurring;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class EveryYear implements ExpressionElementProvider {

    const PATTERN = '(yearly|annually|(every|each) ?([0-9]+)?\year)';

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
        return 1;
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
        return 1;
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
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isDayOfWeekElementLocked() {
        return false;
    }

}