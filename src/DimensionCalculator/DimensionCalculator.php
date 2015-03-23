<?php
/**
 * File DimensionCalculator.php
 * Created at: 2015-03-22 22-58
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft\DimensionCalculator;

use Webit\Math\Fft\Dimension;

interface DimensionCalculator
{
    /**
     * @param int $signalLength
     * @return Dimension
     */
    public function calculateDimension($signalLength);
}