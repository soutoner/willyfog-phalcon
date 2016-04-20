<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Http\Response;

class TokenController extends BaseController
{
    public function accessToken()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $oauth_response = $this->oauth2->handleTokenRequest($request);

        return Response::createFromOAuth($oauth_response);
    }
}
