<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Tests\Unit\Http\Message\ServerRequest;

use Phalcon\Http\Message\ServerRequest;
use Phalcon\Http\Message\Stream;
use UnitTester;

class WithBodyCest
{
    /**
     * Tests Phalcon\Http\Message\ServerRequest :: withBody()
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2019-02-10
     */
    public function httpMessageServerRequestWithBody(UnitTester $I)
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $I->markTestSkipped('Need to fix Windows new lines...');
        }

        $I->wantToTest('Http\Message\ServerRequest - withBody()');

        $fileName = dataDir('/assets/stream/mit.txt');

        $stream  = new Stream($fileName, 'rb');
        $request = new ServerRequest();

        $newInstance = $request->withBody($stream);

        $I->assertNotSame($request, $newInstance);

        $I->openFile($fileName);

        $I->seeFileContentsEqual((string) $newInstance->getBody());
    }
}
