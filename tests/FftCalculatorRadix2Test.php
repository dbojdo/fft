<?php
/**
 * File FftCalculatorRadix2Test.php
 * Created at: 2015-03-23 16-09
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft\Tests;

use Webit\Math\ComplexNumber\Complex;
use Webit\Math\ComplexNumber\ComplexArray;
use Webit\Math\Fft\Dimension;
use Webit\Math\Fft\FftCalculatorRadix2;

class FftCalculatorRadix2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @param ComplexArray $input
     * @param Dimension $dimension
     * @param ComplexArray $expectedFft
     * @test
     * @dataProvider getFftData
     */
    public function shouldCalculateFft(ComplexArray $input, Dimension $dimension, ComplexArray $expectedFft)
    {
        $calculator = new FftCalculatorRadix2();
        $fft = $calculator->calculateFft($input, $dimension);

        $this->assertEquals($expectedFft, $fft);
    }

    /**
     * @return array
     */
    public function getFftData()
    {
        return array(
            array(
                ComplexArray::create(array(
                    -0.03480425839330703,
                    0.07910192950176387,
                    0.7233322451735928,
                    0.1659819820667019
                )),
                Dimension::create(4),
                ComplexArray::create(array(
                    new Complex(0.9336118983487516, 0),
                    new Complex(-0.7581365035668999, 0.08688005256493803),
                    new Complex(0.44344407521182005, 0),
                    new Complex(-0.7581365035668999, -0.08688005256493803),
                ))
            )
        );
    }
}
