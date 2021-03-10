<?php

declare(strict_types=1);

/*
 * This file is part of the TangoMan Globalis package.
 *
 * (c) "Matthias Morin" <mat@tangoman.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Continent;

use App\Continent\Continent;
use PHPUnit\Framework\TestCase;

class ContinentTest extends TestCase
{

    // --------------------------------------------------
    // Width
    // --------------------------------------------------

    public function testSmallWidthShouldRaiseInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Width cannot be lower than 1 ; "0" given');

        new Continent(0, '1');
    }

    public function testLargeWidthShouldRaiseInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Width cannot be greater than 100000 ; "100001" given');

        new Continent(100001, '1');
    }

    // --------------------------------------------------
    // Terrain
    // --------------------------------------------------

    public function testInvalidTerrainShouldRaiseInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Terrain cannot be wider that continent');

        new Continent(1, '1 2');
    }

    // --------------------------------------------------
    // Height
    // --------------------------------------------------

    public function testInvalidHeightShouldRaiseInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid Height ; "foobar" given');

        new Continent(1, 'foobar');
    }

    public function testNegativeHeightShouldRaiseInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Height cannot be lower than 0 ; "-1" given');

        new Continent(1, '-1');
    }

    public function testLargeHeightShouldRaiseInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Height cannot be greater than 100000 ; "100001" given');

        new Continent(1, '100001');
    }

    // --------------------------------------------------
    // Main business logic
    // --------------------------------------------------

    public function testGetSafeArea()
    {
        $continent = new Continent(10, '30 27 17 42 29 12 14 41 42 42');

        $this->assertEquals(88, $continent->getSafeArea());
    }
}
