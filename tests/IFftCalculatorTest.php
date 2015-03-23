<?php
/**
 * File IFftCalculatorTest.php
 * Created at: 2015-03-23 17-18
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft\Tests;

use Webit\Math\ComplexNumber\ComplexArray;
use Webit\Math\Fft\Dimension;
use Webit\Math\Fft\IFftCalculator;

class IFftCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param ComplexArray $signal
     * @param Dimension $dimension
     * @test
     * @dataProvider getIFftData
     */
    public function shouldCalculateIFft(ComplexArray $signal, Dimension $dimension)
    {
        $fftCalculator = $this->createFftCalculator();

        // 1. calculate conjugated
        $conjugated = array();

        $fft = array();

        /** @var \PHPUnit_Framework_MockObject_MockObject|\Webit\Math\Fft\Complex $item */
        foreach ($signal as $item) {
            $conjugatedComplex = $this->createComplex();
            $fftComplex = $this->createComplex();

            $fft[] = $fftComplex;
            $conjugated[] = $conjugatedComplex;

            $item->expects($this->once())->method('getConjugated')->willReturn($conjugatedComplex);
        }
        $conjugated = ComplexArray::create($conjugated);
        $fft = ComplexArray::create($fft);

        // 2. delegates to fftCalculator
        $fftCalculator->expects($this->once())
            ->method('calculateFft')
            ->with($this->equalTo($conjugated), $this->equalTo($dimension))
            ->willReturn($fft);

        $ratio = 1 / $dimension->toInt();

        $ifft = array();

        // 3. calculate conjugated and divide by dimension
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Webit\Math\Fft\Complex $complex */
        foreach ($fft as $complex) {
            $conjugatedComplex = $this->createComplex();
            $ifftComplex = $this->createComplex();
            $ifft[] = $ifftComplex;
            $conjugatedComplex->expects($this->once())->method('mulScalar')->with($this->equalTo($ratio))->willReturn($ifftComplex);

            $complex->expects($this->once())->method('getConjugated')->willReturn($conjugatedComplex);
        }

        // 4. returns IFFT
        $expected = ComplexArray::create($ifft);

        $calculator = new IFftCalculator($fftCalculator);
        $result = $calculator->calculateIFtt($signal, $dimension);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function getIFftData()
    {
        return array(
            array(
                ComplexArray::create(array(
                    $this->createComplex(),
                    $this->createComplex(),
                    $this->createComplex(),
                    $this->createComplex()
                )),
                Dimension::create(4)
            )
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Webit\Math\Fft\FftCalculator
     */
    private function createFftCalculator()
    {
        return $this->getMock('Webit\Math\Fft\FftCalculator');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Webit\Math\Fft\Complex
     */
    private function createComplex()
    {
        return $this->getMockBuilder('Webit\Math\ComplexNumber\Complex')->disableOriginalConstructor()->getMock();
    }
}
