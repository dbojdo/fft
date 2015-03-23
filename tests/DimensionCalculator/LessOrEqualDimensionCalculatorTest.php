<?php
/**
 * File FttDimensionCalculatorTest.php
 * Created at: 2015-03-22 22-38
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft\Tests\DimensionCalculator;

use Webit\Math\Fft\Dimension;
use Webit\Math\Fft\DimensionCalculator\LessOrEqualDimensionCalculator;

class LessOrEqualDimensionCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $signalLength
     * @param $expectedDimension
     * @test
     * @dataProvider getDimensionData
     */
    public function shouldCalculateDimensionAsPowerOf2($signalLength, $expectedDimension)
    {
        $calculator = new LessOrEqualDimensionCalculator();
        $dimension = $calculator->calculateDimension($signalLength);

        $this->assertEquals(new Dimension($expectedDimension), $dimension);
    }

    public function getDimensionData()
    {
        return array(
            array(1000, 512),
            array(1024, 1024),
            array(1030, 1024)
        );
    }
}
