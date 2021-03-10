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

namespace App\Continent;

class Continent
{
    public const DEFAULT_MIN_WIDTH = 1;
    public const DEFAULT_MAX_WIDTH = 100000;
    public const DEFAULT_MIN_HEIGHT = 0;
    public const DEFAULT_MAX_HEIGHT = 100000;

    /**
     * @var int Continent width
     */
    private int $width;

    /**
     * @var array Array representing terrain heights
     */
    private array $terrain;

    public function __construct(int $width, string $terrain)
    {
        $this->setWidth($width);
        $this->setTerrain($terrain);
    }

    /**
     * @param int $width
     */
    private function setWidth(int $width): void
    {
        if ($width < 1) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Width cannot be lower than %s ; "%s" given',
                    self::DEFAULT_MIN_WIDTH,
                    $width
                )
            );
        }

        if ($width > 100000) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Width cannot be greater than %s ; "%s" given',
                    self::DEFAULT_MAX_WIDTH,
                    $width
                )
            );
        }

        $this->width = $width;
    }

    /**
     * This method will convert string to array and validate value.
     *
     * @param string $terrain
     */
    private function setTerrain(string $terrain): void
    {
        // Split string to array
        $terrain = explode(' ', $terrain);

        if (\count($terrain) > $this->width) {
            throw new \InvalidArgumentException('Terrain cannot be wider that continent');
        }

        foreach ($terrain as $height) {
            if (! is_numeric($height)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Invalid Height ; "%s" given',
                        $height
                    )
                );
            }

            if ($height < 0) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Height cannot be lower than %s ; "%s" given',
                        self::DEFAULT_MIN_HEIGHT,
                        $height
                    )
                );
            }

            if ($height > 100000) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Height cannot be greater than %s ; "%s" given',
                        self::DEFAULT_MAX_HEIGHT,
                        $height
                    )
                );
            }
        }

        $this->terrain = $terrain;
    }

    /**
     * This method computes the area where prolosaurs are safe.
     *
     * @return int
     */
    public function getSafeArea(): int
    {
        $area = 0;
        $highest = 0;

        // [1] Iterate through all continent
        for ($i = 0; $i < $this->width; ++$i) {
            // [2] Handle case where list shorter than continent
            $height = $this->terrain[$i] ?? 0;

            if ($height > $highest) {
                // [3] Prolosaurs on this terrain are vulnerable
                $highest = $height;
            } else {
                // [4] Prolosaurs on this terrain are protected from wind
                $area += $highest - $height;
            }
        }

        return $area;
    }
}
