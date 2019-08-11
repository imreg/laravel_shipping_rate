<?php

namespace App\Exceptions;

use Exception;

class ShippingException extends Exception
{
    protected $message = 'Unable to Save Shipping\' record';
}
