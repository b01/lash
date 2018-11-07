<?php
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

namespace Whip\Lash;

use PHPUnit\Framework\TestCase;

/**
 * Class ValidationIntegrationTest
 * @package Whip\Lash
 * @coversDefaultClass \Whip\Lash\Validation
 */
class ValidationIntegrationTest extends TestCase
{
    function testSimpleValidationPasses()
    {
        $sut = new Validation();

        $sut->addRules([
            'first_name' => [
                'validator' => 'regex',
                'constraint' => '/^[a-zA-Z\'\s]+/',
                'err' => 'first name can only contain letters and an apostrophe'
            ],
            'last_name' => [
                'validator' => 'regex',
                'constraint' => '/^[a-zA-Z\'\s]+/',
                'err' => 'last name can only contain letters, space, and an apostrophe'
            ],
            'age' => [
                'validator' => 'range',
                'constraint' => [18, 136],
                'err' => 'you must be older than 18 years of age'
            ],
        ]);

        $actual = $sut->validate([
            'first_name' => "Professor",
            'last_name' => 'X',
            'age' => 32,
        ]);

        $this->assertTrue($actual);
    }
}
