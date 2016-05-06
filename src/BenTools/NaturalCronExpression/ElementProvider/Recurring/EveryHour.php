<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Recurring;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class EveryHour implements ExpressionElementProvider {

    const PATTERN = '(hourly|(every|each) ?([0-9]+)?\shour)';

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
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getMinuteElement() {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function canProvideHour() {
        return (bool) $this->segments;
    }

    /**
     * @inheritDoc
     */
    public function getHourElement() {
        if ((bool) $this->segments) {
            return isset($this->segments[3]) ? sprintf('*/%d', $this->segments[3]) : '*';
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function canProvideDayNumber() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getDayNumberElement() {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function canProvideMonth() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getMonthElement() {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function canProvideDayOfWeek() {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getDayOfWeekElement() {
        return null;
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
        return true;
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