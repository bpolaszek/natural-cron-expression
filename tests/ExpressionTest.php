<?php

namespace BenTools\NaturalCronExpression\Tests;

use BenTools\NaturalCronExpression\NaturalCronExpressionParser;

class ExpressionTest extends \PHPUnit_Framework_TestCase {

    protected $cases = [
        '@yearly'                     => '0 0 1 1 *',
        '@annually'                   => '0 0 1 1 *',
        '@monthly'                    => '0 0 1 * *',
        '@weekly'                     => '0 0 * * 0',
        '@daily'                      => '0 0 * * *',
        '@hourly'                     => '0 * * * *',
        'each day'                    => '0 0 * * *',
        'every day'                   => '0 0 * * *',
        'daily'                       => '0 0 * * *',
        'every day at 3 AM'           => '0 3 * * *',
        '5am'                         => '0 5 * * *',
        'daily at 5am'                => '0 5 * * *',
        'every friday at 5am'         => '0 5 * * 5',
        'daily at 17:30'              => '30 17 * * *',
        'every week'                  => '0 0 * * 0',
        'weekly'                      => '0 0 * * 0',
        'every minute'                => '* * * * *',
        'every 5 minutes'             => '*/5 * * * *',
        'every 30 minutes'            => '*/30 * * * *',
        'every month'                 => '0 0 1 * *',
        'monthly'                     => '0 0 1 * *',
        'every Monday'                => '0 0 * * 1',
        'every Wednesday'             => '0 0 * * 3',
        'every Friday'                => '0 0 * * 5',
        'every hour'                  => '0 * * * *',
        'every 6 hours'               => '0 */6 * * *',
        'hourly'                      => '0 * * * *',
        'every year'                  => '0 0 1 1 *',
        'yearly'                      => '0 0 1 1 *',
        'annually'                    => '0 0 1 1 *',
        'every day at 9am'            => '0 9 * * *',
        'every day at 5pm'            => '0 17 * * *',
        'every day at 5:45pm'         => '45 17 * * *',
        'every day at 17:00'          => '0 17 * * *',
        'every day at 17:25'          => '25 17 * * *',
        '5:15am every Tuesday'        => '15 5 * * 2',
        '7pm every Thursday'          => '0 19 * * 4',
        'every May'                   => '0 0 1 5 *',
        'every December'              => '0 0 1 12 *',
        'midnight'                    => '0 0 * * *',
        'midnight on tuesdays'        => '0 0 * * 2',
        'every 5 minutes on Tuesdays' => '*/5 * * * 2',
        'noon'                        => '0 12 * * *',
        'every 25th'                  => '0 0 25 * *',
        'every 3rd of January'        => '0 0 3 1 *',
    ];

    public function testCases() {
        foreach ($this->cases AS $expression => $value) {
            $this->assertSame($value, NaturalCronExpressionParser::fromString($expression));
        }
    }

}