<?php

namespace App\Http\Controllers\Traits;

use Automattic\WooCommerce\Client;

trait Woocommerce
{
    protected $techplatoon;

    protected $enterprise;

    public function __construct()
    {
        $this->techplatoon = new Client(
            env('TECHPLATOON_BASE_URL'),
            env('TECHPLATOON_KEY'),
            env('TECHPLATOON_SECRET'),
            [
                'version' => 'wc/v3',
                'verify_ssl' => false
            ]
        );

        $this->enterprise = new Client(
            env('ENTERPRISE_BASE_URL'),
            env('ENTERPRISE_KEY'),
            env('ENTERPRISE_SECRET'),
            [
                'version' => 'wc/v3',
                'verify_ssl' => false
            ]
        );
    }
}