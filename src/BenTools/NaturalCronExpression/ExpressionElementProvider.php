<?php

namespace BenTools\NaturalCronExpression;

interface ExpressionElementProvider {
    
    /**
     * @param $string
     * @return bool
     */
    public function matches($string);

    /**
     * @return bool
     */
    public function canProvideMinute();

    /**
     * @return string
     */
    public function getMinuteElement();

    /**
     * @return bool
     */
    public function isMinuteElementLocked();

    /**
     * @return bool
     */
    public function canProvideHour();

    /**
     * @return string
     */
    public function getHourElement();

    /**
     * @return bool
     */
    public function isHourElementLocked();

    /**
     * @return bool
     */
    public function canProvideDayNumber();

    /**
     * @return string
     */
    public function getDayNumberElement();

    /**
     * @return bool
     */
    public function isDayNumberElementLocked();

    /**
     * @return bool
     */
    public function canProvideMonth();

    /**
     * @return string
     */
    public function getMonthElement();

    /**
     * @return bool
     */
    public function isMonthElementLocked();

    /**
     * @return bool
     */
    public function canProvideDayOfWeek();

    /**
     * @return string
     */
    public function getDayOfWeekElement();

    /**
     * @return bool
     */
    public function isDayOfWeekElementLocked();

}