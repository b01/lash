<?php namespace Whip\Lash;
/**
 * Please see the included LICENSE.txt with this source code. If no
 * LICENSE.txt was provided, then all rights for the source code in
 * this file are reserved by Khalifah Khalil Shabazz
 */

use Whip\Lash\Validators\Comparison;
use Whip\Lash\Validators\File;
use Whip\Lash\Validators\FileUpload;
use Whip\Lash\Validators\Password;
use Whip\Lash\Validators\RegExp;
use Whip\Lash\Validators\Strings;

/**
 * Class Validation
 */
final class Validation extends Validator
{
    use Comparison;
    use File;
    use FileUpload;
    use Password;
    use RegExp;
    use Strings;
}