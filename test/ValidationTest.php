<?php namespace Whip\Lash\Test;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validation;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidationTest
 *
 * @package \Whip\Lash\Test
 * @coversDefaultClass \Whip\Lash\Validation
 */
class ValidationTest extends TestCase
{
    /** @var array Fixed rules to test. */
    private $fixtureRules;

    public function setUp()
    {
        $this->fixtureRules = [
            'numericValue' => [
                'validator' => 'range',
                'err' => 'enter a numeric value',
                'constraint' => [1, 100]
            ],
            'stringValue' => [
                'validator' => 'length',
                'err' => 'enter a least 4 characters.',
                'constraint' => 4
            ],
            'regexValue' => [
                'validator' => 'regex',
                'err' => 'enter a value that matches the pattern',
                'constraint' => '/^[a-z]{1,3}$/'
            ],
            'setValue' => [
                'validator' => 'inSet',
                'err' => 'enter a value in the set',
                'constraint' => ['item1', 'item2', 'item3']
            ],
        ];
    }

    /**
     * @covers ::__construct
     */
    public function testCanInitialize()
    {
        $sut = new Validation();

        $this->assertInstanceOf(Validation::class, $sut);
    }

    /**
     * @covers ::addRule
     * @uses \Whip\Lash\Validation::__construct
     * @expectedException \Exception
     */
    public function testCannotAddRuleWithInvalidName()
    {
        $sut = new Validation();

        $sut->addRule('_badName', 'stringLen', 1);
    }

