<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\LoginRequest as BaseLoginRequest;

class LoginRequest extends BaseLoginRequest
{
    protected $guardName = 'admin';
}
