<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\AccessToken;
use App\Http\Response;

class UsersController extends BaseController
{
    // Enter to /api/V1/users to see this message
    public function index()
    {
        return new Response(json_encode(AccessToken::findFirst()->getCentresGranted()->toArray()));
    }
}
