# Web-IT FFT (Fast Fourier Transformation)

FFT and IFFT Calculator

## Installation
### via Composer

Add the **webit/fft** into **composer.json**

```json
{
    "require": {
        "php": ">=5.3.2",
        "webit/fft": "~1.0"
    }
}
```

## Usage
### FFT

```php
<?php
use Webit\Math\Fft\FftCalculatorRadix2;
use Webit\Math\Fft\Dimension;
use Webit\Math\ComplexNumber\ComplexArray;

// FFT
$calculator = new FftCalculatorRadix2();
$signal = ComplexArray::create(array(123, 456, 789, 1111));

$fft = $calculator->calculateFft($signal, Dimension::create(4)); // ComplexArray
```

### IFFT

```php
<?php
use Webit\Math\Fft\IFftCalculator;
use Webit\Math\Fft\FftCalculatorRadix2;
use Webit\Math\Fft\Dimension;
use Webit\Math\ComplexNumber\ComplexArray;

// FFT
$calculator = new IFftCalculator(new FftCalculatorRadix2());
$signal = ComplexArray::create(array(123, 456, 789, 1111));

$ifft = $calculator->calculateIFft($signal, Dimension::create(4)); // ComplexArray
```