    /**
     * @covers ::addRule
     * @covers ::addCustomValidator
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanUseCustomValidation()
    {
        $key = 'fname';
        $validation = new Validation();

        $validation->addRule($key, $key, 'test1');

        $validation->addCustomValidator($key,
            function ($value, $constraint) {
                return $value === 1 && $constraint === 'test1';
            });

        $actual = $validation->validate([$key => 1]);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::range
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanValidateNumericValueIsWithinInRange()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['numericValue' => 21]);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::range
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanInvalidateNumericValueIsOutOfRange()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['numericValue' => -1]);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::length
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanValidateString()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['stringValue' => 'test']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::length
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanInvalidateString()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['stringValue' => '']);

        $this->assertFalse($actual);
    }

    /**
     * @covers ::inSet
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanValidateStringAsPartOfASet()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['setValue' => 'item1']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::inSet
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @uses \Whip\Lash\Validation::getRule
     */
    public function testCanInvalidateAStringIsNotInASet()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['setValue' => 'item1']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::regex
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     */
    public function testCanValidateAValuePassesARegularExpression()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['regexValue' => 'tst']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::regex
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     */
    public function testCanInvalidateAValueFailsARegularExpression()
    {
        $sut = new Validation();

        $sut->addRules($this->fixtureRules);

        $actual = $sut->validate(['setValue' => 'item1']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::regex
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @expectedException \Exception
     */
    public function testCanInvalidateABadRegularExpression()
    {
        $sut = new Validation();

        $sut->addRule('badRegExp', 'regex', '/^[a-Z/', 'I is bad');

        $sut->validate(['badRegExp' => 'item1']);
    }

    /**
     * @covers ::addRules
     * @uses \Whip\Lash\Validation::__construct
     */
    public function testCanAddMultipleRules()
    {
        $sut = new Validation();

        $actual = $sut->addRules($this->fixtureRules);

        $this->assertEquals(count($this->fixtureRules), $actual);
    }

    /**
     * @covers ::addRule
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::validate
     */
    public function testCanAddASingleRule()
    {
        $sut = new Validation();

        $actual = $sut->addRule('test', 'range', [1,5]);
        $actual2 = $sut->validate(['test' => 2]);

        $this->assertTrue($actual);
        $this->assertTrue($actual2);
    }

    /**
     * @covers ::addCustomValidator
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::validate
     */
    public function testCanAddCustomValidator()
    {
        $sut = new Validation();

        $sut->addCustomValidator(
            'customValidation',
            function ($value, callable $constraint) {
                return $constraint($value);
            }
        );

        $actual2 = $sut->addRule(
            'testName',
            'customValidation',
            function ($value) {
                return $value === 2;
            }
        );

        $actual3 = $sut->validate(['testName' => 2]);

        $this->assertTrue($actual2);
        $this->assertTrue($actual3);
    }

    /**
     * @covers ::getRule
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::validate
     * @expectedException \Exception
     * @expectedExceptionMessage No rule found matching the name
     */
    public function testCannotGetRule()
    {
        $sut = new Validation();

        $sut->validate(['testName' => 2]);
    }

    /**
     * @covers ::getRule
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::validate
     */
    public function testCanGetRule()
    {
        $sut = new Validation();

        $sut->addRule('testRule', 'length', 2);

        $actual = $sut->validate(['testRule' => '12']);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::getErrors
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::validate
     */
    public function testCanGetErrors()
    {
        $errorFixture = 'got an error';

        $sut = new Validation();

        $sut->addRule('gotError', 'length', 2, $errorFixture);

        $sut->validate(['gotError' => '1']);

        $actual = $sut->getErrors();

        $this->assertEquals($actual['gotError'], $errorFixture);
    }

    /**
     * @covers ::throwOnMissingKey
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @expectedException \Exception
     * @expectedExceptionMessage Missing "validator" key at rule
     */
    public function testMissingRequiredRuleKeyValidator()
    {
        $sut = new Validation();

        $sut->addRules([
            'missingAllRequiredKeys' => [
                Validation::RULE_KEY_CONSTRAINT => 1,
                Validation::RULE_KEY_ERR_MSG => 'fake msg 1'
            ]
        ]);
    }

    /**
     * @covers ::throwOnMissingKey
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @expectedException \Exception
     * @expectedExceptionMessage Missing "constraint" key at rule
     */
    public function testMissingRequiredRuleKeyConstraint()
    {
        $sut = new Validation();

        $sut->addRules([
            'missingAllRequiredKeys' => [
                Validation::RULE_KEY_VALIDATOR => 'length',
                Validation::RULE_KEY_ERR_MSG => 'fake msg 1'
            ]
        ]);
    }

    /**
     * @covers ::throwOnMissingKey
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     * @expectedException \Exception
     * @expectedExceptionMessage Missing "err" key at rule
     */
    public function testMissingRequiredRuleKeyErr()
    {
        $sut = new Validation();

        $sut->addRules([
            'missingAllRequiredKeys' => [
                Validation::RULE_KEY_VALIDATOR => 'length',
                Validation::RULE_KEY_CONSTRAINT => 1
            ]
        ]);
    }

    /**
     * @covers ::throwOnMissingKey
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addRules
     */
    public function testNoRequiredRuleKeyAreMissing()
    {
        $sut = new Validation();

        $actual = $sut->addRules([
            'missingAllRequiredKeys' => [
                Validation::RULE_KEY_VALIDATOR => 'length',
                Validation::RULE_KEY_CONSTRAINT => 1,
                Validation::RULE_KEY_ERR_MSG => 'err message'
            ]
        ]);

        $this->assertEquals(1, $actual);
    }

    /**
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @expectedException \Exception
     * @expectedExceptionMessage Could not find the validator "fakeValidator"
     */
    public function testMissingValidator()
    {
        $sut = new Validation();

        $sut->addRule('ks1', 'fakeValidator', 0);

        $sut->validate(['ks1' => 1]);
    }

    /**
     * @covers ::addRule
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::validate
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::gt
     */
    public function testCanRemoveErrorMessage()
    {
        $sut = new Validation();

        $sut->addRule('messageRemoval', 'gt', 0, '-');

        $sut->validate(['messageRemoval' => -1]);

        $actual = $sut->getErrors();

        $this->assertEmpty($actual['messageRemoval']);
    }

    /**
     * @covers ::addRule
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::validate
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::lt
     */
    public function testCannotAccidentallyRemovedErrorMessage()
    {
        $name = 'forgotErrorMessage';
        $sut = new Validation();

        $sut->addRule($name, 'lt', 0, '');

        $sut->validate([$name => 1]);

        $actual = $sut->getErrors();

        $this->assertContains(
            \sprintf(Validation::DEFAULT_ERR_MSG, $name, 1, 'lt', 0),
            $actual['forgotErrorMessage']
        );
    }

    /**
     * @covers ::validate
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::lt
     */
    public function testCanMaskValueInErrorMessage()
    {
        $name = 'maskedValue';

        $sut = new Validation();

        $sut->addRule($name, 'lt', 0, '%2$s', true);

        $sut->validate([$name => 1]);

        $actual = $sut->getErrors();

        $this->assertEquals('*', $actual[$name]);
    }

    /**
     * @covers ::addRulesByIndex
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::gt
     * @uses \Whip\Lash\Validation::validate
     */
    public function testCanAddRulesByIndex()
    {
        $name = 'value1';
        $name2 = 'value2';

        $sut = new Validation();

        $actual = $sut->addRulesByIndex([
            $name => ['gt', 0, 'error 1'],
            $name2 => ['lt', 0, 'error 2']
        ]);

        $actual2 = $sut->validate([$name => 1, $name2 => -1]);

        $this->assertEquals(2, $actual);
        $this->assertTrue($actual2);
    }

    /**
     * @covers ::throwOnMissingIndex
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::validate
     * @expectedException \Exception
     * @expectedExceptionMessage Missing "0" index at rule index
     */
    public function testWillThrowOnMissingIndex()
    {
        $name = '$field1';
        $fixtureRule = [ 1 => 0, 2 => 'error 1'];

        $sut = new Validation();

        $sut->addRulesByIndex([
            $name => $fixtureRule
        ]);
    }

    /**
     * @covers ::throwOnMissingIndex
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::validate
     * @expectedException \Exception
     * @expectedExceptionMessage Missing "1" index at rule index
     */
    public function testWillThrowOnMissingIndex1()
    {
        $name = '$field1';
        $fixtureRule = [ 0 => 'gt', 2 => 'error 1'];

        $sut = new Validation();

        $sut->addRulesByIndex([
            $name => $fixtureRule
        ]);
    }

    /**
     * @covers ::throwOnMissingIndex
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::validate
     * @expectedException \Exception
     * @expectedExceptionMessage Missing "2" index at rule index
     */
    public function testWillThrowOnMissingIndex2()
    {
        $name = '$field1';
        $fixtureRule = [ 0 => 'gt', 1 => 0];

        $sut = new Validation();

        $sut->addRulesByIndex([
            $name => $fixtureRule
        ]);
    }

    /**
     * @covers ::throwOnMissingIndex
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::validate
     */
    public function testWillNotThrowExceptionWhenUsingOnAddRulesByIndex()
    {
        $name = 'field1';
        $fixtureRule = [ 0 => 'gt', 1 => 0, 2 => 'err msg'];

        $sut = new Validation();

        $sut->addRulesByIndex([
            $name => $fixtureRule
        ]);

        $actual = $sut->validate([$name => 1]);

        $this->assertTrue($actual);
    }

    /**
     * @covers ::addRules
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addCustomValidator
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::validate
     */
    public function testCanAddCustomRuleWhenAddingAsArray()
    {
        $name = 'field1';

        $sut = new Validation();

        $actual = $sut->addRules([
            $name => [
                Validation::RULE_KEY_CUSTOM => 'custom',
                Validation::RULE_KEY_CONSTRAINT => function() {
                    return true;
                },
                Validation::RULE_KEY_ERR_MSG => 'error 1'
            ]
        ]);

        $actual2 = $sut->validate([$name => 1]);

        $this->assertEquals(1, $actual);
        $this->assertTrue($actual2);
    }

    /**
     * @covers ::addRules
     * @uses \Whip\Lash\Validation::__construct
     * @uses \Whip\Lash\Validation::addRule
     * @uses \Whip\Lash\Validation::addCustomValidator
     * @uses \Whip\Lash\Validation::getRule
     * @uses \Whip\Lash\Validation::validate
     */
    public function testWillProperlyValidateCustomRuleWhenAddedAsArray()
    {
        $name = 'field1';
        $fixtureError = 'error 1';

        $sut = new Validation();

        $actual = $sut->addRules([
            $name => [
                Validation::RULE_KEY_CUSTOM => 'custom',
                Validation::RULE_KEY_CONSTRAINT => function() {
                    return false;
                },
                Validation::RULE_KEY_ERR_MSG => $fixtureError
            ]
        ]);

        $actual2 = $sut->validate([$name => 1]);
        $actual3 = $sut->getErrors();

        $this->assertEquals(1, $actual);
        $this->assertFalse($actual2);
        $this->assertEquals($fixtureError, $actual3[$name]);
    }
}
