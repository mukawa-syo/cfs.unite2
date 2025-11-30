<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Trust all proxies (ALB/ELB 経由想定)
     */
    protected $proxies = '*';

    /**
     * Use AWS ELB header set
     */
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
}
