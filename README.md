## Summary

[![CircleCI](https://circleci.com/gh/b01/lash.svg?style=svg)](https://circleci.com/gh/b01/lash)

Lash validation is a small validation library that asserts some values meet
programmatic constraints. Its great for using with applications that process
data from external sources and need to ensure that data is safe for processing
or storing in internal systems.

## Table Of Contents

* [Description](#description)
* [Concepts and Principals](#concepts-and-principals)
* [Validation](#how-to-use-validation)
  * [Using Regular Expressions](#using-regular-expressions)
  * [Mask Values in Error Messages](#mask-values-in-error-messages)
  * [Logic Operators](#logic-operators)
  * [Add A Custom Validator](#add-a-custom-validator)
  * [Adding Multiple Rules](#adding-multiple-rules)
* [Definitions](#definitions)
* [API Reference](docs/Whip/Lash/Validation.html#Rules)

## Description

Lash validation is built around the flow of passing in an array of values as
input and getting a pass/fail response as output. That the user interface and
integration steps should be minimal.
So the flow is:
1. Instantiate a Validation object.
2. Add rules (validation methods mapped to values of the input to be validated).
3. Call the validate, passing in values, and assert they pass or fail.

Its rule system (which map input array keys to validation methods) can aid in
streamlining the validation processing. While it comes with some standard
built-in rules, the real flexibility is its system for injecting reusable
custom validation rules (at run time). This allows Lash to be scalable and
maintainable. It should also lend itself to building more complex validation
services for a multitude of applications.

## Concepts and Principals
* This library should not try to solve for everyone needs. Rather provide a
  base system that is flexible enough to be built upon to aid in solving lots
  of different or even some edge scenarios.
* The overall size of the library should remain small and easy to download
  in a second 1 or less.
* Be simple enough for end-users to pick up and begin using withing a day, and
  without having to read all of the documentation.
* Flexible enough that end-users can validate just about anything without
  adding a lot of bloat on their end to accommodate this library.
* This library should NOT contain a lot of bloat so that end-user gets way more
  than what they need.

## Definitions
* Named-value - An element in an array where the key is the name and the value
  is a scalar value.
* Rule - Is an array element, where the key is the name of a named-value and
  value is an array containing elements "validation", "err", and "constraint".
* Validator - A function/method that is passed a value, constraint, and the
  array of values (passed in the the validate method), which performs
  assertions to ensure the value meets the constraint.

## How To Use Validation
Examples:

### Using Regular Expressions

Use a regular expression to validate a string meet a format constraint.

```php
use Whip\Lash\Validation

// Start a new validation object.
$validation = new Validation();

// Add a rule.
$validation->addRule('first_name', 'regex', '/^[a-zA-Z]{1,15}$/');

// Validate input.
$valid = $validation->validate([ 'first_name' => 'Jane' ]);

// Do something with errors.
if (!$valid) {
    // Masked input values are replaced with single asterisk in the error.
    $errors = $validation->getErrors();
    \error_log(
        'These fields failed validation: ' . \print_r($errors, true)
    );
}
```

### Mask Values in Error Messages

Mask the value in the error messages returned.
Error messages are run through the \sprintf function and passed the value,
name, validator, and constraint (in that order). Which allow for very specific
error messaging. However that may be times when you want the value to be masked
If you add the "mask" field to the rule it will replace the value with a single
asterisk in the error message output. For example:

```php
use Whip\Lash\Validation

$validation = new Validation();

$validation->addRule(
    'ssn', 
    'regex', 
    '/^\d{3}-\d{2}-\d{4}$/',
    'Invalid social security number: %1$s',
    'mask' => true
);

$valid = $validation->validate([ 'ssn' => '000-00-000a' ]);

$errors = $validation->getErrors();

\print_r($errors);
// Output:
array(
    'ssn' => 'Invalid social security number: *'
)
```

### Logic Operators

```php
$validation->addRule('age', 'gt', 18, 'you must be 18 or older');

$valid = $validation->validate([
    'age' => 44,
]);

if (!$valid) {
    \error_log(
        'These fields failed validation: ' . \print_r($errors, true)
    );
}
```

### Add A Custom Validator

Custom validators will give you the ability to truly scrutinize input against
your own standard. Take full advantage of anything PHP has to offer to validate
your input.
```php
$validation = new Validation();
$carValidator = 'carMakers';

$validation->addCustomValidator(
    $carValidator,
    function ($value, $constraint) {
        return !\in_array($value, $constraint);
    }, 
    $message
);

$validation->addRule(
    'carMake', 
    $carValidator,
    ['ford', 'gm', 'chrysler'], 
    'your car is no good sir'
);

$actual = $validation->validate(['car' => 'chrysler ']);
```

### Adding Multiple Rules

Once you have all your validators setup, it time to start adding multiple
rules. The [Validation::addRules](docs/Whip/Lash/Validation.html#addRules)
allows for more than one rule to be added at a time. There is another method
[Validation::addRulesByIndex](docs/Whip/Lash/Validation.html#addRulesByIndex)
that will allow use of indexes instead of the "validator", "constraint", "err"
keys; which makes for cleaner code.

```php
$validation = new Validation();

$validation->addRules([
    'first_name' => [
        'validator' => 'regex',
        'constraint' => '/^[a-zA-Z]{1,15}$/',
        'err' => 'please enter your first name'
    ],
    'age' => [
        'validator' => 'gt',
        'constraint' => 18,
        'err' => 'you must be 18 or older'
    ],
    'ssn' => [
        'validator' => 'regex',
        'constraint' => '/^\d{3}-\d{2}-\d{4}$/',
        'err' => 'please enter a valid social security number'
    ],
]);

$valid = $validation->validate([
    'first_name' => 'Jane',
    'age' => 44,
    'ssn' => '000-00-0000'
]);

if (!$valid) {
    // Masked input values are replaced with single asterisk in the error.
    $maskFields = [ 'age', 'ssn' ];
    $errors = $validation->getErrors($maskFields);
    \error_log(
        'These fields failed validation: ' . \print_r($errors, true)
    );
}
```