<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Tests\Unit\Encryption\Security\JWT\Validator;

use Phalcon\Encryption\Security\JWT\Validator;
use Phalcon\Tests\Fixtures\Traits\JWTTrait;
use UnitTester;

/**
 * Class ValidateExpirationCest
 *
 * @package Phalcon\Tests\Unit\Encryption\Security\JWT\Validator
 */
class ValidateExpirationCest
{
    use JWTTrait;

    /**
     * Unit Tests Phalcon\Encryption\Security\JWT\Validator ::
     * validateExpiration()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2020-09-09
     */
    public function encryptionSecurityJWTValidatorValidateExpiration(UnitTester $I)
    {
        $I->wantToTest('Encryption\Security\JWT\Validator - validateExpiration()');

        $token     = $this->newToken();
        $timestamp = strtotime(("-2 days"));
        $validator = new Validator($token);
        $I->assertInstanceOf(Validator::class, $validator);

        $validator->validateExpiration($timestamp);

        $expected = ["Validation: the token has expired"];
        $actual   = $validator->getErrors();
        $I->assertSame($expected, $actual);
    }
}
