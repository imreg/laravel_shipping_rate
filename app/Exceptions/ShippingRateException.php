<?php

namespace App\Exceptions;

use Exception;

class ShippingRateException extends Exception
{
    protected $message = 'Country doesn\'t have any shipping rates';
}
