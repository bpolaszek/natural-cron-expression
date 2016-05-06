<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Recurring;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class EveryDay implements ExpressionElementProvider {

    const PATTERN = '(daily|(every|each|on)\s(day|monday|tuesday|wednesday|thursday|friday|saturday|sunday)(?s))';

    protected $segments = [];

    public static $DAY_MAP = [
        'sunday'    => 0,
        'monday'    => 1,
        'tuesday'   => 2,
        'wednesday' => 3,
        'thursday'  => 4,
        'friday'    => 5,
        'saturday'  => 6,
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
        if ($this->segments[0] == 'daily' || (isset($this->segments[3]) && $this->segments[3] == 'day')) {
            return '*';
        }
        else {
            return isset(static::$DAY_MAP[$this->segments[3]]) ? static::$DAY_MAP[$this->segments[3]] : null;
        }
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
        return true;
    }

}