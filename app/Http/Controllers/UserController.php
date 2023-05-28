<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\Resources;
use App\Http\Resources\User\Collections;

class UserController extends BaseController
{
    protected $model      = User::class;
    protected $request    = UserRequest::class;
    protected $resource   = Resources::class;
    protected $collection = Collections::class;
}
