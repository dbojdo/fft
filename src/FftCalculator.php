<?php
/**
 * File FftCalculator.php
 * Created at: 2015-03-23 17-27
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Math\Fft;

use Webit\Math\ComplexNumber\ComplexArray;

interface FftCalculator
{
    /**
     * Calculate the FFT of a signal
     *
     * @param ComplexArray $signal input signal
     * @param Dimension $dimension
     * @return ComplexArray the DFT for the signal in input
     */
    public function calculateFft(ComplexArray $signal, Dimension $dimension);
}
