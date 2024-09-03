<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Requests\LoginRequest as BaseLoginRequest;

class LoginRequest extends BaseLoginRequest
{
    protected $guardName = 'web';
}
