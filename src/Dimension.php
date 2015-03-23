<?php
/**
 * File Dimension.php
 * Created at: 2015-03-23 08-28
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft;

final class Dimension
{
    /**
     * @var int
     */
    private $dimension;

    /**
     * @param $dimension
     */
    public function __construct($dimension)
    {
        if (! $this->isPowerOfTwo($dimension)) {
            throw new \InvalidArgumentException('Dimension must be power of number 2.');
        }

        $this->dimension = (int) $dimension;
    }

    /**
     * @param int $dimension
     * @return Dimension
     */
    public static function create($dimension)
    {
        return new self($dimension);
    }

    /**
     * @return int
     */
    public function toInt()
    {
        return $this->dimension;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->dimension;
    }

    /**
     * @param int $dimension
     * @return bool
     */
    private function isPowerOfTwo($dimension)
    {
        if ($dimension == 0) {
            return false;
        }

        return ($dimension & $dimension - 1) == 0;
    }
}