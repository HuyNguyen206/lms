<?php

namespace App\Http\Requests;

use App\Http\Requests\Trait\CheckGuard;
use Illuminate\Http\Request;

class BaseRequest extends Request
{
    use CheckGuard;
}
