<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Hour;

use BenTools\NaturalCronExpression\ExpressionElementProvider;

class Noon implements ExpressionElementProvider {
    
    protected $match;

    /**
     * @inheritDoc
     */
    public function matches($string) {
        $this->match = strpos($string, 'noon') !== false;
        return $this->match;
    }

    /**
     * @inheritDoc
     */
    public function canProvideMinute() {
        return (bool) $this->match;
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
        return (bool) $this->match;
    }

    /**
     * @inheritDoc
     */
    public function getHourElement() {
        return 12;
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