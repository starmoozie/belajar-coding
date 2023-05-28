<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends BaseController
{
    protected $model   = User::class;
    protected $request = UserRequest::class;
}
