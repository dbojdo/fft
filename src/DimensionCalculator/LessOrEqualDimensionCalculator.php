<?php
/**
 * File LessOrEqualDimensionCalculator.php
 * Created at: 2015-03-22 22-59
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft\DimensionCalculator;

use Webit\Math\Fft\Dimension;

class LessOrEqualDimensionCalculator implements DimensionCalculator
{

    /**
     * @param int $signalLength
     * @return Dimension
     */
    public function calculateDimension($signalLength)
    {
        $exp = floor(log($signalLength, 2));
        return new Dimension(pow(2, $exp));
    }
}
