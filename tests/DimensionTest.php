<?php
/**
 * File DimensionTest.php
 * Created at: 2015-03-23 08-34
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft\Tests;

use Webit\Math\Fft\Dimension;

class DimensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider getPowerOfTwo
     */
    public function shouldConstructWithPowerOfTwo($value)
    {
        $dimension = new Dimension($value);
        $this->assertEquals($value, $dimension->toInt());
    }

    /**
     * @return array
     */
    public function getPowerOfTwo()
    {
        return array(
            array(2),
            array(512),
            array(1024)
        );
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldThrowExceptionOnNonTwoPowerNumber()
    {
        new Dimension(3);
    }
}
