<?php

namespace BenTools\NaturalCronExpression;

class CronExpression {

    public $minute;
    public $hour;
    public $dayNumber;
    public $month;
    public $dayOfWeek;

    /**
     * @return string
     */
    public function getMinute() {
        return $this->minute;
    }

    /**
     * @return string
     */
    public function hasMinute() {
        return null !== $this->minute;
    }

    /**
     * @param string $minute
     * @return $this - Provides Fluent Interface
     */
    public function setMinute($minute) {
        $this->minute = $minute;
        return $this;
    }

    /**
     * @return string
     */
    public function getHour() {
        return $this->hour;
    }

    /**
     * @return string
     */
    public function hasHour() {
        return null !== $this->hour;
    }

    /**
     * @param string $hour
     * @return $this - Provides Fluent Interface
     */
    public function setHour($hour) {
        $this->hour = $hour;
        return $this;
    }

    /**
     * @return string
     */
    public function getDayNumber() {
        return $this->dayNumber;
    }

    /**
     * @return string
     */
    public function hasDayNumber() {
        return null !== $this->dayNumber;
    }

    /**
     * @param string $dayNumber
     * @return $this - Provides Fluent Interface
     */
    public function setDayNumber($dayNumber) {
        $this->dayNumber = $dayNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMonth() {
        return $this->month;
    }

    /**
     * @return string
     */
    public function hasMonth() {
        return null !== $this->month;
    }

    /**
     * @param string $month
     * @return $this - Provides Fluent Interface
     */
    public function setMonth($month) {
        $this->month = $month;
        return $this;
    }

    /**
     * @return string
     */
    public function getDayOfWeek() {
        return $this->dayOfWeek;
    }

    /**
     * @return string
     */
    public function hasDayOfWeek() {
        return null !== $this->dayOfWeek;
    }

    /**
     * @param string $dayOfWeek
     * @return $this - Provides Fluent Interface
     */
    public function setDayOfWeek($dayOfWeek) {
        $this->dayOfWeek = $dayOfWeek;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasNothing() {
        return !$this->hasMinute()
            && !$this->hasHour()
            && !$this->hasDayNumber()
            && !$this->hasMonth()
            && !$this->hasDayOfWeek();
    }

    /**
     * @return string
     */
    public function __toString() {
        return sprintf('%s %s %s %s %s',
            $this->hasMinute() ? $this->minute : 0,
            $this->hasHour() ? $this->hour : 0,
            $this->hasDayNumber() ? $this->dayNumber : '*',
            $this->hasMonth() ? $this->month : '*',
            $this->hasDayOfWeek() ? $this->dayOfWeek : '*');
    }

}