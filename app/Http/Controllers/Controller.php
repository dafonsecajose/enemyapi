<?php

namespace App\Http\Controllers;

use App\swagger\Controllers\ControllerInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController implements ControllerInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
