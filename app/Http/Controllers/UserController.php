<?php

namespace App\Http\Controllers;

use App\Models\User as Model;
use App\Http\Requests\UserRequest as Request;
use App\Http\Resources\User\Resources;
use App\Http\Resources\User\Collections;

class UserController extends BaseController
{
    protected $model      = Model::class;
    protected $request    = Request::class;
    protected $resource   = Resources::class;
    protected $collection = Collections::class;
}
