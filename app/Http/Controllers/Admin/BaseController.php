<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostServices;

class BaseController extends Controller
{
    public $service;

    public function __construct(PostServices $service)
    {
        $this->service = $service;
    }
}
