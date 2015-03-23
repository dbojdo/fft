<?php
/**
 * File FftCalculatorRadix2.php
 * Created at: 2015-03-22 21-23
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft;

use Webit\Math\ComplexNumber\Complex;
use Webit\Math\ComplexNumber\ComplexArray;

class FftCalculatorRadix2 implements FftCalculator
{

    /**
     * Calculate the FFT of a signal
     *
     * @param ComplexArray $signal input signal
     * @param Dimension $dimension
     * @return ComplexArray the DFT for the signal in input
     */
    public function calculateFft(ComplexArray $signal, Dimension $dimension)
    {
        $dimension = $dimension->toInt();
        $signal = $this->prepareFttSignal($signal, $dimension);

        list($even, $odd) = $this->extractEvenOdd($signal);
        $evenItems = $dimension == 2 ? $even : $this->calculateFft($even, new Dimension($dimension / 2));
        $oddItems = $dimension == 2 ? $odd : $this->calculateFft($odd, new Dimension($dimension / 2));

        $y = array();
        for ($i = 0; $i < $dimension / 2; $i++) {
            $ith = -2 * $i * M_PI / $dimension;
            $wi = new Complex(cos($ith), sin($ith));

            $y[2*$i] = $evenItems[$i]->add($wi->mul($oddItems[$i]));
            $y[2*$i + 1] = $evenItems[$i]->sub($wi->mul($oddItems[$i]));
        }

        return new ComplexArray($y);
    }

    /**
     * @param ComplexArray $signal
     * @param int $dimension
     * @return ComplexArray
     */
    private function prepareFttSignal(ComplexArray $signal, $dimension)
    {
        $max = min(count($signal), $dimension);
        if ($max < $dimension) {
            return $signal->merge(ComplexArray::create(array_fill(0, $dimension-$max, 0)));
        }

        return $signal;
    }

    /**
     * @param ComplexArray $signal
     * @return array<ComplexArray, ComplexArray>
     */
    private function extractEvenOdd(ComplexArray $signal)
    {
        $even = array();
        $odd = array();
        for ($i = 0; $i < count($signal) / 2; $i++) {
            $even[$i] = $signal->getItem(2 * $i);
            $odd[$i] = $signal->getItem(2 * $i + 1);
        }

        return array(new ComplexArray($even), new ComplexArray($odd));
    }
}
