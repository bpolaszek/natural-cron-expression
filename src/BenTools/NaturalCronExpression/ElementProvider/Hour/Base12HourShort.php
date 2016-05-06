<?php

namespace BenTools\NaturalCronExpression\ElementProvider\Hour;

class Base12HourShort extends Base12Hour {

    const PATTERN = '(1[012]|[1-9])\s?(?i)\s?(am|pm)';

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
    public function getHourElement() {
        if (strtolower($this->segments[2]) == 'pm' && (int) $this->segments[1] < 12) {
            return $this->segments[1] + 12;
        }
        elseif (strtolower($this->segments[2]) == 'am' && (int) $this->segments[1] == 12) {
            return 0;
        }
        return (int) $this->segments[1];
    }

    /**
     * @inheritDoc
     */
    public function canProvideMinute() {
        return isset($this->segments[1]);
    }

    /**
     * @inheritDoc
     */
    public function getMinuteElement() {
        return 0;
    }

}