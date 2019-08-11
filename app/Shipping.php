<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * @var string
     */
    protected $table = 'shippings';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'price',
        'weight',
        'country_code',
        'shipping_fee',
        'total'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
