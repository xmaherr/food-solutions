<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", title: "Food Solutions API")]
#[OA\Server(url: "/")]
abstract class Controller
{
    //
}