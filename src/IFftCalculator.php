<?php
/**
 * File IFftCalculator.php
 * Created at: 2015-03-23 17-03
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft;

use Webit\Math\ComplexNumber\ComplexArray;

class IFftCalculator
{
    /**
     * @var FftCalculator
     */
    private $fftCalculator;

    /**
     * @param FftCalculator $fftCalculator
     */
    public function __construct(FftCalculator $fftCalculator)
    {
        $this->fftCalculator = $fftCalculator;
    }

    /**
     * @param ComplexArray $signal
     * @param Dimension $dimension
     * @return ComplexArray
     */
    public function calculateIFtt(ComplexArray $signal, Dimension $dimension)
    {
        $y = array();
        /** @var \Webit\Math\ComplexNumber\Complex $item */
        foreach ($signal as $item) {
            $y[] = $item->getConjugated();
        }

        $fft = $this->fftCalculator->calculateFft(ComplexArray::create($y), $dimension);

        $y = array();
        $ratio = 1 / $dimension->toInt();

        /** @var \Webit\Math\ComplexNumber\Complex $item */
        foreach ($fft as $item) {
            $y[] = $item->getConjugated()->mulScalar($ratio);
        }

        return ComplexArray::create($y);
    }
}
