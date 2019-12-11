<?php

namespace Test;

use Hms\DictCheck\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Class DictValidatorUnit
 * @package Test
 *
 * @author  Hubert Smusz <hubert.smusz@gmail.com>
 * @version 1.0.0
 */
class DictValidatorUnit extends TestCase
{

    public function testBase()
    {
        $validator = new Validator();
        $validator->validate('12345dupa678986543456');
    }
}
