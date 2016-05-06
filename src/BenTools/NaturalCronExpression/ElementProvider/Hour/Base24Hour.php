<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Hour;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class Base24Hour implements ExpressionElementProvider {

    const PATTERN = '(2[0-3]|[01]?[0-9]):([0-5]?[0-9])';

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
        return isset($this->segments[2]);
    }

    /**
     * @inheritDoc
     */
    public function getMinuteElement() {
        return (int) $this->segments[2];
    }

    /**
     * @inheritDoc
     */
    public function canProvideHour() {
        return isset($this->segments[1]);
    }

    /**
     * @inheritDoc
     */
    public function getHourElement() {
        return (int) $this->segments[1];
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
        return $this->canProvideMinute();
    }

    /**
     * @inheritDoc
     */
    public function isHourElementLocked() {
        return $this->canProvideHour();
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