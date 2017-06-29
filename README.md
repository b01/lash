## Summary

Perform assertions on some input via a fluid interface. Allows you to quickly 
get started with some out-of-the-box general validation. Its also extend-able
so that you can customize when needed and encourages re-usability. The fluid 
interface can also help to reduce testing efforts.
  

## Description
A validation library with a fluid interface. Some features to note are that:

  * You can quickly get started with out-of-the-box general validation.
  * It can be extended by following a few steps.
  * It encourage reuseability
  * It can help reduce testing efforts.


## How to use Out-of-the-box Validation

```php
$validation = (new Validation())
    ->withMessages([ // These keys DO NOT have to match input keys.
       'fname' => 'name must be between 1-26 chars.',
       'fname_re' => 'can only contain spaces & letters.'
   ])
    ->withInput[
       'fnname' => 'First',
   ]);

$validation->assert('first_name')
    ->length(1, 26, 'fname')
    ->regExp('/^[a-zA-Z]+$/', 'fname_re);

$errors = $validation->getErrors();
```


## How to build your Own Validation

So you want to scale the validation down/up to suit your needs and 
customize it to your application. Then you will need to extend the abstract the 
\Whip\Lash\Validator class and use some traits. You can either use the 
\Whip\Lash\Validators supplied with Lash, or [build your own](#How to Build your Own Validator).

```php
use \Whip\Lash\Validators\Strings;

class FormValidation extents Validator
{
    use Strings; 
}
```
## How to Build your Own Validator

Validators are just traits with functions. It was decided to use traits over 
classes and interfaces because the play nice with auto-completion and produce 
less spaghetti code.

```php

```